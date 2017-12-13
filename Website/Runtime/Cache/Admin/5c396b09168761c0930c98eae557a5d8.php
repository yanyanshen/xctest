<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>添加指导员</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="/Public/website/Admin/ment/css/mine.css" type="text/css" rel="stylesheet">
        <script src="/Public/public/js/jquery.min.1.8.2.js"></script>
        <script type="text/javascript" src="/Public/public/js/jquery.form.js"></script>
        <script src="/Public/public/js/jquery.validate.js"></script>
        <script src="/Public/public/js/layer/layer.js"></script>
        <script type="text/javascript" src="/Public/public/kindeditor/kindeditor-all.js"></script>
        <style>
            .table_a td{text-align: left}
            span.error{font-size: 12px;color: #FA7124;}
            span.ok{font-size: 12px;color: #38D63B;}
            .table_a  input{font-size: 12px}

            #searchresult{top:50px;left: 280px;position: absolute;z-index:5; overflow:hidden;border-top:none;}
            .line{font-size:12px; color: #ffffff; background:rgb(19, 181, 177); width:200px; padding:2px;height: 30px}
            .hover{ color:#323232;background-color: transparent;cursor: pointer}
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
    <body>
        <div class="div_head">
            指导员添加
            <a style="text-decoration: none;color: #FA7124" href="<?php echo ($url); ?>">【返回】</a>
            <a href="" style="text-decoration: none;color: #646464">【刷新】</a>
        </div>
        <div style="font-size: 12px;margin: 10px 5px">
            <form action="<?php echo U('Admin/Guider/add_zd');?>" method="post" id="form1" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo ($get['p']); ?>" name="p" id="p"/>
                <input type="hidden" value="<?php echo ($get['pid']); ?>" name="pid" id="pid"/>
                <input type="hidden" value="<?php echo ($get['type']); ?>" name="type"/>
            <table  width="100%" class="table_a">
                <tr style="color: #646464">
                    <td>所属驾校：</td>
                    <td>
                        <!--<input type="text" name="school_nickname" value="<?php echo ($school_nickname); ?>"/>-->
                        <!--<input type="button" value="选择" id="school_id"/>-->

                        <input type="text" name="school_id" id="sid"/>
                        <input type="text" value=""  name="school_nickname" id="search" placeholder="请输入驾校"/>
                        <span id="searchresult" class="td"></span>
                    </td>
                </tr>
                <tr style="margin-top: 10px">
                    <td width="6%x">指导员账号：</td>
                    <td>
                        <input type="text" name="account"/>
                    </td>
                </tr>
                <tr>
                    <td>指导员姓名：</td>
                    <td>
                        <input type="text" name="nickname"/>
                    </td>
                </tr>
                <tr>
                    <td>驾校电话</td>
                    <td><input type="text" name="phone" value="400-8040-517" /></td>
                </tr>
                <tr>
                    <td>联系电话：</td>
                    <td><input type="text" name="connectteacher" /></td>
                </tr>
                <tr>
                    <td>性&nbsp;&nbsp;别：</td>
                    <td>
                        <input type="radio" checked name='sex' value=0 /> <label for="">男</label>
                        <input type="radio"   name='sex' value=1 /><label for="">女</label>
                        <input type="radio"   name='sex' value=2 /><label for="">保密</label>
                    </td>
                </tr>
                <tr>
                    <td>指导员类型：</td>
                    <td>
                        <select name="category_id" style="height: 20px;width: 70px;font-size: 12px" >
                            <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value='<?php echo ($v["id"]); ?>'  ><?php echo ($v["category_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>所在城市：</td>
                    <td>
                        <select name="cityid" style="width:80px;font-size: 12px;height: 20px" id="cityid" onchange="change(this)">
                            <?php if(is_array($city)): $i = 0; $__LIST__ = $city;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["cityname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>所属指导员：</td>
                    <td>
                        <select name="boss_id" style="width:80px;font-size: 12px;height: 20px">
                            <?php if(is_array($boss)): $i = 0; $__LIST__ = $boss;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v1["id"]); ?>" ><?php echo ($v1["boss_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </td>
                </tr>
                 <tr>
                    <td>身份证号：</td>
                    <td><input type="text" name="numberId"/></td>
                </tr>
                 <tr>
                    <td>驾驶证号：</td>
                    <td><input type="text" name="driverId" /></td>
                </tr>
                <tr>
                    <td>车牌号：</td>
                    <td><input type="text" name="carnumber"/></td>
                </tr>
                 <tr>
                    <td>教练证号：</td>
                    <td><input type="text" name="serialid" /></td>
                </tr>
                <tr>
                    <td>年&nbsp;&nbsp;龄：</td>
                    <td><input type="text" name="age" ></td>
                </tr>
                <tr>
                    <td>驾&nbsp;&nbsp;龄：</td>
                    <td><input type="text" name="driverage" value="" ></td>
                </tr>
                <tr>
                    <td>教&nbsp;&nbsp;龄：</td>
                    <td><input type="text" name="teachage" value="" /></td>
                </tr>
                 <tr>
                    <td>评论数：</td>
                    <td><input type="text" name="evalutioncount" value="219"/></td>
                </tr>
                <tr>
                    <td>驾照类型</td>
                    <td><input type="text" style="font-size: 10px;width: 170px" name="jtype" placeholder="例如:C(多个用英文逗号隔开)"/></td>
                </tr>
                 <tr>
                    <td>最低价：</td>
                    <td><input type="text" name="minprice"  placeholder="例如：5900"/></td>
                </tr>
                <tr>
                    <td>原价</td>
                    <td><input type="text" name="highprice"  placeholder="例如:7800"/></td>
                </tr>
                 <tr>
                    <td>总学员数：</td>
                    <td><input type="text" name="allcount"  value="332" /></td>
                </tr>
                 <tr>
                    <td>已通过人数：</td>
                    <td><input type="text" name="passedcount"  value="229"/></td>
                </tr>
                <tr>
                    <td>地&nbsp;&nbsp;址：</td>
                    <td><input type="text" name="address" style="font-size: 10px;width: 200px"  placeholder="例如：上海市宝山区淞发路淞南五村"/>
                    </td>
                </tr>
                <tr>
                    <td>计时培训：</td>
                    <td>
                        <label><input type="radio"  name='timing' value=1 />支持</label>　
                        <label><input type="radio"   name='timing' value=0 checked/>不支持</label>
                    </td>
                </tr>
                <tr>
                    <td>首页特价</td>
                    <td>
                        <label><input type="radio"  name='week' value=1 />支持</label>　
                        <label><input type="radio" name='week' value=0 checked/>不支持</label>
                    </td>
                </tr>
                <tr>
                    <td>首页热门</td>
                    <td>
                        <label><input type="radio"  name='hot' value=1 />支持</label>　
                        <label><input type="radio" name='hot' value=0 checked/>不支持</label>
                    </td>
                </tr>
                <tr>
                    <td>首页推荐</td>
                    <td>
                        <label><input type="radio"  name='recommand' value=1 />支持</label>　
                        <label><input type="radio" name='recommand' value=0 checked/>不支持</label>
                    </td>
                </tr>
                <tr>
                    <td>排序：</td>
                    <td>
                        <label><input type="text"  name='order' value='0' /></label>　
                    </td>
                </tr>
                <tr>
                    <td>指导员头像</td>
                    <td>
                        <div class="usercity" style="border:3px dashed #e6e6e6;width:300px;height:200px;position: relative;margin-bottom: 15px">
                            <p id="preview1" ><img id="imghead1" border=0 src='' ></p><span></span>
                            <input type="file" id="image0" name="image" onchange="previewImage(this,'preview1','imghead1')" style="display:none;" >
                            <label for="image0"  style="margin:50px 20px;color:#fff;text-align:center;border-radius:4px;
                                width:110px;height:26px;line-height:26px;font-size:14px;background:rgb(19, 181, 177);padding:6px 10px;
                                cursor:pointer;box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);">点击选择主图</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>指导员简介：</td>
                    <td>
                        <textarea name="introduction" id="content7"  style="padding-left:70px;height:250px;visibility:hidden;"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" id="submit" value="保存更新">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){
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
        $('#searchresult').empty();
    }
</script>
<script>
    function previewImage(file,pre,imag) {
        var MAXWIDTH  = 100;
        var MAXHEIGHT = 130;
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
<script>

    var change=function(sel){
        var city=sel.value;
        $("#cityid").val(city);
    };

    $(function(){
        $('#school_id').click(function(){
                layer.open({
                    type:2, shade:true,
                    title:"请勾选驾校",//false为不显示标题
                    area:["600px",'600px'],
                    content:"<?php echo U('Admin/Coach/school');?>?cityid="+$("#cityid").val()
                    +'&p='+$("#p").val()+'&pid='+$("#pid").val()+"&type=zd"
                });
        });
    });

    $(function(){
        var validate=$('#form1').validate({
            rules:{
                account:{required:true}, nickname:{required:true},
                minprice:{required:true}, highprice:{required:true},
                jtype:{required:true}, school_nickname:{required:true},
                address:{required:true}, age:{required:true, rangelength:[1,2]},
                driverage:{required:true, rangelength:[1,2]}, teachage:{required:true, rangelength:[1,2]},
                numberId:{required:true}, serialId:{required:true}, driverId:{required:true}
            },
            messages:{
                account:{required:' * 必填项！'}, nickname:{required:' * 必填项！'},
                minprice:{required:' * 必填项！'}, highprice:{required:' * 必填项！'},
                jtype:{required:' * 必填项！'}, school_nickname:{required:' * 必填项！'},
                address:{required:' * 必填项！'}, age:{required:' * 必填项！', rangelength:' * 长度为1-2！'},
                numberId:{required:' * 必填项！'}, driverage:{required:' * 必填项', rangelength:' * 长度为1-2！'},
                teachage:{required:' * 必填项！', rangelength:' * 长度为1-2！'}, serialId:{required:' * 必填项！'},
                driverId:{required:' * 必填项！'}
            },
            success:function(span){
                span.addClass('ok').text(' * ok')
            },
            validClass:'ok',
            errorElement:'span'
        });
        $(window).keydown(function(event){
            if(event.keyCode==13){
                $('#form1').submit();
            }
        });
        $('#form1').submit();

        $("#submit").click(function(){
            if(validate.form()){
                $(this).attr('disabled',true);
                $('#form1').ajaxSubmit(function(res){
                    if(res.status){
                        layer.msg(res.info,{icon:6,time:2000},function(){
                            location.href=res.url;
                        })
                    }else{
                        layer.msg(res.info,{icon:5,time:2000},function(){
                            location.href=res.url;
                        })
                    }
                },'json');
                return false;
            }
        });
    });
</script>