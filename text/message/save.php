<?php
	header("Content-type:text/html;charset=utf-8");
	$username = $_POST['username'];
	$content  = $_POST['content'];
	if (empty($username)||empty($content)){
		die();
	}
	$time   = time();
	$sql    = "insert into message (username,content,createtime) value('{$username}','{$content}',{$time})"; //拼凑
	$mysqli = new mysqli ('127.0.0.1','root','','message');// 连接
	$query  = $mysqli->query($sql);//执行
	if ($query){
		echo '成功';
	}
	else {
		echo 'erro';
	}