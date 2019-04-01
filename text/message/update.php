<?php
	header("Content-type:text/html;charset=utf-8");
	$id = $_GET['id'];
	$sql    = "select * from message where id ={$id}"; //拼凑
	$mysqli = new mysqli ('127.0.0.1','root','','message');// 连接
	$query  = $mysqli->query($sql);
	$info =$query->fetch_array(MYSQLI_ASSOC);
	//var_dump($info); die();
	include "./update.html";