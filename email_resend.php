<?php
	include "db/conn.php";
	require_once "db/Smtp.class.php";
	session_start();
	$db = getDB();
	@$username = $_SESSION["username"];
	@$token_exptime = time()+60*60*24;
	@$action = $_GET['action'];
	@$regdate = time();  
	@$token = MD5($username.$regdate);
	$sql = "select ID,username,email,QQ,pic,token,token_exptime from live where username='$username'";
	$query = mysqli_query($aVar,$sql); 
	$row = mysqli_fetch_array($query);
	$email = $row['email'];
	$token = $token;
	if($action=="resend"){
		include_once('mail_send.php');
		mysqli_query($aVar,"update live set token_exptime='$token_exptime',token='$token' where username='$username'"); 
		echo "<script>alert('已经重新发送了呢');window.location.href='email_check.php';</script>";
	}
?>