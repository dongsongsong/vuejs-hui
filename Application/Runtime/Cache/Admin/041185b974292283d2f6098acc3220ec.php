<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/lib/html5.js"></script>
<script type="text/javascript" src="/Public/lib/respond.min.js"></script>
<script type="text/javascript" src="/Public/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/Public/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/Public/css/H-ui.login.css" rel="stylesheet" type="text/css" />
<link href="/Public/css/style.css" rel="stylesheet" type="text/css" />
<link href="/Public/lib/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="/Public/lib/font-awesome/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="/Public/lib/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/Public/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
</head>
<body>

</body>
</html>
<title>后台登录 - H-ui.admin v2.2</title>
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="header"></div>
<div class="loginWraper">
  <div id="loginform" class="loginBox">
    <form class="form form-horizontal" action="index.html" method="post">
      <div class="row cl">
        <label class="form-label col-3"><i class="iconfont">&#xf00ec;</i></label>
        <div class="formControls col-8">
          <input id="name" name="username" type="text" placeholder="账户" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <label class="form-label col-3"><i class="iconfont">&#xf00c9;</i></label>
        <div class="formControls col-8">
          <input id="pass" name="password" type="password" placeholder="密码" class="input-text size-L">
        </div>
      </div>
      <div class="row cl">
        <div class="formControls col-8 col-offset-3">
          <input class="input-text size-L" type="text" id="code" name="code" placeholder="验证码" onblur="if(this.value==''){this.value='验证码:'}" onclick="if(this.value=='验证码:'){this.value='';}" value="验证码:" style="width:150px;">
          <img src="<?php echo U('Index/code');?>" width="200" height="40" onclick="this.src=this.src" id="yzm"></div>
      </div>
      <div class="row">
        <div class="formControls col-8 col-offset-3">
          <label for="online">
            <input type="checkbox" name="online" id="online" value="5">
            使我保持登录状态</label>
        </div>
      </div>
      <div class="row">
        <div class="formControls col-8 col-offset-3">
          <input type="button" onclick="check()" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
          <input type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
        </div>
      </div>
    </form>
  </div>
</div>
<div class="footer">Copyright system admin</div>
<script type="text/javascript" src="/Public/lib/jquery.min.js"></script> 
<script type="text/javascript" src="/Public/js/H-ui.js"></script> 
<script type="text/javascript" src="/Public/layer/layer.js"></script>
<script type="text/javascript">
function check(){
	var code = $.trim($("#code").val());
	var username=$("#name").val();
	var password = $("#pass").val();
	var online = $("input:checkbox:checked").val();
	var url = "<?php echo U('Index/login');?>";
	if(code==""||code=="验证码:"||username==""||password==""){
		layer.msg('用户名密码验证码都不能为空!', {icon: 5});
		return false;
	}
	$.post(url,{"code":code,"username":username,"password":password,"online":online},function(data){
		if(data=="1"){
			layer.msg('登陆成功！', {icon: 6});
			window.location.href="<?php echo U('Index/index');?>";
		}
		if(data=="-1"){
			layer.msg('验证码错误!', {icon: 5});
			$("#yzm").attr("src","<?php echo U('Index/code');?>");
		}
		if(data=="-2"){
			layer.msg('用户名或密码错误！',{icon: 5});
			$("#yzm").attr("src","<?php echo U('Index/code');?>");
		}
	})
}
</script>
</body>
</html>