<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="mdui-v0.4.0/css/mdui.css" />
		<script src="mdui-v0.4.0/js/mdui.js" ></script>
		<meta charset="UTF-8">
		<title>新年快乐！</title>
	</head>
	<body class="padding-top mdui-appbar-with-toolbar ">
	<?php
		include('navi.php');
	?>

<?php
	include_once('db/conn.php');
	$verify = stripslashes(trim($_GET['verify'])); 
	$nowtime = time(); 
	$query = mysqli_query($aVar,"select ID,token_exptime,email_active from live where `token`='$verify'"); 
	$row = mysqli_fetch_array($query); 
	if($row){ 
    	if($nowtime>$row['token_exptime']){ //24hour 
      	    $msg = '您的激活有效期已过，请登录您的帐号重新发送激活邮件.'; 
    	}else{ 
        	mysqli_query($aVar,"update live set email_active='checked' where ID=".$row['ID']); 
        	if(mysqli_affected_rows($aVar)!=1) die(0); 
        	echo "<div class='mdui-center' style='margin-top:30px;width:1132px;height:623px;background:url(img/active.png)'></div>"; 
    	} 
	}else{ 
    	echo "<div class='mdui-center' style='margin-top:30px;width:1132px;height:623px;background:url(img/error.png)'></div>";     
	} 
?>
	</body>
</html>
