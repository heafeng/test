<?php
    defined("APP_START") ||  die('no allow');
	class ClassifyController {
		public function lists () {
			$p = (!empty($_GET['p'])&&$_GET['p']>0) ? $_GET['p'] : 1 ;
			$where=array();

			$limit = 10;
			$offset=$limit*($p-1);

			$where= " 1 ";
			
			$count = D('classify')->getCountByWhere($where);
            
			$pageNum=ceil($count/$limit);

            $result = D('classify')->getListByWhere($where);
			include "./view/Classify/lists.html";

		}
		public function add () {
			include "./view/Classify/add.html";
		}
		public function save () {
			// if (empty($_SESSION['me'])) {
			// 	header("refresh:3;url=index.php?c=User&a=login");
   //              echo 'erro 3秒后跳转';
   //              die();
			// }
			// var_dump($_POST);die();
			$name = $_POST['name'];
			$pid  = $_POST['pid'];



			if (empty($name)){
				die();
			}
			$time   = time();

            $data = array(
            	'name'=>$name,
                'pid' => $pid,
                );
            $query = D('classify')->insert($data);

			// $sql    = "insert into message (user_id,username,content,createtime) value({$user_id},'{$username}','{$content}',{$time})"; //拼凑
			// $mysqli = new mysqli ('127.0.0.1','root','','message');// 连接
			// $query  = $mysqli->query($sql);//执行
			if ($query){
				header("refresh:3;url=index.php?c=classify&a=lists");
                echo 'success 3秒后跳转';
			}
			else {
				echo 'erro';
			}
		}
	}