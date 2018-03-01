<?php
	session_start();
	@$username=$_SESSION["username"];
	include_once "db/conn.php";
	$db = getDB();
	
    $imgname = $_FILES['bkg']['name'];
    $tmp = $_FILES['bkg']['tmp_name'];
    $filepath = 'img/bkg/';
    $bk = $filepath . $imgname;
    if(move_uploaded_file($tmp,$filepath.$imgname)){
		$query = mysqli_query($aVar,"select bk from live where username='$username'"); 
		mysqli_query($aVar,"update live set bk='$bk' where username='$username'");
        echo "<script>alert('修改背景完成啦');window.location.href='personal.php';</script>";
    }else{
        echo "<script>alert('好像发生了未知的错误呢');window.location.href='personal.php';</script>";
    }
?>