<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="mdui-v0.4.0/css/mdui.css" />
		<script src="mdui-v0.4.0/js/mdui.js" ></script>
		<meta charset="UTF-8">
		<title>你是パか吗ε=( o｀A′)ノ</title>
	</head>
	<body class="padding-top mdui-appbar-with-toolbar ">
	<?php
		include('navi.php');
	?>
		<div class="mdui-color-pink-accent mdui-center" style="height: 60px;width: 700px;">
				<h1 class="mdui-p-a-2">你怎么可以忘记这么重要的用户名呢ヽ（≧□≦）ノ</h1>
		</div>
		<form method="post" action="forget_acc.php">
		<div class="mdui-center" style="height: 235px;width: 700px;">
		<div class="mdui-textfield mdui-textfield-floating-label">
  			<label class="mdui-textfield-label">你的邮箱</label>
  			<input class="mdui-textfield-input" type="email" name="email">
		</div>
		<div class="mdui-textfield mdui-textfield-floating-label">
  			<label class="mdui-textfield-label">你的QQ</label>
  			<input class="mdui-textfield-input" type="QQ" name="QQ">
		</div><br><br>
		<button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink" type="submit" name="submit">你是大象！</button>
		</div>
		</form>
		<div class="mdui-color-pink-accent mdui-center" style="height: 60px;width: 700px;">
				<h1 class="mdui-p-a-2">你怎么可以忘记这么重要的密码呢&nbsp;&nbsp;&nbsp;&nbsp;ヽ（≧□≦）ノ</h1>
		</div>
		<form method="post" action="forget_pwd.php">
			<div class="mdui-center" style="height: 200px;width: 700px;">
			<div class="mdui-textfield mdui-textfield-floating-label">
  			<label class="mdui-textfield-label">你的邮箱</label>
  			<input class="mdui-textfield-input" type="email" name="email">
			</div>
			<div class="mdui-textfield mdui-textfield-floating-label">
  			<label class="mdui-textfield-label">你的密码提示</label>
  			<input class="mdui-textfield-input" type="text" name="answer"><br><br>
			<button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink" type="submit" name="submit">你是大象！</button>
			</div>
			</div>
		</form>
	</body>
</html>

