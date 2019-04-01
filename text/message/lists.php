<?php
	$sql = "select id,username,content,createtime from message"; // 拼凑
	$mysqli = new mysqli('127.0.0.1','root','','message');    //链接
	$query = $mysqli->query($sql);       //   执行
	$result = $query->fetch_all(MYSQLI_ASSOC);
	include "lists.html";