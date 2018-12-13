<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="mdui-v0.4.0/css/mdui.css" />
		<script src="mdui-v0.4.0/js/mdui.js" ></script>
		<meta charset="UTF-8">
		<title>至高无上的</title>
	</head>
	<body class="padding-top mdui-appbar-with-toolbar ">
	<?php
		session_start();
		include_once ("db/conn.php");
		$db = getDB();
		@$username=$_SESSION["username"];
		$sql = "select ID,username,email,email_active,QQ,hls_url,indexshow,livestats from live";
		$query = mysqli_query($aVar,$sql); 
		$row = mysqli_fetch_array($query);
		$arr = $db->prepare($sql);
		$arr->execute();
		include('navi.php');
	?>
	<div style="width:100%;">
		<?php if(isset($_SESSION['username'])&&($_SESSION['username'])=='Hanayo'){?>
		<div class="mdui-table-fluid">
			<table class="mdui-table mdui-table-hoverable">
				<thead>
					<tr>
						<th>ID</th>
						<th>用户名</th>
						<th>邮箱</th>
						<th>邮箱激活</th>
						<th>QQ</th>
						<th>hls</th>
						<th>首页显示</th>
						<th>直播状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody>
		<?php  foreach ($arr as $row){		?>
					<form method="post" action="change.php?ID=<?php echo "".$row['ID']."" ?>">
					<tr>
						<td><?php echo "".$row['ID']."" ?></td>
						<td><?php echo "".$row['username']."" ?></td>
						<td><?php echo "".$row['email']."" ?></td>
						<td>
							<label class="mdui-switch">
  								<input value="checked" type="checkbox" name="active" <?php echo "".$row['email_active']."" ?>/>
  								<i class="mdui-switch-icon"></i>
							</label>
						</td>
						<td><?php echo "".$row['QQ']."" ?></td>
						<td><?php echo "".$row['hls_url']."" ?></td>
						<td>
							<label class="mdui-switch">
  								<input value="checked" type="checkbox" name="indexshow" <?php echo "".$row['indexshow']."" ?>/>
  								<i class="mdui-switch-icon"></i>
							</label>
						</td>
						<td>
							<label class="mdui-switch">
  								<input value="checked" type="checkbox" name="live" <?php echo "".$row['livestats']."" ?>/>
  								<i class="mdui-switch-icon"></i>
							</label>
						</td>
						<td>
							<button class="mdui-btn mdui-color-pink mdui-ripple" type="submit" name="update">应用</button>
						</td>
					</tr>
					</form>
		<?php } ?>
			</tbody>
			</table>
		</div>
		<?php } ?>
	</div>
	</body>
</html>
