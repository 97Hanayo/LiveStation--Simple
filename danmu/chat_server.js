var express = require('express')
    , app = express()
	, fs = require('fs')
    /*, options = {
        pfx: fs.readFileSync('2b9f95f4-053f-40f4-8b91-e9cfca585657.p12'),
		passphrase: '12',
        requestCert: false
    }
	server = require('https').createServer(options,app)*/
	server = require('http').createServer(app)
    , io = require('socket.io').listen(server);
	
server.listen(2121);

	//一个客户端连接的字典，当一个客户端连接到服务器时，
//会产生一个唯一的socketId，该字典保存socketId到用户信息（昵称等）的映射
var connectionList = {};
//房间在线人数。
var countRoomPeople = {};
    io.sockets.on('connection', function (socket) {
		
        //客户端连接时，保存socketId和用户名
        var socketId = socket.id;
        connectionList[socketId] = {
            socket: socket,
			roomid: "",
			username: ""
        };
		
		//接收到获取在线人数后，返回在线人数。
		socket.on('getPeopleOnline',function(data){
			var online;
			if(countRoomPeople[data.roomid]==undefined){
				online=0;
			}
			else{
				online=countRoomPeople[data.roomid];
			}
			socket.emit('peopleOnline',{
					online: online,
					roomid: data.roomid
			});
			
		});
		
		socket.on('join', function (data) {
			connectionList[socketId].roomid=data.roomid;
            connectionList[socketId].username=data.username
			if(countRoomPeople[data.roomid]==undefined){
				countRoomPeople[data.roomid]= 1;
			}else{
				countRoomPeople[data.roomid]=countRoomPeople[data.roomid]+1;
			}
			socket.broadcast.emit('peopleOnline',{
					online: countRoomPeople[data.roomid],
					roomid: data.roomid
			});
        });
		
        //用户离开聊天室事件，删除CONNECT信息
        socket.on('disconnect', function () {
			countRoomPeople[connectionList[socketId].roomid]=countRoomPeople[connectionList[socketId].roomid]-1;
			socket.broadcast.emit('peopleOnline',{
					online: countRoomPeople[connectionList[socketId].roomid],
					roomid: connectionList[socketId].roomid
			});
            delete connectionList[socketId];
        });
        //用户发言事件，向其他在线用户广播其发言内容
        socket.on('say', function (data) {
			var text = data.text;
			var color = data.color;
			if(text.length<=100){
				text = text.replace(/'/g,"&#39;");
				//var color = data.color;
				/*var username=data.username;
				if(username==""){
					username="Guest("+socketId+")";
				}*/
				text = text.replace(/</g,'-');
				text = text.replace(/>/g,'-');
				//text = text.replace(/@/g,'-');
				
				//记录日志
				if(connectionList[socketId].username!=""){
					console.log(connectionList[socketId].username+" : "+text+"\r\n");
				}else{
					console.log(socketId+" : "+text+"\r\n");
				}
				//广播事件
				socket.broadcast.emit('broadcast_say',{
					username: connectionList[socketId].username,
					//textcolor: textcolor,
					color: color,
					text: text,
					roomid:data.roomid
				});
			}
			
		});
	
	});

