<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>支付订单</title>
    <link href="/Public/website/Mobile/pay_success/css/main.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/pay_success/css/media-queries.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/pay_success/css/initialize.css" rel="stylesheet" type="text/css">
    <link href="/Public/website/Mobile/pay_success/css/pay.css" rel="stylesheet" type="text/css">
    <script src="/Public/public/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div id="pagewrap">
    <div class="header_box">
        <div class="header">
            <ul>
                <li class="header_text">支付成功</li>
                <div class="clearfix"></div>
            </ul>
        </div>
    </div>
    <div class="main_box">
        <div class="main">
            <div class="pay_success_box">
                <div class="pay_success1">
                    <div class="pay_success_img">
                        <img src="/Public/website/Mobile/pay_success/images/right.png">
                    </div>
                    <div class="pay_success_text">
                        <ul>
                            <li class="pay_success_payWay"><img src="/Public/website/Mobile/pay_success/images/zfb.png" alt=""/></li>
                            <li class="pay_success_money1">支付金额：</li>
                            <li class="pay_success_money2"><?php echo ($info['total_fee']); ?>元</li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>
                <div class="pay_success2">
                    <div class="pay_success_list1">
                        <span class="pay_success_list_left1">商户名称</span>
                        <span class="pay_success_list_right1">我要去学车</span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="pay_success_list1">
                        <span class="pay_success_list_left1">交易时间</span>
                        <span class="pay_success_list_right1"><?php echo ($info['create_time']); ?></span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="pay_success_list1">
                        <span class="pay_success_list_left1">交易单号</span>
                        <span class="pay_success_list_right1"><?php echo ($info['trade_no']); ?></span>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer">
        <div class="goBack">
            <a href="<?php echo U('Mobile/User/user_center');?>" class="go_back">订单查看</a>
        </div>
    </footer>
</div>
</body>
</html>