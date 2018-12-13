<?php
	include_once "db/conn.php";
	session_start();
	$db = getDB();
	@$username = $_POST["username"];
	@$password = MD5($_POST["password"]);
	
	$sql = "select username,password from live where username=? and password=?";
	$result = $db->prepare($sql);
	$result->bindparam(1,$username);
	$result->bindparam(2,$password);
	$result->execute();
	
	$sql1 = "select username from live where username=Hanayo and master=1";
	$result1 = $db->query($sql);
	
	if(isset($_POST['submit'])){
		if($result->rowCount() == 0){
		unset($_SESSION['username']);
		echo "<script>alert('是不是账号密码哪个不太对呢');location='javascript:history.go(-1)';</script>";
		exit();
		session_unset();
		session_destroy();
		}else{
			$row = $result->fetch(1);
				$_SESSION['username'] = $row['username'];
				$session_id = session_id();
				setcookie('PHPSESSID', $session_id, time()+7*24*3600);
			echo "<script>location='javascript:history.go(-1)';</script>";
	//header("Location:index.php");
		}
	}
	@$action = $_GET['action'];
	
//注销登陆
	if($action=="logout"){
		unset($_SESSION['username']);
		unset($_SESSION['gwc']);
		echo "<script>alert('下次还记得过来玩哦');location='javascript:history.go(-1)';</script>";
}
?>
