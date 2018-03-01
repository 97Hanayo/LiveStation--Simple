<?php
	include_once "db/conn.php";
	$db = getDB();
	@$email = $_POST['email'];
	@$QQ = $_POST['QQ'];

	$sql = "select username,email,QQ from live where email='$email' and QQ='$QQ'";
	$query = mysqli_query($aVar,$sql); 
	$num = mysqli_num_rows($query); 
	$row = mysqli_fetch_array($query);
	
	if($num==0){
		echo "<script>alert('似乎没有找到你的邮箱或QQ(；′⌒`)');location='javascript:history.go(-1)';</script>";
		exit;
	}else{
		echo "<script>alert('你的用户名是".$row['username']."，不要再忘了啊(ノ｀Д)ノ');location='javascript:history.go(-1)';</script>";
		}
	
?>