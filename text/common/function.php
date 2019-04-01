<?php
	function D($name){
		// var_dump($name);die();
		static $classMap;
		$name = ucfirst($name);
		
		if (!empty($classMap[$name])) {
			return $classMap[$name];
		}
		$className =$name."Model";
		// var_dump($classMap[$name]);die();
		$obj=new $className();
		$classMap[$name]=$obj;
		return $classMap[$name];
	}
	function uploadFile($name='photo') {
		$i=rand(10000,90000);
		$i.=time();
		// var_dump($_FILES);die();
		$ext=explode('.', $_FILES[$name]['name']);
		$ext=array_pop($ext);
		$dir="./upload/";
		$path = date('Y-m-d');
		if (!is_dir($dir.$path)) {
			mkdir($dir.$path,0777,true);
		}
		$newNameFile=$dir.$path.'/'.$i.'.'.$ext;
        // var_dump($newNameFile);die();

		move_uploaded_file($_FILES[$name]['tmp_name'], $newNameFile);
		return $newNameFile;
	}
	function randerTmp($name) {
        include "./view/Public/{$name}.html";
        
    }
	
	function _res($data) {
        $result = array(
            "data"=> array(),
            );
        $result['data'] = $data;
        echo json_encode($result);
        die();
    }
    // function doUp () {
    	
    function getTree($data,$pid) {
    	$tree=array();
    	foreach ($data as $key => $value) {
    		if ($pid==$value['id']) {
    			$value['chile']=getTree($data,$value['id']);
    		}
    		$tree[]=$value;
    	}
    	return $tree;
    }


    function getTree1($data) {
    	$tmp=array();
    	foreach ($data as $key => $value) {
    		$tmp[$value['id']]=$value;
    	}
    	foreach ($tmp as $key => $value) {
    		if (isset($tmp[$value['pid']])) {
				   $tmp[$value['pid']]['chile'][]=&$tmp[$key];		
    		}else {
    			$tree[]=&$tmp[$key];
    		}
    		return $tree;
    	}
    }