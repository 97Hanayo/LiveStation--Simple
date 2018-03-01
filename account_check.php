<?php
include_once "db/conn.php";
require_once "db/Smtp.class.php";

$db = getDB();

@$username = $_POST['username'];
@$email = $_POST['email'];
@$password = $_POST['password'];
@$passwordcheck = $_POST['repwd'];
@$QQ = $_POST['QQ'];
@$answer = $_POST['answer'];
@$regdate = time();  

@$token = MD5($username.$regdate);
@$token_exptime = time()+60*60*24;

if(isset($_POST['submit'])){
	$checkuser = $db->prepare("select username from live where username=?");
	$checkuser->bindParam(1,$username);
	$checkuser->execute();
	$checkemail = $db->prepare("select email from live where email=?");
	$checkemail->bindParam(1,$email);
	$checkemail->execute();
	$checkQQ = $db->prepare("select QQ from live where QQ=?");
	$checkQQ->bindParam(1,$QQ);
	$checkQQ->execute();
	if(!preg_match('/^[a-zA-Z0-9_-]{4,16}$/', $username)){  
echo"<script>alert('用户名不符合规定呢');location='javascript:history.go(-1)';</script>";
}   
	elseif(strlen($password) < 8){  
    echo"<script>alert('密码不符合规定呢');location='javascript:history.go(-1)';</script>";  
}  
	elseif(!preg_match('/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/i', $email)){  
    echo"<script>alert('邮箱格式不对');location='javascript:history.go(-1)';</script>";  
} 
	elseif($checkuser->fetch(1)){
		echo"<script>alert('用户名有一样的呢');location='javascript:history.go(-1)';</script>";
	}
	elseif($checkemail->fetch(1)){
		echo"<script>alert('邮箱有一样的呢');location='javascript:history.go(-1)';</script>";
	}
	elseif($checkQQ->fetch(1)){
		echo"<script>alert('QQ有一样的呢');location='javascript:history.go(-1)';</script>";
	}
	elseif($password!=$passwordcheck){  
    	echo"<script>alert('密码没打对对啦');location='javascript:history.go(-1)';</script>";  
	}else{
		$password = MD5($password);  
		$answer = MD5($answer);
		$sql = "insert into live(username,email,password,QQ,answer,token,token_exptime,regdate) values(?,?,?,?,?,?,?,?)";
		$stmt=$db->prepare($sql);
		$stmt->bindParam(1,$username);
		$stmt->bindParam(2,$email);
		$stmt->bindParam(3,$password);
		$stmt->bindParam(4,$QQ);
		$stmt->bindParam(5,$answer);
		$stmt->bindParam(6,$token);
		$stmt->bindParam(7,$token_exptime);
		$stmt->bindParam(8,$regdate);
		$stmt->execute();
		$db = null;
		
		include('mail_send.php');

		echo "<script>alert('注册成功啦!要赶快去验证邮箱呢');window.location.href='email_check.php';</script>";
	}
	
}
//else{ 
//	echo"<script>alert('注册失败');location='javascript:history.go(-1)';</script>";
//}	
	

?>