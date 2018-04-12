<?php

 $corf=Yii::$app->request->csrfToken;
 use yii\helpers\Json;
 if(isset($uid['id']) and !empty($uid['id']) and $uid['id']==394){
     $num=count($member);
 }else{
     $num=$number+400;
 }

?>
<html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <title>中和商城</title>
    <meta name="keywords" content="前端js在线聊天" />
    <meta name="description" content="前端js在线聊天" />
    <link rel="stylesheet" type="text/css" href="/css/chat.css" />
    <link rel="stylesheet" type="text/css" href="/css/popups.css" />
    <script>
        <?php
        if(isset($uid['id']) and !empty($uid['id'])){
            echo 'window.id="'.$uid['id'].'";';
        }else{
            echo 'window.id=0;';
        }
        if(isset($_GET['token']) and !empty($_GET['token'])):
                    echo 'window.token="'.$_GET['token'].'";';
                endif;
                if(isset($uid['alias']) and !empty($uid['alias'])){
                    $name=$uid['alias'];
                   echo 'window.uname="'.$uid['alias'].'";';
                }elseif(isset($uid['nickname']) and !empty($uid['nickname'])){
                    $name=$uid['nickname'];
                    echo 'window.uname="'.$uid['nickname'].'";';
                }else{
                    $name="游客";
                    echo 'window.uname="'.'游客'.'";';
                }

        if(!empty($uid['portrait'])){
            echo 'window.portrait="/portrait/'.$uid['portrait'].'";';
        }else{
            echo 'window.portrait="'.'/portrait/1.jpg'.'";';
        }

        ?>
    </script>
    <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/js/chat.js"></script>
    <script type="text/javascript" src="/js/popups.js"></script>
    <!--[if lt IE 7]>
    <script src="js/IE7.js" type="text/javascript"></script>
    <![endif]-->
    <!--[if IE 6]>
    <script src="/js/iepng.js" type="text/javascript"></script>
    <script type="text/javascript">
        EvPNG.fix('body, div, ul, img, li, input, a, span ,label');
    </script>
    <![endif]-->
</head>
<body>
<audio src="/bgm/bgm.mp3" preload="auto" id="bgm"></audio>
<div class="content">
    <div class="chatBox">
        <div class="chatLeft">
            <div class="chat01">
                <div class="chat01_title">
                    <ul class="talkTo">
                        <li><a href="javascript:;">聊天室</a></li>
                        <a class="close_btn" href="javascript:;"></a>
                        <li>在线人数:<font style="color:red;" id="num"><?=$num?></font>人</li>
                    </ul>

                </div>
                <div class="chat01_content">
                    <div class="message_box mes3" style="display: block;">
                        <?php foreach ($record as $val): /* if($val['uid'] == $uid['id']){ ?>

                            <div class='message clearfix'>
                                <div class='user-logo'><img src="/portrait/<?=$val['portrait']?>"></div>
                                <div class='wrap-text' >
                                    <h5 style='text-align:left' class='clearfix' ><?=$val['send_user']?>
                                        <div clsss='clearfix' style='float:left;'>
                                            <span><!---<?=date("Y-m-d H:i:s",$val['create'])?>---></span>
                                        </div>
                                    </h5>
                                    <div class="content-text"><?php $data=Json::decode(base64_decode($val['content']));echo $data['msg'];?></div>
                                </div>
                            <div style='clear:both;'></div>
                            </div>
                        <?php }else{   */ ?>
                            <div class='message clearfix'>
                                <div class='user-logo2'><img src="/portrait/<?=$val['portrait']?>"></div>
                                <div class="wrap-text2">
                                    <h5 style='text-align: left' class='clearfix' >
                                        <?=$val['send_user']?>
                                        <div clsss='clearfix' style='float:right;'>
                                            <span><!---<?=date("Y-m-d H:i:s",$val['create'])?>---></span>
                                        </div>
                                    </h5>
                                    <div class="content-text"><?php $data=Json::decode(base64_decode($val['content']));echo $data['msg'];?></div>
                                </div>
                                <div style='clear:both;'></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="chat02">
                <div class="chat02_title">
                    <a class="chat02_title_btn ctb01" href="javascript:;"></a>
                    <a class="chat02_title_btn ctb02"   href="javascript:;" title="选择文件">
                        <input type="file" id="img"  style="opacity:0;width:5px">
                    </a>
                    <!----  <label class="chat02_title_t">
                        <a href="chat.htm" target="_blank"></a></label>--->
                    <div class="wl_faces_box">
                        <div class="wl_faces_content">
                            <div class="title">
                                <ul>
                                    <li class="title_name">常用表情</li><li class="wl_faces_close"><span>&nbsp;</span></li>
                                    <li class="title_name2">微信头像</li><li class="wl_faces_close"><span>&nbsp;</span></li>
                                </ul>

                            </div>
                            <!-----------常用表情---------------->
                            <div class="wl_faces_main">
                                <ul>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_01.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_02.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_03.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_04.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_05.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_06.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_07.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_08.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_09.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_10.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_11.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_12.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_13.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_14.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_15.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_16.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_17.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_18.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_19.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_20.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_21.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_22.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_23.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_24.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_25.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_26.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_27.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="img/emo_28.gif" /></a></li><li><a href="javascript:;">
                                            <img src="img/emo_29.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_30.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_31.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_32.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_33.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="img/emo_34.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_35.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_36.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_37.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_38.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_39.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_40.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_41.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_42.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_43.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_44.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_45.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_46.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_47.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_48.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_49.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_50.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_51.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_52.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_53.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_54.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_55.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_56.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_57.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_58.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_59.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_60.gif" /></a></li>
                                </ul>
                            </div>
                            <!----------------------------- 微信---------------------------->
                            <div class="wl_faces_main" style="display:none;">
                                <ul>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_01.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_02.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_03.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_04.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_05.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_06.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_07.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_08.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_09.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_10.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_11.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_12.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_13.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_14.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_15.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_16.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_17.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_18.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_19.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_20.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_21.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_22.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_23.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_24.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_25.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_26.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_27.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="img/emo_28.gif" /></a></li><li><a href="javascript:;">
                                            <img src="img/emo_29.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_30.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_31.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_32.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_33.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="img/emo_34.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_35.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_36.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_37.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_38.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_39.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_40.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_41.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_42.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_43.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_44.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_45.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_46.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_47.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_48.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_49.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_50.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_51.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_52.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_53.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_54.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_55.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_56.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_57.gif" /></a></li>
                                    <li><a href="javascript:;">
                                            <img src="/img/emo_58.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_59.gif" /></a></li><li><a href="javascript:;">
                                            <img src="/img/emo_60.gif" /></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="wlf_icon">
                        </div>
                    </div>
                    <a style="float:right"><li id="demo4">用户:<?=$name?></li></a>
                </div>
                <div style="clear: both"></div>
                <div class="chat02_content">
                    <textarea id="textarea"></textarea>
                </div>
                <div class="chat02_bar">
                    <ul>
                        <li style="left: 20px; top: 10px; padding-left: 30px;">聊天室，24小时在线为您服务！</li>
                        <li style="right: 5px; top: 5px;"><a href="javascript:;">
                                <img src="/img/send_btn.jpg"></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="chatRight">
            <div class="chat03">
                <div class="chat03_title">
                    <label class="chat03_title_t">
                        当前在线成员</label>
                </div>
                <div class="chat03_content">
                    <ul>
                        <?php foreach ($member as $val):?>
                            <li class="member">
                                <img src="/portrait/<?=$val['portrait']?>">&nbsp;<?=$val['name']?>
                            </li>
                        <?php endforeach;  ?>
                    </ul>
                </div>
                <div class="chat03_content2">
                    <ul>
                        <?php foreach ($randname as $name):?>
                            <li class="member">
                                <img src="/portrait/<?=$name[0]?>">&nbsp;<a href="javascript:;" ><?=$name[1]?></a>
                            </li>
                        <?php endforeach;  ?>
                    </ul>
                </div>
            </div>
        </div>
        <div style="clear: both;">
        </div>
    </div>
</div>
<canvas id="output" style="display:none;"></canvas>
<img id="images" src="" style="display:none;">
<script type="text/javascript">
    window.imagedata={};
   $("#img").change(function (){
        var filename=$("#img").attr('value');
        if(!checkFileExt(filename)){
            alert('图片子支持jpg，png，gif');
            return;
        }
       var formData = new FormData();
       var name = $("input").val();
       formData.append("img",$("#img")[0].files[0]);
       formData.append("_csrf-frontend","<?=$corf?>");
       $.ajax({
           url : '<?=\yii\helpers\Url::to(['site/up'])?>',
           type : 'POST',
           data : formData,
           dataType:'json',
            // 告诉jQuery不要去处理发送的数据
           processData : false,
            // 告诉jQuery不要去设置Content-Type请求头
           contentType : false,
           success:function (data){
               if(data.code){
                   $("#textarea").val($("#textarea").val()+"*{"+data.msg+"}*");
                   return;
               }
               alert(data.msg);
               return ;
           }
       });

   });
   function checkFileExt(filename)
   {
       var flag = false; //状态
       var arr = ["jpg","png","gif"];
       //取出上传文件的扩展名
       var index = filename.lastIndexOf(".");
       var ext = filename.substr(index+1);
       //循环比较
       for(var i=0;i<arr.length;i++) {
           if(ext == arr[i]) {
               flag = true; //一旦找到合适的，立即退出循环
               break;
           }
       }
       //条件判断
       if(flag) {
           return true;
       }else {
           return false;
       }
   }

   $(".title_name").click(function (){
       $(this).css('bottom',0);
       $(".title_name2").css('bottom',1);
       $(".wl_faces_main").eq(0).css('display','block');
       $(".wl_faces_main").eq(1).css('display','none');
   });

    $(".title_name2").click(function (){
        $(this).css('bottom',0);
        $(".title_name").css('bottom',1);
        $(".wl_faces_main").eq(0).css('display','none');
        $(".wl_faces_main").eq(1).css('display','block');
    });
    /**
     * 弹窗
     *
     */
    setSize();
    addEventListener('resize',setSize);
    function setSize() {
        document.documentElement.style.fontSize = document.documentElement.clientWidth/750*100+'px';
    }
    $('#demo4').click(function () {
        jqalert({
            title:'修改用户名',
            prompt:'当前用户名',
            yestext:'修改',
            notext:'取消',
            yesfn:function () {
                test=$("#content").val();
                if(!test){
                    alert("用户名不能为空");
                    return ;
                }
                if(!window.id){
                    alert('请先登陆');
                    return ;
                }
                $.ajax({
                    url : '<?=\yii\helpers\Url::to(['site/re-alias'])?>',
                    type : 'get',
                    data : {id:window.id,alias:test},
                    dataType:'json',
                    success:function (data){
                        if(data.code){
                           window.location.reload();
                           return ;
                        }
                        alert(data[0]);
                        return ;
                    }
                });
            },
            nofn:function () {
                jqtoast('你点击了取消');
            }
        })
    })
</script>
</body>
</html>
