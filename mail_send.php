<?php
	$smtpserver = "#";//SMTP服务器
	$smtpserverport =465;//SMTP服务器端口
	$smtpusermail = "#";//SMTP服务器的用户邮箱
	$smtpemailto = $email;//发送给谁
	$smtpuser = "#";//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
	$smtppass = "#";//SMTP服务器的用户密码
    $users = array($email);
    $mailtitle = '这是一个验证邮件';
    $mailcontent = "亲爱的".$username."：<br/>欢迎来到Live--はな直播网。<br/>请点击下面的链接来激活您的帐号。<br/>
    <a href='/active.php?verify=".$token."' target=
'_blank'>/active.php?verify=".$token."</a><br/>
    如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。";
    $mailtype = "HTML";
    $smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
?>