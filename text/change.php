<?php
	$mysqli=mysqli('127.0.0.1', 'root', '', 'message');
	$sql="select * from message where id ={} ,limit {$limit}";
	$query=$mysqli->query($sql);
	$res=$query->fetch_all(MYSQLI_ASSOC);
	if (empty($res)) {
		break;
	}
	foreach ($res as $key => $value) {
		$tmp
	}
	while (ture) {
		
	}