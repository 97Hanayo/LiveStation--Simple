<?php
	include_once ("db/conn.php");
	$db = getDB();
if(isset($_POST['update'])){    
		@$ID = $_GET['ID'];
		@$email_active = $_POST['active'];
		@$indexshow = $_POST['indexshow'];
		@$livestats = $_POST['live'];
		$stmt = $db->prepare("update live set email_active=?,indexshow=?,livestats=? where ID=?");
		$stmt->bindparam(1,$email_active);
		$stmt->bindparam(2,$indexshow);
		$stmt->bindparam(3,$livestats);
		$stmt->bindparam(4,$ID);
		$stmt->execute();
		echo "<script>location='javascript:history.go(-1)';</script>";
	}
?>