<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>马上报名</title>
    <link href="/Public/website/Mobile/order/css/main.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/order/css/media-queries.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/order/css/initialize.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/order/css/apply.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/order/css/loginRegister/login.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/order/css/loginRegister/media-queries-login.css" rel="stylesheet" type="text/css">
    <script src="/Public/public/js/jquery-3.2.1.min.js"></script>
    <script src="/Public/public/js/jquery.form.js"></script>
    <script src="/Public/public/js/jquery.validate.js"></script>
    <style>
        span.error{color:#FA7124;display: inline-block;float: right;font-weight: bold;font-size: 10px;margin-right: 2%;line-height: 50px}
        span.ok {color: #289628;}
    </style>
</head>
<script>
    $(function(){
        //validate表单验证
        var validate=$('#form1').validate({
            //设置验证规则
            rules:{account:{required:true}, name:{required:true}, phone:{required:true, phone:true},
                address:{ required:true}
            },
            messages: {account: {required: '*必填项'}, name: {required: '*必填项'}, phone: {required: '*必填项'},
                address: {required: '*必填项'}
            },
            success: function(span) {
                span.addClass("ok").text('*ok');
            },
            validClass:'ok',
            errorElement:'span'
        });
        // 手机号码验证
        jQuery.validator.addMethod("phone", function(value, element) {
            var mobileReg = /^1[34578]{1}[0-9]{9}$/;
            return this.optional(element) || (mobileReg.test(value));
        }, "*手机格式错误");
        $('#form1').submit();
    })
</script>
<body>
<div id="pagewrap">
    <div class="header_box">
        <div class="header">
            <ul>
                <a href="<?php echo ($url); ?>" >
                    <li class="back" style="padding-right: 50px">
                        <img src="/Public/public/images/back.png">
                    </li>
                </a>

                <li class="header_text">马上报名</li>
                <div class="clearfix"></div>
            </ul>
        </div>
    </div>
    <form class="apply_form" action="<?php echo U('Mobile/Order/add_order1');?>" method="post" id="form1">
        <div class="main_box">
            <div class="main">
                <input type="hidden" name="class_id" value="<?php echo ($class_id); ?>"/>
                <input type="hidden" name="id" value="<?php echo ($name['type_id']); ?>"/>
                <div class="apply">
                    <label class="label">真实姓名</label>
                    <input class="user" type="text" name="account" placeholder="请输入真实姓名" required>
                </div>
                <div class="apply">
                    <label class="label">联系电话</label>
                    <input class="tel" type="text" name="phone" placeholder="请输入电话号码" >
                </div>
                <div class="apply">
                    <label class="label" style="margin-right: 33px">性别</label>
                    <input type="radio" name="sex"  value="0"  checked>男&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="sex"  value="1">女
                </div>
                <div id="user"></div>
                <div class="apply">
                    <label class="label">报名人数</label>
                    <input type="button" value="-" onclick="down_num()" style="-webkit-appearance:none;border-radius:5px;width: 8%;background-color:#ffffff;font-weight: bolder;font-size: 18px;border:1px solid #a2a2a2;margin-left: 6px" />
                    <input class="user" style="width: 7%;border:1px solid #a9a9a9;text-align:center;margin-left: 6%" type="text" name="num" value="1" readonly placeholder="1" >
                    <input type="button" value="+" onclick="add_num()" style="-webkit-appearance:none;border-radius:5px;width: 8%;background-color:#ffffff;font-weight: bolder;font-size: 18px;border:1px solid #a2a2a2;margin-left: 6%" />
                </div>
                <script>
                    function add_num(){
                        var val = $("input[name='num']").val();
                        val = parseFloat(val) + 1;
                        $("input[name='num']").val(val);
                        if(val == 50 || val > 50){$("input[name='num']").val(50);}
                        $("#user").append('<div class="stu" style="border-bottom:1px solid rgb(245,245,245);"> <label class="label">姓名</label>' +
                        '<input class="user" type="text" value="" name="name[]" style="width:30%;" placeholder="请如实填写"/>' +
                        '<label class="label">电话</label>' +
                        '<input class="tel " type="text" value="" name="tel[]" style="width:31%;" placeholder="请如实填写"/>' +
                        '</div>');
                    }
                    function down_num(){
                        var val = $("input[name='num']").val();
                        var length = $('.stu').length;
                        if( length > 0){
                            length = parseFloat(length) - 1;
                            $('.stu')[length].remove();
                        }
                        val = val - 1;
                        $("input[name='num']").val(val);
                        if(val < 1 || val == 1){$("input[name='num']").val(1);}
                    }
                </script>
                <div class="apply">
                    <label class="label" style="margin-right: 14px">类型：</label>
                    <input class="user" type="text" style="-webkit-appearance:none;"  name="nickname" value="<?php echo ($nickname); ?>" readonly>
                </div>
                <div class="apply">
                    <label class="label">培训课程</label>
                    <a class="user" href="<?php echo U('Mobile/Detail/index',array('id'=>$name['type_id']));?>#detail">
                        <?php echo ($name['name']); ?>
                    </a>
                </div>
                <div class="apply" style="height:80px;">
                    <label class="apply_order">报名方式</label>
                    <ul class="apply_od" style="margin-left:9px;">
                        <li>
                            <input type="radio" name="type" value="1"  checked>
                            <label>付全款报名 <span><?php echo ($name['wholeprice']); ?></span>元 / 每人</label>
                        </li>
                        <li>
                            <input type="radio" name="type" value="2" >
                            <label>预付费报名 <span><?php echo ($name['advanceprice']); ?></span>元 / 每人</label>
                        </li>
                        <div class="clearfix"></div>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="apply">
                    <label class="ap_note">地址</label>
                    <input class="message" type="text" width="20" name="address" placeholder="请输入所在地址" required>
                </div>
                <div class="apply"  style="margin-bottom:60px;">
                    <label class="ap_note">备注</label>
                    <input class="message" type="text" name="inform" placeholder="更多">
                </div>
            </div>
        </div>

    <footer id="footer">
        <div class="apply_submit">
            <input type="submit"  style="-webkit-appearance:none;" id="btn2" value="马上报名">
        </div>
    </footer>
    </form>
</div>
</body>
</html>