	<div class="mdui-center" style="width: 900px;height: 600px;">
		<div class="mdui-tab mdui-tab-full-width" mdui-tab>
			<a href="#data" class="mdui-ripple">
				<i class="mdui-icon material-icons">person</i>
    			<label>个人资料</label>
			</a>
			<a href="#live" class="mdui-ripple">
				<i class="mdui-icon material-icons">live_tv</i>
    			<label>直播设置</label>
			</a>
  			<a href="#change" class="mdui-ripple">
				<i class="mdui-icon material-icons">build</i>
    			<label>修改密码</label>
			</a>
		</div>
		<div id="data" class="mdui-p-a-2"> <br>
			<form method="post">
				<button class="mdui-fab mdui-ripple mdui-fab-fixed mdui-color-pink-accent" type="submit" name="update" mdui-tooltip="{content: '保存修改', position: 'left'}">
      				<i class="mdui-icon material-icons">save</i>
    			</button>
				<div class="mdui-center" style="width: 500px;height: 200px;">
					<div class="mdui-textfield">
  						<i class="mdui-icon material-icons">assignment_ind</i>
  						<input class="mdui-textfield-input" type="text" name="rename" disabled value ="<?php echo "".$row['username']."" ?>">
					</div>
					<div class="mdui-textfield">
  						<i class="mdui-icon material-icons">note</i>
  						<input class="mdui-textfield-input" type="text" name="detail" placeholder="用户简介，不能超过20字哦" value ="<?php echo "".$row['userdetail']."" ?>" maxlength="20">
					</div>
					<div class="mdui-textfield" style="margin-top: -20px;">
  						<i class="mdui-icon material-icons">email</i>
  						<input class="mdui-textfield-input" type="email" disabled value=<?php echo "".$row['email']."" ?>>
					</div>
					<div class="mdui-textfield">
  						<i class="mdui-icon material-icons">chat</i>
  						<input class="mdui-textfield-input" type="text" disabled value=<?php echo "".$row['QQ']."" ?>>
					</div>
					<img class="mdui-img-circle" style="height: 150px;width: 150px;margin-left: -180px;margin-top: -250px;" src=<?php echo "".$row['pic']."" ?>>
					<?php
						if($row['email_active']!='checked'){?>
							<div style='margin-top: -130px;margin-left: 300px;'><a href='email_resend.php?action=resend' target='_blank'><button class='mdui-btn mdui-color-pink mdui-ripple' type="button">点我激活邮箱</button></a></div>
							<div class="mdui-color-pink-accent" style="height: 60px;width: 700px;margin-top: 100px;margin-left: -130px;">
							<h3 class="mdui-p-t-2 mdui-p-l-2">邮箱还没有激活哦，不能修改头像哦</h3>
							</div>
				<?php		} ?>
				</div>
				<?php
						if($row['email_active']=='checked'){?>
				<br><br>
				<div class="container">
					<div class="row">
      					<div class="col-md-9 docs-buttons">
        					<div class="btn-group">
          						<button type="button" class="mdui-btn mdui-color-pink mdui-ripple" data-method="reset">
            						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false">刷新</span>
          						</button>
          						<label class="mdui-btn mdui-color-pink mdui-ripple btn-upload" for="inputImage">
            						<input type="file" class="sr-only" id="inputImage" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
            						<span class="docs-tooltip" data-toggle="tooltip" data-animation="false">上传图片</span>
          						</label>
        					</div>
        					<div class="btn-group btn-group-crop" style="margin-left: 50px;">
            					<button class="mdui-btn mdui-color-pink mdui-ripple" data-method="getCroppedCanvas"type="button">上传头像</button>
        					</div>
      					</div>
  					</div>
    				<div class="row" style="margin-left: -100px;">
      					<div class="col-md-8">
        					<div class="img-container">
          						<img id="image" src=" ">
        					</div>
      					</div>
      					<div class="col-md-3">
        					<div class="docs-preview clearfix">
          						<div class="img-preview preview-lg mdui-img-circle"></div>
        					</div>
      					</div>
    				</div>
 				</div>
 <?php		} ?>
		</div>	
		<div id="live" class="mdui-p-a-2">
			<?php
						if($row['email_active']=='checked'&&$row['livestats']=='checked'){?>
			<button class="mdui-fab mdui-ripple mdui-fab-fixed mdui-color-pink-accent" type="submit" name="update" mdui-tooltip="{content: '保存修改', position: 'left'}">
      			<i class="mdui-icon material-icons">save</i>
    		</button>
    		<div class="mdui-center" style="width: 700px;height: 100px;">
			<div class="mdui-textfield">
  				<i class="mdui-icon material-icons">link</i>
  				<input class="mdui-textfield-input" type="text" name="rtmp" placeholder="rtmp://172.16.*.*/live/" value ="<?php echo "".$row['rtmp_url']."" ?>">
			</div>
			<div class="mdui-textfield">
  				<i class="mdui-icon material-icons">local_offer</i>
  				<input class="mdui-textfield-input" type="text" name="livedetail" placeholder="直播间简介，不能超过50字哦" value ="<?php echo "".$row['livedetail']."" ?>" maxlength="50">
			</div>
			</div>
			<div style="margin-left: 350px;margin-top: 20px;margin-bottom: 20px;">
    			<select class="mdui-select" mdui-select id="type" name="type" style="text-align: center;">
    				<option value="0">选择分类才能首页显示</option>
  					<option value="1">网络游戏</option>
  					<option value="2">单机游戏</option>
  					<option value="3">学习</option>
  					<option value="4">电影</option>
  					<option value="5">音乐</option>
				</select>
			</div>
<script >
var  type = document.getElementById('type');
type[<?php echo "".$row['type']."" ?>].selected = true;//选中
</script>
			
			</form>
			<form action="bkupload.php" method="post"  enctype="multipart/form-data">
				<div style="margin-left: 300px;">
			<label class="mdui-btn mdui-color-pink mdui-ripple">
            	<input type="file" name="bkg" class="sr-only" onchange='PreviewImage(this)' accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
            	<span class="docs-tooltip" data-toggle="tooltip" data-animation="false">更换背景图预览</span>
          	</label>
          	<div class="btn-group btn-group-crop" style="margin-left: 50px;">
            	<input class="mdui-btn mdui-color-pink mdui-ripple" type="submit" value="确认修改背景图">
        	</div>
        		</div>
        	</form>
			<div class="mdui-container" style="margin-left: 250px;"><br>
  				<div class="mdui-row">
    				<div class="mdui-col-md-6">
      					<div class="mdui-card">
        					<div class="mdui-card-header">
          						<img class="mdui-card-header-avatar" src="<?php echo "".$row['pic']."" ?>">  <!--头像-->
          						<div class="mdui-card-header-title"><?php echo "".$row['username']."" ?></div>  <!--用户名-->
          						<div class="mdui-card-header-subtitle"><?php echo "".$row['userdetail']."" ?></div>  <!--用户介绍-->
        					</div>
        					<div class="mdui-card-media" id="imgPreview"> 
          						<img id="img1" src="<?php echo "".$row['bk']."" ?>" >  <!--即时预览-->
        					</div>
        					<div class="mdui-card-content"><?php echo "".$row['livedetail']."" ?></div>  <!--直播简介-->
      					</div>
    				</div>
  				</div>
			</div>
			<?php		} 
				if($row['email_active']!='checked'){ ?>
				<div class="mdui-color-pink-accent mdui-center" style="height: 60px;width: 700px;">
							<h3 class="mdui-p-t-2 mdui-p-l-2">邮箱还没有激活哦，不能使用这些功能呢</h3>
				</div>
			<?php } ?>
			<?php		
				if($row['livestats']!='checked'){ ?>
				<div class="mdui-color-pink-accent mdui-center" style="height: 60px;width: 700px;">
							<h3 class="mdui-p-t-2 mdui-p-l-2">直播需要找群主通过一下哦</h3>
				</div>
				<div class="mdui-container">
					<h2 style="text-align: center;">主播守则</h2>
					<h2 style="text-align: center;">直播群群号：</h2>
					<h3 style="text-align: center;">★任何一名优秀的播主，都应该遵守以下准则！★</h3>
					<h4 style="text-align: center;">本站所有直播内容必须遵守《互联网电子公告服务管理规定》，不得发表诽谤他人；侵犯他人隐私；侵犯他人知识产权；政治言论；商业讯息；低俗内容等信息；禁止一切存在色情、血腥 、暴力以及有擦边球嫌疑的内容节目；不得播放或转播版权类型的影视剧以及体育比赛等内容 。恶意违反规定者将导致您的账号被封停，并且我们还将保留追究相应的法律责任的权利。</h4>
					<h4 style="text-align: center;">开通直播即代表已同意Live—はな使用协议，请勿上传和直播任何色情、暴力、反动信息！</h4>
					<h5 style="text-align: center;">为维护Live—はな直播的基本秩序，促进Live—はな直播健康发展，特制定本直播规范，适用于所有直播间。</h5>
				</div>
			<?php } ?>
		</div>

		<div id="change" class="mdui-p-a-2">
		<?php  if($row['email_active']!='checked'){ ?>
				<div class="mdui-color-pink-accent mdui-center" style="height: 60px;width: 700px;">
							<h3 class="mdui-p-t-2 mdui-p-l-2">邮箱没有激活是不能改密码的哦</h3>
				</div>
		<?php	}else{
			include('pwd.php');
    		require_once "db/conn.php";
			$db = getDB();
    		if(isset($_POST['submit'])){
    			@$password = $_POST['password'];
				@$passwordcheck = $_POST['repwd'];
					if($password!=$passwordcheck){  
    					echo"<script>alert('密码没打对对啦');location='javascript:history.go(-1)';</script>";  
	}		else{
				@$password = MD5($password);
        		$stmt = $db->prepare("update live set password=? where ID=?");
        		$stmt->bindparam(1,$password);
        		$stmt->bindparam(2,$row['ID']);
        		$stmt->execute();
        		if(mysqli_affected_rows($aVar)!=1) die(0); 
        		unset($_SESSION['username']);
				unset($_SESSION['gwc']);
        		echo "<script>alert('改好了重新输入一次巩固一下(ง •_•)ง');window.location.href='index.php';</script>"; 
        	}
    	} 
}?>
		</div>
	</div>

<script src="pic/js/jquery.min.js"></script>
<script src="pic/js/tether.min.js"></script>
<script src="pic/js/bootstrap.min.js"></script>
<script src="pic/js/cropper.js"></script>
<script src="pic/js/main.js"></script>
<script>
function PreviewImage(imgFile)
{
    var filextension=imgFile.value.substring(imgFile.value.lastIndexOf("."),imgFile.value.length);
    filextension=filextension.toLowerCase();
    if ((filextension!='.jpg')&&(filextension!='.gif')&&(filextension!='.jpeg')&&(filextension!='.png')&&(filextension!='.bmp'))
    {
        alert("是不是选择出现了问题呢U•ェ•*U");
        imgFile.focus();
    }
    else
    {
        var path;
        if(document.all)//IE
        {
            imgFile.select();
            path = document.selection.createRange().text;
            document.getElementById("imgPreview").innerHTML="";
            document.getElementById("imgPreview").style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(enabled='true',sizingMethod='scale',src=\"" + path + "\")";//使用滤镜效果      
        }
        else//FF
        {
            path=window.URL.createObjectURL(imgFile.files[0]);// FF 7.0以上
            //path = imgFile.files[0].getAsDataURL();// FF 3.0
            document.getElementById("imgPreview").innerHTML = "<img id='img1' src='"+path+"'/>";
            //document.getElementById("img1").src = path;
        }
    }
}
</script>
<?php
	if(isset($_POST['update'])){
		@$userdetail = $_POST['detail'];
		@$rtmp_url = $_POST['rtmp'];
		@$livedetail = $_POST['livedetail'];
		@$type = $_POST['type'];
		if(!preg_match('/^rtmp:\/\/[0-9.]+\/live\/$/', $rtmp_url)){  
    		echo"<script>alert('不行啊rtmp不对啊');location='javascript:history.go(-1)';</script>";  
		}  else{
		$stmt = $db->prepare("update live set userdetail=?,rtmp_url=?,livedetail=?,type=? where ID=?");
		$stmt->bindparam(1,$userdetail);
		$stmt->bindparam(2,$rtmp_url);
		$stmt->bindparam(3,$livedetail);
		$stmt->bindparam(4,$type);
		$stmt->bindparam(5,$row['ID']);
		$stmt->execute();
		if(mysqli_affected_rows($aVar)!=1) die(0); 
        	echo "<script>alert('改好了哦');window.location.href='personal.php';</script>"; 
		}
	}
?>
