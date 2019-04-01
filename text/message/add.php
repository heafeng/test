<?php
//	header("Content-type:text/html;charset=utf-8");
//	include "./add.html";//显示页面
//	echo get_class(new class {};
//	$a = array ('c','b','d','e','f');
	$arr=array('a','b','c');
	array_unshift($arr, 'e');
	array_push($arr, 'g');
	
	array_shift($arr);
	array_pop($arr);
	$b='b';
	$key=array_search($b, $arr);
	unset($arr[$key]);
	$ar=array('d','s','f','e');
	$arr =array_merge($arr,$ar);
	//$arr =array_slice($arr, 3,2);
	var_dump($arr);
	var_dump(current($arr));
	next($arr);
	var_dump(current($arr));
	//var_dump($arr);
	//$key =array_keys($arr);
	//$values =array_values($arr);
	
	$c=count($arr);
	var_dump($c);
