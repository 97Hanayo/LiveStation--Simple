
//	{{--聊天模块  chat moudle--}}
	//focus在聊天框的时候,回车键发送消息
	document.onkeydown=function(event){
		e = event ? event :(window.event ? window.event : null);
		if(e.keyCode==13){
			if($('#userMsg').val()!=""){
				send($('#userMsg'));
			}
		}
	}
	
	$("#btn_chatsend").on("click",function(){
		if($('#userMsg').val()!=""){
			send($('#userMsg'));
		}
	})

	var socket = io.connect('wss://www.hanayo.club:2121'); //服务器地址

	socket.on('connect',function(data){
		socket.emit('join',{
			roomid:"<?php echo $username;?>",	//作为房间区分
			username: "<?php echo empty($user)?'游客':$user;?>",
		});
		$("#chatcontent").append("<div style='color:green;margin: 10px;'>连接到了聊天服务器！<br /> </div>");
		//请求获取在线人数
		socket.emit('getPeopleOnline',{
			roomid:"<?php echo $username;?>" 
		});
	});
	socket.on('disconnect',function(data){
		$("#chatcontent").append("<div style='color:red;margin: 10px;'>聊天服务器好像有点不舒服哦<br /> </div>");
	});

	//收到在线人数改变
	socket.on('peopleOnline', function(data) {
		if(data.roomid=="<?php echo $username;?>"){
			$("#chatOnline").text(data.online);
		}
	});

	//收到别人发送的消息后，显示消息
	socket.on('broadcast_say', function(data) {
		if(data.roomid=="<?php echo $username;?>"){
			console.log(data.username + '说：' + data.text);
			var text = data.text;
			var color = data.color;
			text = data.username+"："+text;
			//显示在消息记录
			$("#chatcontent").append("<div style='width: 300px;overflow-x: hidden;margin-left: 10px;'>"+text+"</div>");
			//滚动条往下拉
			document.getElementById('chatcontent').scrollTop = document.getElementById('chatcontent').scrollHeight;
            danmakuCreate(text,color);
		}
	});
	
	function send(inputContent) {
		//获取文本框的文本
		var text=$("#userMsg").val();
		$("#userMsg").val("");
		var color=$("#colsel").css("color");
		//提交一个say事件，服务器收到就会广播
		socket.emit('say', {
			text: text,
			color: color,
			roomid: "<?php echo $username;?>"
		});
		text = text.replace(/</g,'');
		text = text.replace(/>/g,'');
		//text = text.replace(/@/g,'');
		text = "自己："+text;
		//显示在消息记录
		$("#chatcontent").append("<div style='width: 300px;overflow-x: hidden;margin-left: 10px;'> "+text+"</div>");
		document.getElementById('chatcontent').scrollTop = document.getElementById('chatcontent').scrollHeight;
        danmakuCreate(text,color);
	}

