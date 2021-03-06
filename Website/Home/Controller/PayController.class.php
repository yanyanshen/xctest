<?php
namespace Home\Controller;

use Think\Controller;

class PayController extends Controller{
    // 在类初始化方法中，引入相关类库
    public function _initialize()
    {
        vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');
    }




    public function index(){
        $this->display();
    }

        public function act(){
            $type=$_POST['type'];
            $orderSn =mt_rand(1111111111111111,9999999999999999);// 银联的orderId  需要16位字符 支付宝的order_sn没有限制
            $data=array(
                'orderSn'  => $orderSn,  // 商家订单号 必填
                'orderName'=>$_POST['name'], // 订单名称    必填
                'orderFee' =>0.01,       // 付款金额  必填
                'body'     =>$_POST['detail'],         //订单描述
                'showUrl'  =>$_POST['showUrl'],         // 商品展示地址
            );

            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = getordcode();

            //订单名称，必填
            $subject = $_POST['detail'];

            //付款金额，必填
            $total_fee = $_POST['ordtotal_fee'];

            //商品描述，可空
            $body = $_POST['name'];

            //构造要请求的参数数组，无需改动
            $alipay_config = C('alipay_config');

            $parameter = array(
                "service"       => $alipay_config['service'],
                "partner"       => $alipay_config['partner'],
                "seller_id"  => $alipay_config['seller_id'],
                "payment_type"	=> $alipay_config['payment_type'],
                "notify_url"	=> $alipay_config['notify_url'],
                "return_url"	=> $alipay_config['return_url'],
                "anti_phishing_key"=>$alipay_config['anti_phishing_key'],
                "exter_invoke_ip"=>$alipay_config['exter_invoke_ip'],
                "out_trade_no"	=> $out_trade_no,
                "subject"	=> $subject,
                "total_fee"	=> $total_fee,
                "body"	=> $body,
                "_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
            );

            switch($type){
                case 'Alipay'://支付宝
                    $alipaySubmit = new \AlipaySubmit($alipay_config);
                    $html_text = $alipaySubmit->buildRequestForm($parameter, "get", "确认");
                    echo $html_text;
                    break;
                case 'pufa': //银联
                    $pay=A('YPay');
                    $aa=$pay->usespay($data);
                    break;
                case 'weixin':// 微信
                    $pay=A('Home1/Weixin');
                    break;
            }
    }



    /**
     * ****************************
     * 服务器异步通知页面方法
     * 其实这里就是将notify_url.php文件中的代码复制过来进行处理
     *
     * *****************************
     */
    public function notifyurl()
    {

        /*
         * 同理去掉以下两句代码；
         */
        // require_once("alipay.config.php");
        // require_once("lib/alipay_notify.class.php");

        // 这里还是通过C函数来读取配置项，赋值给$alipay_config
        $alipay_config = C('alipay_config');
        // 计算得出通知验证结果
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if ($verify_result) {
            // 验证成功
            // 获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            $out_trade_no = $_POST['out_trade_no']; // 商户订单号
            $trade_no = $_POST['trade_no']; // 支付宝交易号
            $trade_status = $_POST['trade_status']; // 交易状态
            $total_fee = $_POST['total_fee']; // 交易金额
            $notify_id = $_POST['notify_id']; // 通知校验ID。
            $notify_time = $_POST['notify_time']; // 通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
            $buyer_email = $_POST['buyer_email']; // 买家支付宝帐号；
            $parameter = array(
                "out_trade_no" => $out_trade_no, // 商户订单编号；
                "trade_no" => $trade_no, // 支付宝交易号；
                "total_fee" => $total_fee, // 交易金额；
                "trade_status" => $trade_status, // 交易状态
                "notify_id" => $notify_id, // 通知校验ID。
                "notify_time" => $notify_time, // 通知的发送时间。
                "buyer_email" => $buyer_email
            ) ;// 买家支付宝帐号；

            if ($_POST['trade_status'] == 'TRADE_FINISHED') {
                //
            } else
                if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                    if (! checkorderstatus($out_trade_no)) {
                        orderhandle($parameter);
                        // 进行订单处理，并传送从支付宝返回的参数；
                    }
                }
            echo "success"; // 请不要修改或删除
        } else {
            // 验证失败
            echo "fail";
        }
    }

    /*
     * 页面跳转处理方法；
     * 这里其实就是将return_url.php这个文件中的代码复制过来，进行处理；
     */
    public function returnurl()
    {
        // 头部的处理跟上面两个方法一样，这里不罗嗦了！
        $alipay_config = C('alipay_config');
        $alipayNotify = new \AlipayNotify($alipay_config); // 计算得出通知验证结果
        $verify_result = $alipayNotify->verifyReturn();
        if ($verify_result) {
            // 验证成功
            // 获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            $out_trade_no = $_GET['out_trade_no']; // 商户订单号
            $trade_no = $_GET['trade_no']; // 支付宝交易号
            $trade_status = $_GET['trade_status']; // 交易状态
            $total_fee = $_GET['total_fee']; // 交易金额
            $notify_id = $_GET['notify_id']; // 通知校验ID。
            $notify_time = $_GET['notify_time']; // 通知的发送时间。
            $buyer_email = $_GET['buyer_email']; // 买家支付宝帐号；

            $parameter = array(
                "out_trade_no" => $out_trade_no, // 商户订单编号；
                "trade_no" => $trade_no, // 支付宝交易号；
                "total_fee" => $total_fee, // 交易金额；
                "trade_status" => $trade_status, // 交易状态
                "notify_id" => $notify_id, // 通知校验ID。
                "notify_time" => $notify_time, // 通知的发送时间。
                "buyer_email" => $buyer_email
            ) // 买家支付宝帐号
;

            if ($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                if (! checkorderstatus($out_trade_no)) {
                    orderhandle($parameter); // 进行订单处理，并传送从支付宝返回的参数；
                }
                $this->redirect(C('alipay.successpage')); // 跳转到配置项中配置的支付成功页面；
            } else {
                echo "trade_status=" . $_GET['trade_status'];
                $this->redirect(C('alipay.errorpage')); // 跳转到配置项中配置的支付失败页面；
            }
        } else {
            // 验证失败
            // 如要调试，请看alipay_notify.php页面的verifyReturn函数
            echo "支付失败！";
        }
    }
}
