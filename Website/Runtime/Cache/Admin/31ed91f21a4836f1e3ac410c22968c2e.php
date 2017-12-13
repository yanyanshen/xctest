<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>语言教育编辑</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/website/Admin/ment/css/mine.css" type="text/css" rel="stylesheet">
        <script src="/Public/public/js/jquery.min.1.8.2.js"></script>
        <script type="text/javascript" src="/Public/public/js/jquery.form.js"></script>
        <script src="/Public/public/js/jquery.validate.js"></script>
        <script type="text/javascript" src="/Public/public/js/layer/layer.js"></script>
        <script type="text/javascript" src="/Public/public/kindeditor/kindeditor-all.js"></script>

        <style type="text/css">
            span.error{font-size: 12px; color: #FA7124;}
            span.ok{font-size: 12px;color: #38D63B;}

            .table_a  td{text-align: left}
        </style>
        <script>
            $(document).ready(function(e) {
                KindEditor.ready(function (K) {
                    K.create('#content7', {
                        allowFileManager: true,
                        filterMode: true,
                        afterBlur: function () {  //利用该方法处理当富文本编辑框失焦之后，立即同步数据
                            this.sync("#content7");
                        }
                    });
                });
            })
        </script>
    </head>
        <script language="javascript">
        $(function(){
            var validate=$('#form1').validate({
                rules:{
                    nickname:{required:true}, minprice:{required:true},
                    address:{required:true}, abstract:{required:true}
                },
                messages:{
                    nickname:{required:' * 必填项！'}, address:{required:' * 必填项！'},
                    minprice:{required:' * 必填项！'}, abstract:{required:' * 必填项！'}
                },
                success:function(span){
                    span.addClass('ok').text(' * ok')
                },
                validClass:'ok',
                errorElement:'span'
            });
            $("#add_language").click(function(){
                $(this).attr('disabled',true);
                    if(validate.form()){
                        $('#form1').ajaxSubmit(function(res){
                            if(res.status==1){
                                layer.msg(res.info,{icon:6,time:2000},function(){
                                    location.href=res.url;
                                });
                            }else{
                                layer.msg(res.info,{icon:5,time:2000},function(){
                                    location.href=res.url;
                                });
                            }
                        },'json');
                        return false;
                    }
            });
        });
    </script>
    <body>
        <div class="div_head">
            语言教育编辑
            <a style="text-decoration: none;font-weight: bold;color: #FA7124" href="<?php echo ($url); ?>">【返回】</a>
        </div>
        <div style="margin: 10px 5px">
            <form action="<?php echo U('Admin/Language/language_edit');?>" method="post" enctype="multipart/form-data" id="form1">
                <input type="hidden" name="p" value="<?php echo ($get['p']); ?>"/>
                <input type="hidden" name="pid" value="<?php echo ($get['pid']); ?>"/>
                <input type="hidden" name="id" value="<?php echo ($get['id']); ?>"/>
                <table width="100%" class="table_a">
                    <tr style="color: #646464">
                        <td width="7%">名称</td>
                        <td><input type="text" name="nickname" value="<?php echo ($info["nickname"]); ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>最低价格</td>
                        <td><input type="text" name="minprice" value="<?php echo ((isset($info["minprice"]) && ($info["minprice"] !== ""))?($info["minprice"]):''); ?>"/></td>
                    </tr>
                    <tr>
                        <td>所在城市</td>
                        <td>
                            <select name="cityid"  onchange="change(this)">
                                <?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>" <?php echo ($info['cityid']==$v['id']?'selected':''); ?>><?php echo ($v["cityname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>地址</td>
                        <td>
                            <input type="text" name="address" value="<?php echo ((isset($info["address"]) && ($info["address"] !== ""))?($info["address"]):''); ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>官方电话</td>
                        <td><input type="text" name="official_tel" value="<?php echo ($info["official_tel"]); ?>" /></td>
                    </tr>
                    <tr>
                        <td>负责人电话</td>
                        <td><input type="text" name="manager_tel" value="<?php echo ($info["manager_tel"]); ?>" /></td>
                    </tr>
                    <tr>
                        <td>计时培训</td>
                        <td>
                            <label><input type="radio"  name='timing' value=1 <?php echo ($info['timing']==1?checked:''); ?>/>支持</label>　
                            <label><input type="radio" name='timing' value=0 <?php echo ($info['timing']==0?checked:''); ?>/>不支持</label>
                        </td>
                    </tr>
                    <tr>
                        <td>评分</td>
                        <td><input type="text" name="score" value="<?php echo ($info["score"]); ?>"/></td>
                    </tr>
                    <tr>
                        <td>评论数</td>
                        <td><input type="text" name="comment_num" value="<?php echo ($info["comment_num"]); ?>" /></td>
                    </tr>
                    <tr>
                        <td>报名数</td>
                        <td><input type="text" name="num"  value="<?php echo ((isset($info["num"]) && ($info["num"] !== ""))?($info["num"]):0); ?>"/></td>
                    </tr>
                    <tr>
                        <td>简介</td>
                        <td>
                            <textarea name="abstract"  id="content7" class="dfinput" style="padding-left:70px;height:250px;visibility:hidden;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;精锐教育是中国领先的个性化教育连锁集团，
                                由哈佛、北大精英创立，并由全球著名投资集团贝恩资本注资，专注于培养18岁以下孩子的学习力，成就辉煌未来。
                                自创立伊始，精锐即秉持国际化管理理念和连锁化发展模式，立志成为中国教育行业最受尊敬的品牌。
                                旗下拥有精锐1对1、至慧学堂、精锐.佳学慧、精锐.学汇趣等子品牌。精锐结合东西方教育的优势，
                                致力于打造快乐高效的第三课堂，创新性提出“以学为主、以教为辅、主动学习、趣味互动”的教学四项基本原则。
                                与此同时，精锐教育与北大教育学院达成多项共识并签署相关协议。双方将结合教学研发最前沿科技成果，
                                一起升级全新针对0-18岁孩子学习力体系和该阶段教师培训体系，双管齐下提升学生学习的自信和兴趣。
                                精锐坚信学习力成就未来，致力于提升中国个性化教育在全球市场的竞争力！ 精锐所获荣誉 1. 2013年度新浪最具品牌影响力课外辅导机构
                                2. 2013年搜狐中国教育产业领军品牌金狐奖 3. 2013新浪全国十大课外教育五星金牌机构4. 2013全国课外教育五星金牌教师
                                5. 2013年21世纪中国最佳商业模式奖 6. 2012中国最具竞争力教育品牌7. 2012中国十大教育辅导机构
                                8. 2012最具口碑影响力课外辅导机构 9. 2012最具影响力课外辅导机构10. 2012年度上海最具影响力教育集团
                                11. 2012年度最受读者信赖的教育品牌 12. 2012年度教育行业最信赖的辅导品牌 13. 2012江苏地区优质教育培训品牌
                                14. 2012年度扬子晚报教育示范品牌 15. 2012华南金质教育品牌 16. 2012深圳十大招生培训诚信品牌 官方报名热线：400-8040-517
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" id="add_language" value="确认编辑">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
<script>
    function previewImage(file,pre,imag) {
        var MAXWIDTH  = 180;
        var MAXHEIGHT = 150;
        var div = document.getElementById(pre);
        if( !file.value.match( /.jpg|.gif|.png|.bmp/i ) ){
            $('#'+pre).next('span').css({"color":"red","font-weight":"bold"}).text('图片类型无效！');
            return false;
        }else{
            $('#'+pre).next('span').css({"color":"green","font-weight":"bold"}).text('');
        }
        if (file.files && file.files[0])
        {
            div.innerHTML ='<img id='+imag+'>';
            var img = document.getElementById(imag);
            img.onload = function(){
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                img.width  =  rect.width;
                img.height =  rect.height;
//                 img.style.marginLeft = rect.left+'px';
                img.style.marginTop = rect.top+'px';
            }
            var reader = new FileReader();
            reader.onload = function(evt){img.src = evt.target.result;}
            reader.readAsDataURL(file.files[0]);
        }
        else //兼容IE
        {
            var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
            file.select();
            file.blur();
            var src = document.selection.createRange().text;
            div.innerHTML ='<img id='+imag+'>';
            var img = document.getElementById(imag);
            img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);
        }

        $(file).next('label').css({margin:0,top:0,position:'absolute',background:'rgba(0,0,0,0.4)',color:'#fff',fontSize:'14px'}).html('重新选择主图');
    }
    function clacImgZoomParam( maxWidth, maxHeight, width, height ){
        var param = {top:0, left:0, width:width, height:height};
        if( width>maxWidth || height>maxHeight )
        {
            rateWidth = width / maxWidth;
            rateHeight = height / maxHeight;

            if( rateWidth > rateHeight )
            {
                param.width =  maxWidth;
                param.height = Math.round(height / rateWidth);
            }else
            {
                param.width = Math.round(width / rateHeight);
                param.height = maxHeight;
            }
        }

        param.left = Math.round((maxWidth - param.width) / 2);
        param.top = Math.round((maxHeight - param.height) / 2);
        return param;
    }

</script>