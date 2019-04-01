<?php
	
	header("Content-type:text/html;charset=utf-8");
	define('APP_START',1);

	$a = !empty($_GET['a']) ? $_GET['a'] : 'lists';
	$c = !empty($_GET['c']) ? $_GET['c'] : 'Message';
	$c =$c . "Controller";
	
	session_start();
	include "./common/function.php";

	$obj = new $c ();
	$obj->$a();
	
	function __autoload ($class) {
		$dir='';
		if (strpos($class, 'Model')) {
			$dir ='model';
		}elseif (strpos($class, 'Controller')) {
			$dir ='controller';
		}
		// $he="./{$dir}/{$class}.class.php";
		// var_dump($he);
		include_once "./{$dir}/{$class}.class.php";
		
	}
