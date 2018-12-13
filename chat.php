		<?php
			session_start();
			@$username=$_GET['name'];
			@$user = $_SESSION['username'];
			include_once ("db/conn.php");
			$db = getDB();
			$sql = "select username,livestats,guestsay,indexshow,type from live where username='$username'";
			$query = mysqli_query($aVar,$sql); 
			$row = mysqli_fetch_array($query);
			?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="pic/css/bootstrap.min.css">
		<link rel="stylesheet" href="mdui-v0.4.0/css/mdui.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="danmu/socket.io-1.3.7.js"></script>
		<script src="danmu/danmaku.min.js"></script>
		<script src="pic/js/bootstrap.min.js"></script>
		<script src="mdui-v0.4.0/js/mdui.min.js" ></script>
		<meta charset="UTF-8">
		<title>是一个独立的聊天窗口</title>
		<script>
			function insert() {
   $.ajax({
    type: "POST",//方法
    url: "liveset.php" ,//表单接收url
    data: $('#set').serializeArray(),
    success: function () {
     //提交成功的提示词或者其他反馈代码
    },
    error : function() {
     //提交失败的提示词或者其他反馈代码
     alert("false")
    }
   });
  }
		</script>
	</head>
	<body>
        <input id="colsel" type="hidden" style="color: white;">
							<?php if($username==$user&&$row['livestats']=='checked'){  ?>
			<form method="post" id="set" name="set" action="##" onsubmit="return false">
			<div class="mdui-container" style="margin-top: 10px;">
				<div>
      			<label class="mdui-switch">
      				<span>首页显示</span>&nbsp;&nbsp;
        			<input type="checkbox" onclick="insert()" id="indexshow" name="indexshow" value="checked" <?php echo "".$row['indexshow']."" ?>>
        			<i class="mdui-switch-icon"></i>
				</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      			<label class="mdui-switch">
      				<span>游客发言</span>&nbsp;&nbsp;
        			<input type="checkbox" onclick="insert()" id="guestsay" name="guestsay" value="checked" <?php echo "".$row['guestsay']."" ?>>
        			<i class="mdui-switch-icon"></i>
      			</label>
      			<select class="mdui-select" onchange="insert()" mdui-select id="type" name="type" style="margin-left: 30px;margin-top: 0px;text-align: center;">
    				<option value="0">选择分类才能首页显示</option>
  					<option value="1">网络游戏</option>
  					<option value="2">单机游戏</option>
  					<option value="3">学习</option>
  					<option value="4">电影</option>
  					<option value="5">音乐</option>
				</select>
<script >
var  type = document.getElementById('type');
type[<?php echo "".$row['type']."" ?>].selected = true;//选中
</script>
      			<!--<input class="mdui-btn mdui-color-pink" type="button" name="room" style="margin-left: 20px;" onclick="insert()" value="提交"></input>-->
      			</div>
      		</div>
      		</form>
<?php		} ?>		
		<div class="mdui-container panel panel-default" style="width: 100%;height: 100%;margin-top: 10px;">
			<div style="margin-left: 10px;margin-top: 5px;">
					<i class="mdui-icon material-icons">face</i>&nbsp;&nbsp;
					<span id="chatOnline"></span>
			</div>
			<div class="panel-body" id="chatcontent" style="height: 530px;margin-top: 5px;overflow: scroll;word-break: break-all;overflow-x: hidden;"></div>
			<?php if($username==$user&&$row['livestats']=='checked'){  ?>
			<input type="text" class="mdui-container panel panel-default" id="userMsg" style="width:100%;height: 100px;">
		</div>
		<button class="mdui-fab mdui-ripple mdui-color-pink mdui-fab-fixed" id="btn_chatsend" mdui-tooltip="{content: '发送', position: 'left'}"><i class="mdui-icon material-icons">send</i></button>
		<?php } 
			if($username!=$user){?>
				<div class="mdui-container mdui-text-center panel panel-default" style="height: 100px;width: 100%;">你不是这个房间的主人哦</div>
	<?php		}?>
			
	</body>
</html>
<script>
	<?php include('chat_js.php'); ?>
</script>