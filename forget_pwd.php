<?php
	include_once "db/conn.php";
	require_once "db/Smtp.class.php";
	$db = getDB();
	@$email = $_POST['email'];
	@$answer = MD5($_POST['answer']);

	$sql = "select username,password,email,answer from live where email='$email' and answer='$answer'";
	$query = mysqli_query($aVar,$sql); 
	$num = mysqli_num_rows($query); 
	$row = mysqli_fetch_array($query);
	
	if($num==0){
		echo "<script>alert('似乎没有找到你的邮箱或提示(；′⌒`)');location='javascript:history.go(-1)';</script>";
		exit;
	}else{
		$username = $row['username'];
		$pwdtoken = MD5($email.$answer);
		$resetpwdtime = time()+60*60;
		$stmt = $db->prepare("update live set pwdtoken=?,resetpwdtime=? where username=?");
		$stmt->bindparam(1,$pwdtoken);
		$stmt->bindparam(2,$resetpwdtime);
		$stmt->bindparam(3,$username);
		$stmt->execute();
		
	$smtpserver = "#";//SMTP服务器
	$smtpserverport =465;//SMTP服务器端口
	$smtpusermail = "#";//SMTP服务器的用户邮箱
	$smtpemailto = $email;//发送给谁
	$smtpuser = "#";//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
	$smtppass = "#";//SMTP服务器的用户密码
    $users = array($email);
    $mailtitle = '这是一个重置密码的邮件';
    $mailcontent = "你为什么会忘记密码啊(σ｀д′)σ<br/>这个是给你重置的链接<br/>
    <a href='/resetpwd.php?verify=".$pwdtoken."' target=
'_blank'>/resetpwd.php?verify=".$pwdtoken."</a><br/>
    保质期一小时，过期就不能再用了";
    $mailtype = "HTML";
    $smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
		
		echo "<script>alert('修改密码的邮件已经发出去了呢，不要再忘记啦(ノ｀Д)ノ');window.location.href='index.php';</script>";
		}
	
?>