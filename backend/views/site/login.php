<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>
<style>
    body {
        font: 12px/1.5 "Microsoft YaHei", tahoma, arial, Hiragino Sans GB, \5b8b\4f53;
        overflow: hidden;
        height: 100%;
        width: 100%;
    }
    /*slide*/
    .front, .items, .item {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: -1;
    }

    .back {

        width: 50%;
        overflow: hidden;
    }

    .items {
        overflow: visible;
    }

    .item {
        background: #fff none no-repeat center center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        display: none;
    }
</style>
<div class="back">
    <div class="items">
        <div class="item item1" style="background-image: url(/images/bg.jpg); display: block;"></div>
        <div class="item item2" style="background-image: url(/images/bg1.jpg); display: block;"></div>
        <div class="item item3" style="background-image: url(/images/bg2.jpg); display: block;"></div>
        <div class="item item3" style="background-image: url(/images/bg3.jpg); display: block;"></div>
    </div>
</div>
<div class="login-box">
  <div class="login-logo">
    <a href="<?=Url::toRoute('site/login')?>">后台管理系统</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">请登录管理系统</p>
	<?php $form = ActiveForm::begin(['id' => 'login-form', 'action'=>Url::toRoute('site/login')]); ?>
    <!-- <form action="../../index2.html" method="post">   -->
      <div class="form-group has-feedback">
        <input name="username" id="username" type="text" class="form-control" placeholder="用户名" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" id="password" type="password" class="form-control" placeholder="密码">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input name="remember" id="remember" value="y" type="checkbox" /> &nbsp;记住我的登录
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button id="login_btn" type="button" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
        <!-- /.col -->
      </div>
    <!-- </form>  -->
    <?php ActiveForm::end(); ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>
    /*var bodyBgs = [];
    bodyBgs[0] = "/images/bg.jpg";
    bodyBgs[1] = "/images/bg1.jpg";
    bodyBgs[2] = "/images/bg2.jpg";
    bodyBgs[3] = "/images/bg3.jpg";
    var body=document.getElementsByTagName('body')[0];
    body.style.background='url("/images/bg.jpg") no-repeat 50% 0';
    setInterval(function (){
        var randomBgIndex = Math.round( Math.random() * 3 );
        body.style.background='url(' + bodyBgs[randomBgIndex] + ') no-repeat 50% 0';
    },4000);
    */
$('#login_btn').click(function (e) {
    e.preventDefault();
	$('#login-form').submit();
});
$('#login-form').bind('submit', function(e) {
	e.preventDefault();
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: "<?=Url::toRoute('site/login')?>",
    	success: function(value) 
    	{
        	if(value.errno == 0){
        		window.location.reload();
        	}
        	else{
            	$('#username').attr({'data-placement':'top', 'data-content':'<span class="text-danger">用户名或密码错误</span>', 'data-toggle':'popover'}).addClass('popover-show').popover({html : true }).popover('show');
        	}

    	}
    });
});
</script>
<script>

    var slideEle = slider($('.items'));

    function slider(elem) {
        var items = elem.children(),
            max = items.length - 1,
            animating = false,
            currentElem,
            nextElem,
            pos = 0;

        sync();

        return {
            next: function () {
                move(1);
            },
            prev: function () {
                move(-1);
            },
            itemsNum: items && items.length
        };

        function move(dir) {
            if (animating) {
                return;
            }
            if (dir > 0 && pos == max || dir < 0 && pos == 0) {
                if (dir > 0) {
                    nextElem = elem.children('div').first().remove();
                    nextElem.hide();
                    elem.append(nextElem);
                } else {
                    nextElem = elem.children('div').last().remove();
                    nextElem.hide();
                    elem.prepend(nextElem);
                }
                pos -= dir;
                sync();
            }
            animating = true;
            items = elem.children();
            currentElem = items[pos + dir];
            $(currentElem).fadeIn(1000, function () {
                pos += dir;
                animating = false;
            });
        }

        function sync() {
            items = elem.children();
            for (var i = 0; i < items.length; ++i) {
                items[i].style.display = i == pos ? 'block' : '';
            }
        }

    }

    if (slideEle.itemsNum && slideEle.itemsNum > 1) {
        setInterval(function () {
            slideEle.next();
        }, 6000)
    }
</script>
