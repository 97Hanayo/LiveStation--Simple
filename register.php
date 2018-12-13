<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="bootstrap-material-design-4.0.0-beta.4/css/bootstrap-material-design.css">
		<link rel="stylesheet" href="mdui-v0.4.0/css/mdui.css">
		<meta charset="UTF-8">
		<title>做这种事绝对很奇怪啊</title>
	</head>
	<body class="padding-top mdui-appbar-with-toolbar">

	<?php
		include('navi.php');
	?>
			
		<form class="mdui-center" style="width: 500px;height: 800px;margin-top: 10px;padding-top: 30px;" method="post" action="account_check.php">
			<h2>契约书</h2>
			<div class="form-group">
    			<label for="username">用户名</label>
    			<input type="text" class="form-control" name="username" placeholder="4-16个字母，数字，下划线，减号哦" required="required">
  			</div>
  			<div class="form-group">
    			<label for="email">电子邮箱</label>
    			<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="example@scse.com.cn" required="required">
    			<small id="emailHelp" class="form-text text-muted">只能用华软邮箱哦不然会收不到验证码呢</small>
  			</div>
  			<div class="form-group">
    			<label for="pwd">密码</label>
    			<input type="password" class="form-control" name="password" placeholder="包含大小写字母，数字，长度不小于八位" required="required">
  			</div>
  			<div class="form-group">
    			<label for="repwd">再输入一次嘛</label>
    			<input type="password" class="form-control" name="repwd" placeholder="跟上面一样的那串东西" required="required">
  			</div>
  			<div class="form-group">
    			<label for="qq">企鹅</label>
    			<input type="number" class="form-control" name="QQ" placeholder="只能打数字哦" required="required">
  			</div>
  			<div class="form-group">
    			<label for="answer">忘记密码提示</label>
    			<input type="text" class="form-control" name="answer" placeholder="万一忘记密码了呢" required="required">
  			</div>
  			<div class="form-check">
    			<label class="mdui-checkbox mdui-m-t-1">
      				<input type="checkbox" class="form-check-input" required="required" mdui-dialog="{target: '#example-1'}">
      				<i class="mdui-checkbox-icon"></i>
      				<p mdui-dialog="{target: '#example-1'}">我同意《'Live--はな'直播网的条款》</p>
  					<div class="mdui-dialog" id="example-1">
    					<div class="mdui-dialog-title mdui-center">'Live--はな'直播网的注册条款</div>
    					<div class="mdui-dialog-content"><?php include('agreement.txt'); ?></div>
    					<div class="mdui-dialog-actions">
      						<button class="mdui-btn mdui-ripple" mdui-dialog-close>我知道了</button>
    					</div>
  					</div>
    			</label>
  			</div>
  			<button type="submit" name="submit" class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink">成为美少女</button>
		</form>
			
		<script src="mdui-v0.4.0/js/mdui.js" ></script>

	</body>
</html>