<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>登录</title>
    <link href="/Public/website/Mobile/login/css/initialize.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/login/css/media-queries.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/login/css/loginRegister/login.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/login/css/loginRegister/media-queries-login.css" rel="stylesheet" type="text/css">
    <script src="/Public/public/js/jquery-3.2.1.min.js"></script>
    <script src="/Public/public/js/layer_mobile/layer.js"></script>
    <script src="/Public/public/js/jquery.form.js"></script>
    <script src="/Public/public/js/jquery.validate.js"></script>
    <style>
        span.error{position: absolute;color:#FA7124;font-weight: bold;display:block;
            padding-left: 10px;font-size: 10px}
        span.ok {color: #289628;}
    </style>
<body>
<div class="login_box">
    <div class="header_box">
        <div class="header">
            <ul>
                <a href="<?php echo U('Mobile/Index/index');?>"><li class="back"><img src="/Public/public/images/back.png"></li></a>
                <li class="header_text" style="margin-right: 24px">登录</li>
                <div class="clearfix"></div>
            </ul>
        </div>
    </div>
    <div class="main_box">
        <div class="main">
            <form action="#" method="" id="form1">
                <div class="tell_box">
                    <input id="username" class="tell" type="text" name="username" placeholder="手机号码">
                </div>
                <div class="error_box">
                    <div id="error_box1"></div>
                </div>
                <div class="password_box">
                    <input id="password" class="password" type="password" name="password" placeholder="密码">
                </div>
                <div class="error_box" style="height: 80px;width: 80%;margin-left: 10%">

                </div>
                <div class="login_button_box">
                    <div class="lb">
                        <button class="login_button">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="button_box">
        <div class="button">
            <div class="b1" style="">
                <a href="register.html"   style="margin-left: 7px">注册新用?</a>
            </div>
            <div class="b2" style="">
                <a href='<?php echo U("Mobile/User/forgetPassword");?>' style="margin-left: 3px">忘记密码?</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        //validate表单验证
        var validate=$('#form1').validate({
            //设置验证规则
            rules:{
                username:{
                    required:true,
                    username:true,
                    remote:{url:'<?php echo U("Mobile/Login/checkPhone");?>', type:'post'}
                },
                password:{required:true}
            },


            messages: {
                username: {required: '*必填项', remote:'*此手机号未注册'},
                password: {required: '*必填项'}
            },
            success: function(span) {
                span.addClass("ok").text('*ok');
            },
            validClass:'ok',
            errorElement:'span'
        });
        // 手机号码验证
        jQuery.validator.addMethod("username", function(value, element) {
            var mobileReg = /^1[34578]{1}[0-9]{9}$/;
            return this.optional(element) || (mobileReg.test(value));
        }, "*格式错误");


        $('.login_button').click(function(){
            //表单提交之前判断前端验证是否通过，只有通过时才提交表单
            if(validate.form()){
                $.post("<?php echo U('Mobile/Login/login');?>",$('#form1').serialize(),function(res){
                    if(res.status==1){
                        layer.open({
                            content: res.info,time: 2 //2秒后自动关闭
                            ,end:function(){
                                location.href=res.url;
                            }
                        });
                    }else{
                        layer.open({
                            content: res.info,time: 2 //2秒后自动关闭
                            ,end:function(){
                                location.href=res.url;
                            }
                        });
                    }
                },'json');
                return false;
            }
        })
    })
</script>
</body>
</html>