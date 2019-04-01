<?php
	header("Content-type:text/html;charset=utf-8");
	$id =$_POST['id'];
	$content =$_POST['content'];
	$username =$_POST['username'];
	$sql    = "update message set username='{$username}',content='{$content}' where id ={$id}"; //拼凑
	$mysqli = new mysqli ('127.0.0.1','root','','message');// 连接
	$query  = $mysqli->query($sql);
	if ($query){
		echo '成功';
	}