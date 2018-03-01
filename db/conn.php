//自行修改dbname, dbpassword
//dbuser默认为root
<?php
function getDB(){
	$dsn = "mysql:host=localhost:3306;dbname=test";
	$db = new PDO($dsn,"root","dbpassword");
//	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->query("set names utf8");
	
	return $db;
}
$aVar = mysqli_connect('localhost','root','dbpassword','dbname');
?>