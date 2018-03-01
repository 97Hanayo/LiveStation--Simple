<?php
	session_start();
	@$username=$_SESSION["username"];
	include_once "db/conn.php";
	$db = getDB();
	
	error_reporting(0);//禁用错误报告  
	if (IS_POST) {
		header('Content-type:text/html;charset=utf-8');
		$base64_image_content = $_POST['imgBase'];
		//将base64编码转换为图片保存
		if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
			$type = $result[2];
			$new_file = "./img/pic/";
            $img=time() . ".{$type}";
            $new_file = $new_file . $img;
            //将图片保存到指定的位置
            if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)))) {
            	echo 'true';
            	$pic = "img/pic/";
				$pic_name = $pic . $img;
				$query = mysqli_query($aVar,"select pic from live where username='$username'"); 
				mysqli_query($aVar,"update live set pic='$pic_name' where username='$username'");
            }else{
            	echo 'false';
            }
		}else{
			echo 'false';
		}
	}


?>