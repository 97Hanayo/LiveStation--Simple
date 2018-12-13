<?php
	session_start();
	@$username=$_GET['name'];
	@$user = $_SESSION['username'];
	include_once ("db/conn.php");
	$db = getDB();
	$sql = "select username,email,email_active,QQ,pic,bk,userdetail,rtmp_url,hls_url,livedetail,livestats,guestsay,indexshow,type from live where username='$username'";
	$query = mysqli_query($aVar,$sql); 
	$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="danmu/jquery.cxcolor.css">
		<link rel="stylesheet" href="pic/css/bootstrap.min.css">
		<link rel="stylesheet" href="mdui-v0.4.0/css/mdui.css">
		<link rel="stylesheet" href="rtmp/video-js.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/jquery.cookie.js"></script>
		<script src="danmu/socket.io-1.3.7.js"></script>
		<script src="danmu/danmaku.min.js"></script>
		<script src="pic/js/bootstrap.min.js"></script>
		<script src="danmu/jquery.cxcolor.js"></script>
		<script src="rtmp/screenfull.min.js"></script>
		<script src="rtmp/video.js"></script>
		<script src="rtmp/videojs-contrib-hls.js"></script>
		<script src="mdui-v0.4.0/js/mdui.js" ></script>
		<meta charset="UTF-8">
		<title>来自<?php echo $username ?>---直播间</title>
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
	<body class="padding-top mdui-appbar-with-toolbar">
<script type="text/javascript">

//初始化页面时验证是否记住了用户名
	$(document).ready(function() {
    if ($.cookie("remember") == "true") {
        $("#remember").attr("checked", true);
		$("#username").val($.cookie("username"));
    }
});
	function saveUserInfo() {
    if ($("#remember").prop("checked") == true) {
    	var username = $("#username").val();
        $.cookie("remember", "true", { expires: 365 }); // 存储一个带365天期限的 cookie
        $.cookie("username", username, { expires: 365 }); // 存储一个带365天期限的 cookie
    }
    else {
        $.cookie("remember", "false", { expires: 365 });        // 删除 cookie
        $.cookie("username", '', { expires: -1 });
    }
}
</script>	
		<?php
			include('navi.php');
			if(!isset($_SESSION['username'])){   ?>
			<div class="mdui-color-pink-accent mdui-center" style="height: 60px;width: 700px;">
				<h2 class="mdui-p-t-2 mdui-p-l-2">你还没有登录哦</h2>
			</div>
		<?php }
			if($row['email_active']!='checked'){ ?>
			<div class="mdui-color-pink-accent mdui-center" style="height: 60px;width: 700px;">
				<h2 class="mdui-p-t-2 mdui-p-l-2">邮箱还没有激活哦</h2>
			</div>
		<?php } ?>
			<div class="mdui-container" >
				<img class="mdui-img-circle" style="height: 130px;width: 130px;margin-top: 25px;margin-bottom: 25px;" src=<?php echo "".$row['pic']."" ?>>
				<h4 style="margin-left: 150px;margin-top: -80px;width: 400px;height: 40px;"><?php echo "".$row['userdetail']."" ?></h4>
				<h1 style="margin-left: 150px;margin-top: -110px;"><?php echo "".$row['username']."" ?></h1>
				<div style="margin-left: 830px;">
					<i class="mdui-icon material-icons" style="margin-top: -9px;font-size: 40px;">face</i>&nbsp;&nbsp;
					<span style="font-size: 25px;"id="chatOnline"></span>
				</div>
			</div>
		
		<div class="mdui-container" style="margin-top: 35px;">
			<div id="fullscreen-div">
                <div id="dm-container" style="width:800px;height:450px;">
                    <video autoplay="autoplay" id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="800" height="450" data-setup="{}" style="position: absolute;z-index: 0;">
			<source type="application/x-mpegURL" src="<?php echo "".$row['hls_url']."" ?>">
                        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                    </video>
                </div>
            </div>
                <?php if($row['guestsay']=='checked'){  ?>
                    <div id="send-div" style="width: 800px;height: 34px;background: black;">
                    	<span style="color: white;margin-left: -500px;">颜色选择</span>
                    	<input id="color_d" type="text" class="input_cxcolor" readonly value="#ffffff" style="margin-left: 10px;">
                    		<input id="colsel" type="hidden">
                        <input class="form-control mdui-float-left" style="width: 50%;margin-left: 140px;" placeholder="可以在这里发射弹幕哦" id="userMsg">
                        <button class="btn btn-default mdui-ripple" style="margin-left: 450px;" id="btn_chatsend">射爆！</button>
                        <button class="btn btn-default mdui-ripple" style="background: pink;margin-left: 15px;" id="rr">弹幕开关</button>
                    </div>
                <?php		}
                if($row['guestsay']!='checked'&&isset($_SESSION['username'])){  ?>
                    <div id="send-div" style="width: 800px;height: 34px;background: black;">
                    	<span style="color: white;margin-left: -500px;">颜色选择</span>
                    	<input id="color_d" type="text" class="input_cxcolor" readonly value="#ffffff" style="margin-left: 10px;">
                    		<input id="colsel" type="hidden">
                        <input class="form-control mdui-float-left" style="width: 50%;margin-left: 140px;" placeholder="可以在这里发射弹幕哦" id="userMsg">
                        <button class="btn btn-default mdui-ripple" style="margin-left: 450px;" id="btn_chatsend">射爆！</button>
                        <button class="btn btn-default mdui-ripple" style="background: pink;margin-left: 15px;" id="rr">弹幕开关</button>
                    </div>
                <?php		}
                if($row['guestsay']!='checked'&&!isset($_SESSION['username'])){   ?>
                    <div id="send-div" style="width: 800px;height: 34px;background: black;margin-top: -20px;">
                        <h3 style="color: white;text-align: center;"><b>主播说游客不能说话呢</b></h3>
                    </div>
                <?php } ?>
            
  			<div class="mdui-container">
  				<?php if($username==$user&&$row['livestats']=='checked'){  ?>
			<form method="post" id="set" name="set" action="##" onsubmit="return false">
			<div class="mdui-container"  style="width: 330px;height: 200px;margin-left: 840px;margin-top: -600px;">
      			<label class="mdui-switch" style="margin-left: 30px;">
      				<span>首页显示</span>&nbsp;&nbsp;
        			<input type="checkbox" onclick="insert()" id="indexshow" name="indexshow" value="checked" <?php echo "".$row['indexshow']."" ?>>
        			<i class="mdui-switch-icon"></i>
      			</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      			<label class="mdui-switch">
      				<span>游客发言</span>&nbsp;&nbsp;
        			<input type="checkbox" onclick="insert()" id="guestsay" name="guestsay" value="checked" <?php echo "".$row['guestsay']."" ?>>
        			<i class="mdui-switch-icon"></i>
      			</label>
      			<select class="mdui-select" onchange="insert()" mdui-select id="type" name="type" style="text-align: center;margin-left: 35px;">
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
      			<!--<button class="mdui-btn mdui-color-pink" type="submit" name="room" style="margin-top: -80px;margin-left: -360px;">一定要提交哦</button>-->
      		</div>
      		</form>
      		<div class="panel panel-default" style="width: 330px;height: 484px;margin-left: 780px;margin-top: -84px;overflow: scroll;word-break: break-all;overflow-x: hidden;" id="chatcontent">
				<!--<div class="panel-body"></div>-->
			</div>
<?php		} 
	if($user!=$username){	?>		
  				<div class="panel panel-default" style="width: 330px;height: 484px;margin-left: 780px;margin-top: -484px;overflow: scroll;word-break: break-all;overflow-x: hidden;" id="chatcontent">
				<!--<div class="panel-body"></div>-->
				</div>
	<?php } ?>
  			</div>
		</div>

	<?php if(isset($_SESSION['username'])) { 
		include('logoutbtn.php');
	}else{ ?>
				<div class="mdui-fab-wrapper" >
    				<button class="mdui-fab mdui-ripple mdui-color-pink-accent" mdui-tooltip="{content: '登录', position: 'left'}" mdui-dialog="{target: '#login'}">
      					<i class="mdui-icon material-icons">add</i>
    				</button>
  				</div>
  				<?php
						include('login_form.php');
				?>
<?php	} ?>
	<?php		include('footer.php');    ?>
	</body>
</html>
//<script>
//	window.onload = function () {  
//        var s = document.cookie;  
//        if (s.indexOf('myad=1') != -1) return; //存在cookie退出下面代码的执行  
//        var d = new Date();  
//        d.setHours(d.getHours() + 24); //有效期24小时  
//        document.cookie = 'myad=1;expires='+d.toGMTString();//设置cookie  
//        alert('由于技术太菜（；´д｀）ゞ，退出全屏的快捷键是“空格键”和“空格键”，ESC退出会有排版问题');
//   }  
//</script>
<script>
	(function(){
	var color=$("#color_d");
	var colsel=$("#colsel");
	var mycolor;
	
	color.bind("change",function(){
		colsel.css("color",this.value)
	});

	mycolor=$("#color_d").cxColor();
})();
	<?php include('chat_js.php'); ?>
	//弹幕
    var danmaku = new Danmaku();
    danmaku.init({
        container: document.getElementById('dm-container'),
        engine: 'DOM',
    });
    setInterval(function(){
        danmaku.resize();
    },100);
    //弹幕创建
    function danmakuCreate(text,color){
        var comment = {
        text: text,
        // 默认为 rtl（从右到左），支持 ltr、rtl、top、bottom。
        mode: 'rtl',
        // 弹幕显示的时间，单位为秒。
        // 在使用视频或音频模式时，如果未设置，会默认为音视频的当前时间；实时模式不需要设置。
        time: 0.0,
        // 在使用 DOM 引擎时，Danmaku 会为每一条弹幕创建一个 <div> 节点，
            // 以下 CSS 样式会直接设置到 div.style 上
            style: {
            fontSize: '20px',
            color: color,
            textShadow: '-1px -1px #000, -1px 1px #000, 1px -1px #000, 1px 1px #000'
            },
        };
        danmaku.emit(comment)
    }
    

</script>
<script>
	var video = document.getElementById('example_video_1');
	var rr = document.getElementById('rr');
	var num = 0;
	rr.onclick=function()
	{
		num++;
		if(num%2==0)
		{
			rr.style.background = 'pink';
			$("#example_video_1").css("z-index",0);
			num=0;
		}
		else
		{
			rr.style.background = 'lightgray';
			$("#example_video_1").css("z-index",1);
		}
	};
</script>
