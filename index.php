<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="mdui-v0.4.0/css/mdui.css" />
		<link rel="stylesheet" href="live2d/l2d.css"  />
		<script src="mdui-v0.4.0/js/mdui.js" ></script>
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/jquery.cookie.js"></script>
		<script src="danmu/socket.io-1.3.7.js"></script>
		<meta charset="UTF-8">
		<title>Live--はな&nbsp;&nbsp;&nbsp;&nbsp;首页</title>
	</head>
	<body class="padding-top mdui-appbar-with-toolbar ">
	<div class="waifu">
    	<div class="waifu-tips"></div>
    	<canvas id="live2d" width="280" height="280" class="live2d"></canvas>
	</div>
	<script type="text/javascript">
	var socket = io.connect('wss://www.hanayo.club:2121'); //服务器地址
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
		session_start();
		@$username=$_SESSION["username"];
		include_once ("db/conn.php");
		$db = getDB();
		$sql = "select username,email_active,QQ,pic,bk,userdetail,livedetail,livestats from live where username='$username'";
		$query = mysqli_query($aVar,$sql); 
		$row = mysqli_fetch_array($query);
		
		$sql1 = "select username,pic,bk,userdetail,livedetail,indexshow from live where type='1'";
		$arr1 = $db->prepare($sql1);
		$arr1->execute();
		$sql2 = "select username,pic,bk,userdetail,livedetail,indexshow from live where type='2'";
		$arr2 = $db->prepare($sql2);
		$arr2->execute();
		$sql3 = "select username,pic,bk,userdetail,livedetail,indexshow from live where type='3'";
		$arr3 = $db->prepare($sql3);
		$arr3->execute();
		$sql4 = "select username,pic,bk,userdetail,livedetail,indexshow from live where type='4'";
		$arr4 = $db->prepare($sql4);
		$arr4->execute();
		$sql5 = "select username,pic,bk,userdetail,livedetail,indexshow from live where type='5'";
		$arr5 = $db->prepare($sql5);
		$arr5->execute();
		
		include('navi.php');
			 if(!isset($_SESSION['username'])){?>
		<div class="mdui-color-pink-accent mdui-center" style="height: 230px;width: 700px;">
			<h1 class="mdui-p-t-1 mdui-p-l-2">还不是会员？</h1>
			<p class="mdui-p-t-1 mdui-p-l-2">戳一下<a href="register.php"><button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-200 mdui-text-color-white">注册</button></a>即可开始注册(●'◡'●)登录后可以看到更多秘密哦</p>
			<h3 class="mdui-p-t-1 mdui-p-l-2">已经是会员了？</h3>
			<p class="mdui-p-t-1 mdui-p-l-2">戳一下
				<button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink-200 mdui-text-color-white" mdui-dialog="{target: '#login'}">登录</button>马上登录φ(゜▽゜*)♪
			</p>
					<?php
						include('login_form.php');
					}if(!empty(@$_SESSION['username'])){
						include('logoutbtn.php');?>
			<div class="mdui-color-pink-accent mdui-center" style="height: 100px;width: 700px;">
				<h3 class="mdui-p-t-2 mdui-p-l-2">欢迎回来！</h3>
				<p class="mdui-p-t-1 mdui-p-l-2">你已经是美少女了，快点穿上小裙子吧ˋ( ° ▽、° ) </p>
			</div>
		</div>		
		<?php } 	 ?>
			<div class="mdui-container">
		<?php  $type1 = "SELECT indexshow FROM live where type=1 and indexshow like '%checked';"; 
					$result1=mysqli_query($aVar,$type1);
					$title1=mysqli_fetch_array($result1);
					if($title1['indexshow']=='checked'){ ?>
							<h1 id="net">网络游戏</h1>
			<?php	}		?>
				<div class="mdui-row-xs-3">
		<?php  foreach ($arr1 as $row1){
					if($row1['indexshow']=='checked'){
			?>
			<a href="room.php?name=<?php echo "".$row1['username']."" ?>">
    			<div class="mdui-col" style="margin-top:10px;height:450px">
      				<div class="mdui-card mdui-hoverable">
        				<div class="mdui-card-header">
          					<img class="mdui-card-header-avatar" src="<?php echo "".$row1['pic']."" ?>">  <!--头像-->
          					<div class="mdui-card-header-title"><?php echo "".$row1['username']."" ?></div>  <!--用户名-->
          					<div class="mdui-card-header-subtitle"><?php echo "".$row1['userdetail']."" ?></div>  <!--用户介绍-->
        				</div>
        				<div class="mdui-card-media" id="imgPreview"> 
          					<img id="img1" style="max-height: 300px;" src="<?php echo "".$row1['bk']."" ?>" >  <!--即时预览-->
          						<div class="mdui-card-media-covered">
          							<div class="mdui-float-right" style="margin-top: 3px;">
          								<i class="mdui-icon material-icons" style="font-size: 25px;margin-left: -50px;margin-top: -3px;margin-bottom: 5px;">face</i>
										<span style="font-size: 25px;" id="chatOnline<?php echo "".$row1['username']."" ?>"></span>
          							</div>
          						</div>
        				</div>
        				<div class="mdui-card-content"><?php echo "".$row1['livedetail']."" ?></div>  <!--直播简介-->
      				</div>
  				</div>
  			</a>
<script type="text/javascript">
    socket.emit('getPeopleOnline',{
        roomid: "<?php echo "".$row1['username']."" ?>"
    });
    socket.on('peopleOnline', function(data) {
    	if(data.roomid=="<?php echo "".$row1['username']."" ?>"){
			$("#chatOnline<?php echo "".$row1['username']."" ?>").text(data.online);
        }
     });
</script>
		<?php }
		} ?>
			</div>	
				<?php $type2 = "SELECT indexshow FROM live where type=2 and indexshow like '%checked';"; 
					$result2=mysqli_query($aVar,$type2);
					$title2=mysqli_fetch_array($result2);
					if($title2['indexshow']=='checked'){ ?>
							<h1 id="self">单机游戏</h1>
			<?php	}		?>
				<div class="mdui-row-xs-3">
		<?php  foreach ($arr2 as $row2){
					if($row2['indexshow']=='checked'){
			?>
			<a href="room.php?name=<?php echo "".$row2['username']."" ?>">
    			<div class="mdui-col" style="margin-top:10px;height:450px">
      				<div class="mdui-card mdui-hoverable">
        				<div class="mdui-card-header">
          					<img class="mdui-card-header-avatar" src="<?php echo "".$row2['pic']."" ?>">  <!--头像-->
          					<div class="mdui-card-header-title"><?php echo "".$row2['username']."" ?></div>  <!--用户名-->
          					<div class="mdui-card-header-subtitle"><?php echo "".$row2['userdetail']."" ?></div>  <!--用户介绍-->
        				</div>
        				<div class="mdui-card-media" id="imgPreview"> 
          					<img id="img1" style="max-height: 300px;" src="<?php echo "".$row2['bk']."" ?>" >  <!--即时预览-->
          						<div class="mdui-card-media-covered">
          							<div class="mdui-float-right" style="margin-top: 3px;">
          								<i class="mdui-icon material-icons" style="font-size: 25px;margin-left: -50px;margin-top: -3px;margin-bottom: 5px;">face</i>
										<span style="font-size: 25px;" id="chatOnline<?php echo "".$row2['username']."" ?>"></span>
          							</div>
          						</div>
        				</div>
        				<div class="mdui-card-content"><?php echo "".$row2['livedetail']."" ?></div>  <!--直播简介-->
      				</div>
  				</div>
  			</a>
<script type="text/javascript">
    socket.emit('getPeopleOnline',{
        roomid: "<?php echo "".$row2['username']."" ?>"
    });
    socket.on('peopleOnline', function(data) {
    	if(data.roomid=="<?php echo "".$row2['username']."" ?>"){
			$("#chatOnline<?php echo "".$row2['username']."" ?>").text(data.online);
        }
     });
</script>
		<?php }
		} ?>
			</div>
				<?php $type3 = "SELECT indexshow FROM live where type=3 and indexshow like '%checked';"; 
					$result3=mysqli_query($aVar,$type3);
					$title3=mysqli_fetch_array($result3);
					if($title3['indexshow']=='checked'){ ?>
							<h1 id="study">学习</h1>
			<?php	}		?>
				<div class="mdui-row-xs-3">
		<?php  foreach ($arr3 as $row3){
					if($row3['indexshow']=='checked'){
			?>
			<a href="room.php?name=<?php echo "".$row3['username']."" ?>">
    			<div class="mdui-col" style="margin-top:10px;height:450px">
      				<div class="mdui-card mdui-hoverable">
        				<div class="mdui-card-header">
          					<img class="mdui-card-header-avatar" src="<?php echo "".$row3['pic']."" ?>">  <!--头像-->
          					<div class="mdui-card-header-title"><?php echo "".$row3['username']."" ?></div>  <!--用户名-->
          					<div class="mdui-card-header-subtitle"><?php echo "".$row3['userdetail']."" ?></div>  <!--用户介绍-->
        				</div>
        				<div class="mdui-card-media" id="imgPreview"> 
          					<img id="img1" style="max-height: 300px;" src="<?php echo "".$row3['bk']."" ?>" >  <!--即时预览-->
          						<div class="mdui-card-media-covered">
          							<div class="mdui-float-right" style="margin-top: 3px;">
          								<i class="mdui-icon material-icons" style="font-size: 25px;margin-left: -50px;margin-top: -3px;margin-bottom: 5px;">face</i>
										<span style="font-size: 25px;" id="chatOnline<?php echo "".$row3['username']."" ?>"></span>
          							</div>
          						</div>
        				</div>
        				<div class="mdui-card-content"><?php echo "".$row3['livedetail']."" ?></div>  <!--直播简介-->
      				</div>
  				</div>
  			</a>
<script type="text/javascript">
    socket.emit('getPeopleOnline',{
        roomid: "<?php echo "".$row3['username']."" ?>"
    });
    socket.on('peopleOnline', function(data) {
    	if(data.roomid=="<?php echo "".$row3['username']."" ?>"){
			$("#chatOnline<?php echo "".$row3['username']."" ?>").text(data.online);
        }
     });
</script>
		<?php }
		} ?>
			</div>
				<?php $type4 = "SELECT indexshow FROM live where type=4 and indexshow like '%checked';"; 
					$result4=mysqli_query($aVar,$type4);
					$title4=mysqli_fetch_array($result4);
					if($title4['indexshow']=='checked'){ ?>
							<h1 id="movie">电影</h1>
			<?php	}		?>
				<div class="mdui-row-xs-3">
		<?php  foreach ($arr4 as $row4){
					if($row4['indexshow']=='checked'){
			?>
			<a href="room.php?name=<?php echo "".$row4['username']."" ?>">
    			<div class="mdui-col" style="margin-top:10px;height:450px">
      				<div class="mdui-card mdui-hoverable">
        				<div class="mdui-card-header">
          					<img class="mdui-card-header-avatar" src="<?php echo "".$row4['pic']."" ?>">  <!--头像-->
          					<div class="mdui-card-header-title"><?php echo "".$row4['username']."" ?></div>  <!--用户名-->
          					<div class="mdui-card-header-subtitle"><?php echo "".$row4['userdetail']."" ?></div>  <!--用户介绍-->
        				</div>
        				<div class="mdui-card-media" id="imgPreview"> 
          					<img id="img1" style="max-height: 300px;" src="<?php echo "".$row4['bk']."" ?>" >  <!--即时预览-->
          						<div class="mdui-card-media-covered">
          							<div class="mdui-float-right" style="margin-top: 3px;">
          								<i class="mdui-icon material-icons" style="font-size: 25px;margin-left: -50px;margin-top: -3px;margin-bottom: 5px;">face</i>
										<span style="font-size: 25px;" id="chatOnline<?php echo "".$row4['username']."" ?>"></span>
          							</div>
          						</div>
        				</div>
        				<div class="mdui-card-content"><?php echo "".$row4['livedetail']."" ?></div>  <!--直播简介-->
      				</div>
  				</div>
  			</a>
<script type="text/javascript">
    socket.emit('getPeopleOnline',{
        roomid: "<?php echo "".$row4['username']."" ?>"
    });
    socket.on('peopleOnline', function(data) {
    	if(data.roomid=="<?php echo "".$row4['username']."" ?>"){
			$("#chatOnline<?php echo "".$row4['username']."" ?>").text(data.online);
        }
     });
</script>
		<?php }
		} ?>
			</div>
				<?php $type5 = "SELECT indexshow FROM live where type=5 and indexshow like '%checked';"; 
					$result5=mysqli_query($aVar,$type5);
					$title5=mysqli_fetch_array($result5);
					if($title5['indexshow']=='checked'){ ?>
							<h1 id="music">音乐</h1>
			<?php	}		?>
				<div class="mdui-row-xs-3">
		<?php  foreach ($arr5 as $row5){
					if($row5['indexshow']=='checked'){
			?>
			<a href="room.php?name=<?php echo "".$row5['username']."" ?>">
    			<div class="mdui-col" style="margin-top:10px;height:450px">
      				<div class="mdui-card mdui-hoverable">
        				<div class="mdui-card-header">
          					<img class="mdui-card-header-avatar" src="<?php echo "".$row5['pic']."" ?>">  <!--头像-->
          					<div class="mdui-card-header-title"><?php echo "".$row5['username']."" ?></div>  <!--用户名-->
          					<div class="mdui-card-header-subtitle"><?php echo "".$row5['userdetail']."" ?></div>  <!--用户介绍-->
        				</div>
        				<div class="mdui-card-media" id="imgPreview"> 
          					<img id="img1" style="max-height: 300px;" src="<?php echo "".$row5['bk']."" ?>" >  <!--即时预览-->
          						<div class="mdui-card-media-covered">
          							<div class="mdui-float-right" style="margin-top: 3px;">
          								<i class="mdui-icon material-icons" style="font-size: 25px;margin-left: -50px;margin-top: -3px;margin-bottom: 5px;">face</i>
										<span style="font-size: 25px;" id="chatOnline<?php echo "".$row5['username']."" ?>"></span>
          							</div>
          						</div>
        				</div>
        				<div class="mdui-card-content"><?php echo "".$row5['livedetail']."" ?></div>  <!--直播简介-->
      				</div>
  				</div>
  			</a>
<script type="text/javascript">
    socket.emit('getPeopleOnline',{
        roomid: "<?php echo "".$row5['username']."" ?>"
    });
    socket.on('peopleOnline', function(data) {
    	if(data.roomid=="<?php echo "".$row5['username']."" ?>"){
			$("#chatOnline<?php echo "".$row5['username']."" ?>").text(data.online);
        }
     });
</script>
		<?php }
		} ?>
			</div>
		</div>
<?php		include('footer.php');    ?>
		 <script>
 
!function(){
 
function n(n,e,t){
 
return n.getAttribute(e)||t
 
}
 
function e(n){
 
return document.getElementsByTagName(n)
 
}
 
function t(){
 
var t=e("script"),o=t.length,i=t[o-1];
 
return{
 
l:o,z:n(i,"zIndex",-1),o:n(i,"opacity",.5),c:n(i,"color","0,0,0"),n:n(i,"count",99)
 
}
 
}
 
function o(){
 
a=m.width=window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth,
 
c=m.height=window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight
 
}
 
function i(){
 
r.clearRect(0,0,a,c);
 
var n,e,t,o,m,l;
 
s.forEach(function(i,x){
 
for(i.x+=i.xa,i.y+=i.ya,i.xa*=i.x>a||i.x<0?-1:1,i.ya*=i.y>c||i.y<0?-1:1,r.fillRect(i.x-.5,i.y-.5,1,1),e=x+1;e<u.length;e++)n=u[e],
 
null!==n.x&&null!==n.y&&(o=i.x-n.x,m=i.y-n.y,
 
l=o*o+m*m,l<n.max&&(n===y&&l>=n.max/2&&(i.x-=.03*o,i.y-=.03*m),
 
t=(n.max-l)/n.max,r.beginPath(),r.lineWidth=t/2,r.strokeStyle="rgba("+d.c+","+(t+.2)+")",r.moveTo(i.x,i.y),r.lineTo(n.x,n.y),r.stroke()))
 
}),
 
x(i)
 
}
 
var a,c,u,m=document.createElement("canvas"),
 
d=t(),l="c_n"+d.l,r=m.getContext("2d"),
 
x=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||
 
function(n){
 
window.setTimeout(n,1e3/45)
 
},
 
w=Math.random,y={x:null,y:null,max:2e4};m.id=l,m.style.cssText="position:fixed;top:0;left:0;z-index:"+d.z+";opacity:"+d.o,e("body")[0].appendChild(m),o(),window.onresize=o,
 
window.onmousemove=function(n){
 
n=n||window.event,y.x=n.clientX,y.y=n.clientY
 
},
 
window.onmouseout=function(){
 
y.x=null,y.y=null
 
};
 
for(var s=[],f=0;d.n>f;f++){
 
var h=w()*a,g=w()*c,v=2*w()-1,p=2*w()-1;s.push({x:h,y:g,xa:v,ya:p,max:6e3})
 
}
 
u=s.concat([y]),
 
setTimeout(function(){i()},100)
 
}();
 
</script>
<script async src="live2d/waifu-tips.js"></script>
<script src="live2d/live2d.js"></script>
<script type="text/javascript">
    loadlive2d("live2d", "live2d/Untitled Model.model.json");
</script>
	</body>
</html>
