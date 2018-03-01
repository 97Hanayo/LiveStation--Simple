<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="pic/css/bootstrap.min.css">
		<link rel="stylesheet" href="pic/css/cropper.css">
		<link rel="stylesheet" href="pic/css/main.css">
		<link rel="stylesheet" href="mdui-v0.4.0/css/mdui.css">
		<meta charset="UTF-8">
		<title>自己的家</title>
	</head>
	<body class="padding-top mdui-appbar-with-toolbar">
		<?php
			session_start();
			@$username=$_SESSION["username"];
			include_once ("db/conn.php");
			$db = getDB();
			$sql = "select ID,username,email,email_active,QQ,pic,bk,userdetail,rtmp_url,livedetail,livestats,type from live where username='$username'";
			$query = mysqli_query($aVar,$sql); 
			$row = mysqli_fetch_array($query);
			include('navi.php');
			if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
   			
   			include('account.php');
   			
			}else{  ?>
				<div class="mdui-color-pink-accent mdui-center" style="height: 60px;width: 700px;">
					<h1 class="mdui-p-t-2 mdui-p-l-2">你都还没有登录( ఠൠఠ )ﾉ</h1>
				</div>
			<form method="post" action="login.php">
			<div class="mdui-center mdui-m-t-3" style="width: 600px;height: 200px;">
				<div class="mdui-textfield mdui-textfield-floating-label">
  					<label class="mdui-textfield-label">用户名</label>
  					<input class="mdui-textfield-input" type="text" name="username" id="username">
				</div>
				<div class="mdui-textfield mdui-textfield-floating-label">
  					<label class="mdui-textfield-label">密码</label>
  					<input class="mdui-textfield-input" type="password" name="password" id="password">
				</div>
				<button class="mdui-btn mdui-ripple mdui-color-pink mdui-m-t-2" type="submit" name="submit">登录</button>
			</div>
			</form>
			<?php
		}
		?>
	</body>
</html>
<script src="mdui-v0.4.0/js/mdui.min.js"></script>