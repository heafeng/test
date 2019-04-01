<?php
	//$str='a-b-c';
	//$arr=array();
	//$st='';
	//$arr= explode('-',$str);
	//$st= implode(',', $arr);
	
	//var_dump($st);
	//var_dump($arr);
	$str = "i ma heafeng";
	$str = ucfirst($str);
	echo $str;
	$str = ucwords($str);
	echo $str;
	$str=str_replace('Heafeng','chen',$str);
	echo $str;
	$a=substr($str,"a");
	echo $a;
	strlen($str);
	$b=strpos($str,"a");
	echo $b;