<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="mdui-v0.4.0/css/mdui.css" />
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body class="padding-top mdui-appbar-with-toolbar">
	<?php
		include('navi.php');
		require_once "db/conn.php";
	$verify = stripslashes(trim($_GET['verify'])); 
	$nowtime = time(); 
	$query = mysqli_query($aVar,"select ID,resetpwdtime from live where `pwdtoken`='$verify'"); 
	$row = mysqli_fetch_array($query); 
	if($row){ 
    	if($nowtime>$row['resetpwdtime']){ //1hour 
      	    echo "<script>alert('您的激活有效期已过，请登录您的帐号重新发送激活邮件.');location='javascript:history.go(-1)';</script>"; 
    	}else{ 
    		include('pwd.php');
			$db = getDB();
    		if(isset($_POST['submit'])){
    			@$password = $_POST['password'];
				@$passwordcheck = $_POST['repwd'];
					if($password!=$passwordcheck){  
    					echo"<script>alert('密码没打对对啦');location='javascript:history.go(-1)';</script>";  
	}		else{
				@$password = MD5($password);
        		$stmt = $db->prepare("update live set password=? where ID=?");
        		$stmt->bindparam(1,$password);
        		$stmt->bindparam(2,$row['ID']);
        		$stmt->execute();
        		if(mysqli_affected_rows($aVar)!=1) die(0); 
        		echo "<script>alert('改好了改好了(ง •_•)ง');window.location.href='index.php';</script>"; 
        	}
    	} 
	}
}
?>
		<script src="mdui-v0.4.0/js/mdui.js" ></script>
	</body>
</html>