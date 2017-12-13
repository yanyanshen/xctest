<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>新建订单</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="/Public/website/Admin/ment/css/mine.css" type="text/css" rel="stylesheet">
    <script  src="/Public/public/js/My97DatePicker/WdatePicker.js"></script>
    <script src="/Public/public/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/public/js/jquery.form.js"></script>
    <script src="/Public/public/js/jquery.validate.js"></script>
    <script language="javascript">
       $(function(){
            var validate=$('#form1').validate({
                rules:{phone:{required:true, phone:true}, truename:{required:true}},
                messages:{phone:{required:' * 必填项！'}, truename:{required:' * 必填项！'}},
                success:function(span){
                    span.addClass('ok').text(' * ok')
                },
                validClass:'ok',
                errorElement:'span'
            });
            $("#form1").submit();
            jQuery.validator.addMethod("phone", function(value, element) {
                var mobileReg = /^1[34578]{1}[0-9]{9}$/;
                return this.optional(element) || (mobileReg.test(value));
            }, " * 手机号格式错误");
        });
    </script>
    <style>
        .td {color: #646464;font-weight: bolder}
        span.error{font-size: 12px;color: #FA7124;}
        span.ok{font-size: 12px;color: rgb(19, 181, 177);}
        .table_a  td{text-align: left}

        #searchresult{top:205px;left: 260px;position: absolute;z-index:5; overflow:hidden;border-top:none;}
        .line{font-size:12px; color: #ffffff; background:rgb(19, 181, 177); width:200px; padding:2px;height: 30px}
        .hover{ color:#323232;background-color: transparent;cursor: pointer}
    </style>
</head>
<body>
<div class="div_head">
    新建订单
    <span style="margin-right: 8px;font-weight: bold">
        <a style="text-decoration: none;color: #FA7124" href="<?php echo ($url); ?>">【返回】</a>
    </span>
    <a href="" style="text-decoration: none;color: #646464">【刷新】</a>
</div>
<div style="margin: 10px 5px">
    <form action="<?php echo U('Admin/Order/add_order');?>" id="form1" method="post">
        <input type="hidden" value="<?php echo ($get['p']); ?>" name="p"/>
        <input type="hidden" value="<?php echo ($get['pid']); ?>" name="pid"/>
        <table width="100%" class="table_a">
            <tr style="color: #323232">
                <td>客户信息:</td>
                <td>用户信息:</td>
            </tr>
            <tr>
                <td class="td">
                    <div  id="copy">
                        客户姓名：<input type="text" id="account" name="truename" value=""/>
                        <select id="sex" name="user_sex" style="height: 25px">
                            <option value="0">男</option>
                            <option value="1">女</option>
                        </select><br>
                        联系电话：<input type="text" id="tel" name="phone" value=""/>
                        <input type="reset" value="清除"/>
                    </div>
                    <span onclick="fuzhi_stu()" style="color:rgb(19, 181, 177);cursor: pointer;margin-right: 20%;float: right">复制学员 =></span>
                    <script>
                        function fuzhi_stu(){
                            var account = $("#account").val();
                            var tel = $("#tel").val();
                            var sex = $("#sex").val();
                            var str = '';
                            str += '<div>学员姓名：<input type="text" value="'+account+'" name="account[]"/>';
                            str += ' <select style="height: 25px" name="sex[]"> ';
                            if(sex == 0){
                                str += '<option value="0" selected>男</option> ';
                                str += '<option value="1">女</option>';
                            }else{
                                str += '<option value="0">男</option> ';
                                str += '<option value="1" selected>女</option>';
                            }
                            str += '</select>联系电话：<input type="text" value="'+tel+'" name="tel[]"/>' +
                                    '<span class="delete_stu" style="color:rgb(19, 181, 177);cursor: pointer; ">删除</span> </div>';
                            $(".add_stu").prepend(str);
                            $('.delete_stu').on('click',function(){
                                var a = $(this);
                                a.parent('div').remove();
                            });
                        }
                    </script>
                </td>
                <td class="td  add_stu">
                    <span onclick="add_stu()" style="color:rgb(19, 181, 177);cursor: pointer;">+添加学员</span><br>
                    所在位置：
                    <select name="cityid" id="city" style="width: 70px;height: 20px">
                    <?php if(is_array($citys)): $i = 0; $__LIST__ = $citys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php echo ($cityid==$v['id']?'selected':''); ?>><?php echo ($v["cityname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                    区/县<select name="countyname" id="county"  style="width: 70px;height: 20px" >
                    <?php if(is_array($countys)): $i = 0; $__LIST__ = $countys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["countyname"]); ?>" <?php echo ($countyid==$v['id']?'selected':''); ?>><?php echo ($v["countyname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
                    <input type="text" name="address" />
                </td>
            </tr>
            <tr style="height: 15px"></tr>
            <tr style="height: 25px;color: #000000;font-weight: bold"><td colspan="2">意向课程：</td></tr>
            <tr>
                <td class="td">
                    <input type="hidden" name="school_id" id="sid"/>
                    学车课程：<input type="text" style="height: 25px"  name="s_nickname" id="search"/>
                    <span id="searchresult" class="td"></span>
                    <span style="float:right;">
                        <select name="class_name" id="class_name" style="width: 160px;height: 30px;margin-right: 20px"></select>
                        <select name="trainaddress" id="class_base" style="width: 150px;height: 30px;margin-right: 20px"></select>
                    </span>
                </td>
                <td class="td">
                    门市价：<input type="text"  id="wholeprice" name="wholeprice" readonly/>
                    <span style="margin-left: 50px">全包价：<input id="officeprice"  type="text" readonly/></span>
                </td>
            </tr>
            <tr style="height: 15px"></tr>
            <tr style="height: 25px;color: #000000;font-weight: bold"><td colspan="2">付款信息：</td></tr>
            <tr>
                <td colspan="2" class="td">支付类型：
                    <select name="pay_type" style="width: 70px;height: 20px">
                        <option value='0' >未支付</option>
                        <option value='1' >支付宝</option>
                        <option value='2' >微信</option>
                        <option value='3' >门店</option>
                        <option value='4' >快递</option>
                        <option value='5' >驾校</option>
                    </select>
                </td>
            </tr>
            <tr style="height: 15px"></tr>
            <tr style="height: 25px;color: #000000;font-weight: bold;"><td  colspan="2" >订单来源：</td></tr>
            <tr style="height: 25px;font-weight: bold">
                <td colspan="2" style="color: #646464">来源：
                    <?php if(is_array($order_source)): $i = 0; $__LIST__ = $order_source;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$order_source): $mod = ($i % 2 );++$i;?><div style="border-left:1px solid rgb(19, 181, 177);display: inline-block;width: 80px;text-align: center">
                            <input type="radio" <?php echo ($order_source['id'] == 16?'checked':''); ?> value="<?php echo ($order_source['id']); ?>" name="order_source"/><?php echo ($order_source['name']); ?>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </td>
            </tr>
            <tr style="height: 15px"></tr>
            <tr style="height: 25px;color: #000000;font-weight: bold"><td  colspan="2" >订单备注：</td></tr>
            <tr>
                <td colspan="2" class="td">
                    <label for=""  style="margin-bottom: 20px">备注：</label>
                    <textarea name="customer_inform" id="" cols="40" rows="2"></textarea><br>
                    设置回访日期: <input type="text" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',readOnly:true})" name="return_time"/>　
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input id="add_order" type="submit" value="添加">
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
<!--课程、驾校、基地选择-->
<script>
    $(document).ready(function(){
        $("#class_name").html("<option value='0'>请选择课程</option>");
        $("#class_base").html("<option value='0'>请选择基地</option>");
        $('#search').keyup(function(){
            var search_key = $('#search').val();
            $.post("<?php echo U('Admin/TrainClass/search_school');?>",{search_key:search_key},function(res){
                if(res.info) {
                    var layer;
                    layer = "<table>";     //创建一个table
                    for (var i in res.info) {
                        layer += "<tr><td class='line' onclick='line("+res.info[i]['id']+',"'+res.info[i]['nickname']+'"'+")'>" + res.info[i]['nickname'] + "</td></tr>";
                    }
                    layer += "</table>";
                    $('#searchresult').empty();  //先清空#searchresult下的所有子元素
                    $('#searchresult').append(layer);//将刚才创建的table插入到#searchresult内
                    $('.line').hover(function(){  //监听提示框的鼠标悬停事件
                        $(this).addClass("hover");
                    },function(){
                        $(this).removeClass("hover");
                    });
                }
            },'json');
        });
    });
    function line(id,nickname){
        $('#search').val(nickname);
        $("#sid").val(id);
        $.post("<?php echo U('Admin/TrainClass/get_class_name');?>",{id:id},function(data){
            if(data.info){
                var str = '<option value="0">请选择课程</option>';
                var str1 = '<option value="0">请选择基地</option>';
                for(var i in data.info['trainclass']){
                    str += "<option value='"+data.info['trainclass'][i]['id']+"'>"+data.info['trainclass'][i]['name']+" </option>";
                }
                for(var y in data.info['class_base']){
                    str1 += "<option value='"+data.info['class_base'][y]['id']+"'>"+data.info['class_base'][y]['trname']+" </option>"
                }
                $("#class_name").html(str);
                $("#class_base").html(str1);
            }else{
                alert('未查到课程或基地数据');
            }
        },'json');
        $('#searchresult').empty();
    }
    $("#class_name").change(function(){
        var id = $("#class_name option:selected").val();
        $.post("<?php echo U('Admin/TrainClass/return_prices');?>",{id:id},function(price){
            $("#wholeprice").val(price.info['wholeprice']);
            $("#officeprice").val(price.info['officeprice']);
        },'json');
    });
</script>
<!--城市 、区县 选择-->
<script>
    $("#city").change(function(){
        $("#cityname").val($("#city option:selected").val());
        $(".cityname").val($("#city option:selected").text());
        $.post("<?php echo U('LandMark/returncounty');?>", {cityid:$("#city option:selected").val()}, function(data,status){
            $("#county").html("");
            for(i=0;i<data.info.length;i++){
                $("#countyname").val(data.info[0].countyname);
                $(".countyname").val(data.info[0].countyname);
                $("#county").append("<option value="+data.info[i].countyname+">"+data.info[i].countyname+"</option>");//在后面追加
            }
        });
    });
</script>
<!--添加学生-->
<script>
    function add_stu(){
        $(".add_stu").prepend(' <div>学员姓名：<input type="text" value="" name="account[]"/>' +
        '<select style="height: 25px" name="sex[]"> <option value="0">男</option> <option value="1">女</option></select>' +
        ' 联系电话：<input type="text" value="" name="tel[]"/>' +
        '<span class="delete_stu" style="color:rgb(19, 181, 177);cursor: pointer; ">删除</span> </div>');
        $('.delete_stu').on('click',function(){
            var a = $(this);
            a.parent('div').remove();
        });
    }
</script>