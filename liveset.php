<?php
	session_start();
	@$username = $_SESSION['username'];
    require_once "db/conn.php";
    $db = getDB();
	$sql = "select indexshow,guestsay,type from live where username='$username'";
	$query = mysqli_query($aVar,$sql); 
	$row = mysqli_fetch_array($query);
    if(isset($_POST['room'])){
    	@$indexshow = $_POST['indexshow'];
    	@$guestsay = $_POST['guestsay'];
    	@$type = $_POST['type'];
    	$stmt = $db->prepare("update live set indexshow=?,guestsay=?,type=? where username=?");
    	$stmt->bindparam(1,$indexshow);
    	$stmt->bindparam(2,$guestsay);
    	$stmt->bindparam(3,$type);
    	$stmt->bindparam(4,$username);
    	$stmt->execute();
		if(mysqli_affected_rows($aVar)!=1) die(0); 
        	echo "<script>alert('房间设置完成');location='javascript:history.go(-1)';</script>"; 
    }
?>