<?php
    defined("APP_START") ||  die('no allow');
	class MessageController {
		// public function ajkx () {
  //            $c='{"data":[{"name":"xiaohe","age":"20"},{"name":"xiaoli","age":"21"},{"name":"xiaowang","age":"21"},{"name":"xiaochen","age":"22"},{"name":"xiaozhao","age":"22"},{"name":"xiaohog","age":"20"}]}';
  //            $d=json_decode($c,true);
  //            var_dump($d);die();
		// }
		// public function test () {
		// 	$a =array (
		// 		array('name'=>'xiaohe','age'=>'20'),
		// 		array('name'=>'xiaoli','age'=>'21'),
		// 		array('name'=>'xiaowang','age'=>'21'),
		// 		array('name'=>'xiaochen','age'=>'22'),
		// 		array('name'=>'xiaozhao','age'=>'22'),
		// 		array('name'=>'xiaohog','age'=>'20'),
		// 		);
		// 	_res($a);		
		// }
        public function ajax () {
            include "./view/message/ajax.html";
        }
        // public function test () {
        //     $id =$_POST['id'];
        //     $user = D('user')->getListByWhere(array());

        //     $message = D('message')->getListByWhere(array());
        //     _res(array('user'=>$user, 'message'=>$message, 'id'=>$id));
        // }
        public function ceshi () {
            include "./view/Public/footer.html";
        }

		public function lists () {
			$user_id=(!empty($_GET['user_id'])) ? $_GET['user_id'] : 0;
			$content=(!empty($_GET['content'])) ? $_GET['content'] : '';
			$username=(!empty($_GET['username'])) ? $_GET['username'] : '';
			$p = (!empty($_GET['p'])&&$_GET['p']>0) ? $_GET['p'] : 1 ;

			$mysqli = new mysqli('127.0.0.1','root','','message');  //链接 

			$limit = 10;
			$offset=$limit*($p-1);

			$where= " 1 ";
			if (!empty($username)) {
                $sql = "select id from user where username = '{$username}'";
                $query = $mysqli->query($sql);
                $user = $query->fetch_array(MYSQLI_ASSOC);
                $user_id = $user['id'];
           }
			if (!empty($user_id)) {
				$where.=" and user_id ={$user_id}";
			}	
			if (!empty($content)) {
				$where.=" and content ='{$content}'";
			}

          
			
			$count = D('message')->getCountByWhere($where);
            
			$pageNum=ceil($count/$limit);

            $result = D('message')->getListByWhere($where, 'id asc', $offset, $limit);

			// $sql = "select * from message where {$where} limit {$offset},{$limit}"; // 拼凑
			// //$mysqli = new mysqli('127.0.0.1','root','','message');    //链接 
			
   //          $query = $mysqli->query($sql); 

			// if (!empty($query)&&$query->num_rows > 0) {
			//       	$result = $query->fetch_all(MYSQLI_ASSOC);
			//       } else  {
			//       	$result =array ();
			//       }     //   执行	
			

			//通过result 拿userid
            //批量获取user
            //组装进result里 （二维数组转一维数组）
            $allUser = array();

            foreach ($result as $key => $value) {
            	$allUser[]=$value['user_id'];
            }
            $allUser= array_unique($allUser);

            $ids=implode(',', $allUser);
            $allUserList = D('user')->getUserByInfo($ids);

            $tmpUser = D('user')->trunData($allUserList);
           //

   //          $sql = "select id,username from user where id in ({$ids})";
            
   //          $query = $mysqli->query($sql); 
   //          if (!empty($query)&&$query->num_rows > 0) {
		 //      	$allUserList = $query->fetch_all(MYSQLI_ASSOC);
			// } else  {
		 //      	$allUserList=array ();
		 // 	} 
		 	
		 	

		  	// $tmpUser=array ();
			// foreach ($allUserList as $key => $value) {
			// 	$tmpUser[$value['id']]=$value['username'];
	  //       }				      
			
            
			foreach ($result as $key => $value) {
                $result[$key]['username'] = $tmpUser[$value['user_id']]['username'];   
            }
             // var_dump($result);die();
			include "./view/message/lists.html";

		}
		public function add () {
            // $dir="./file/";
            // move_uploaded_file($_FILES['photo']['tmp_name'], $dir.$_FILES['photo']['name']);
			include "./view/message/add.html";
		}
		// public function file () {
		// 	include "./view/message/file.html";
		// }
		// public function doUp () {
  //   		$dir="./file/";
  //   		move_uploaded_file($_FILES['photo']['tmp_name'], $dir.$_FILES['photo']['name']);
    	// }
		public function save () {
			if (empty($_SESSION['me'])) {
				header("refresh:3;url=index.php?c=User&a=login");
                echo 'erro 3秒后跳转';
                die();
			}
            
            $img = uploadFile('file');
			$username = $_POST['username'];
			$content  = $_POST['content'];
			$user_id=$_SESSION['me']['id'];
			if (empty($username)||empty($content)){
				die();
			}
			$time   = time();

            $data = array(
                'user_id' => $user_id,
                'img'=> $img,
                'content' => $content,
                'createtime' => $time,
                );
            $query = D('message')->insert($data);

			// $sql    = "insert into message (user_id,username,content,createtime) value({$user_id},'{$username}','{$content}',{$time})"; //拼凑
			// $mysqli = new mysqli ('127.0.0.1','root','','message');// 连接
			// $query  = $mysqli->query($sql);//执行
			if ($query){
				header("refresh:3;url=index.php?c=message&a=lists");
                echo 'success 3秒后跳转';
                die();
			}
			else {
				echo 'erro';
			}
		}
		public function delate () {
			$id = $_GET['id'];
			// $sql    = "delete from message where id ={$id}"; //拼凑
			// $mysqli = new mysqli ('127.0.0.1','root','','message');// 连接
			// $query  = $mysqli->query($sql);

            $query = D('message')->delete($id);

			if ($query){
				header("refresh:3;url=index.php?c=message&a=lists");
                echo 'success 3秒后跳转';
                die();
			}
		}
		public function update () {
			$id = $_GET['id'];
			$sql    = "select * from message where id ={$id}"; //拼凑
			$mysqli = new mysqli ('127.0.0.1','root','','message');// 连接
			$query  = $mysqli->query($sql);
			$info =$query->fetch_array(MYSQLI_ASSOC);
			//var_dump($info); die();
			include "./view/message/update.html";
		}
		public function edit () {
			$id =$_POST['id'];
			$content =$_POST['content'];
			$username =$_POST['username'];
			$sql    = "update message set username='{$username}',content='{$content}' where id ={$id}"; //拼凑
			$mysqli = new mysqli ('127.0.0.1','root','','message');// 连接
			$query  = $mysqli->query($sql);  // $uqery =$mysqli->query(sql);
			if ($query){
				header("refresh:3;url=index.php?c=message&a=lists");
                echo 'success 3秒后跳转';
                die();
	        }
		}
		public function img() {
            $image = imagecreatetruecolor(100, 30);
            $bgcolor = imagecolorallocate($image,255,255,255);
            imagefill($image, 0, 0, $bgcolor);

            // $fontsize = 10;
            // $x = 10;
            // $y = 5;
            // $fontcontent = 'maying';
            // $fontcolor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120)); 
            
            //
            $captcha_code = '';
            for($i=0;$i<4;$i++){
                //设置字体大小
                $fontsize = 8;    
                //设置字体颜色，随机颜色
                $fontcolor = imagecolorallocate($image, rand(0,120),rand(0,120), rand(0,120));      //0-120深颜色
                //设置需要随机取的值,去掉容易出错的值如0和o
                $data ='abcdefghigkmnpqrstuvwxy3456789';

                //取出值，字符串截取方法  strlen获取字符串长度
                $fontcontent = substr($data, rand(0,strlen($data)),1);
                //10>.=连续定义变量
                $captcha_code .= $fontcontent;    
                //设置坐标
                $x = ($i*100/4)+rand(5,10);
                $y = rand(5,10);
                imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
            }
            //增加干扰元素，设置雪花点
            for($i=0;$i<200;$i++){
                //设置点的颜色，50-200颜色比数字浅，不干扰阅读
                $pointcolor = imagecolorallocate($image,rand(50,200), rand(50,200), rand(50,200));    
                //imagesetpixel — 画一个单一像素
                imagesetpixel($image, rand(1,99), rand(1,29), $pointcolor);
            }
            //增加干扰元素，设置横线
            for($i=0;$i<4;$i++){
                //设置线的颜色
                $linecolor = imagecolorallocate($image,rand(80,220), rand(80,220),rand(80,220));
                //设置线，两点一线
                imageline($image,rand(1,99), rand(1,29),rand(1,99), rand(1,29),$linecolor);
            }
            // 

            $_SESSION['verify'] = $captcha_code; //用于验证 验证码的
            imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
            header('Content-Type: image/png');
            imagepng($image);
            imagedestroy($image);
            die();

            //创建画布
            //定义一个背景色
            //填充背景
            //画字符串
            //干扰线
            //点
            //设置header 告诉浏览器是图片类型
            //生成图片
            //销毁画布
            //
            //
            //
            //
            //
            //imagecreatetruecolor  创建画布
            //imagefill  填充背景
            //imagecolorallocate   创建颜色 
            //imagestring   画字符串
            //imageline     画线
            //imagesetpixel 画点
            //imagepng      生成图片
            //imagedestroy  销毁画布


            
        }
        public function my () {
        	// $eamil="1828667993@baidu.com@163.com@qq.com";
        	// $p="/(\w.*?)@\w+\.\w+/";
        	// $str=preg_match_all($p, $eamil,$m);
        	// var_dump($str);
        	// var_dump($m);
        	// $name ="preg_grep preg_he";
        	// $p="/(preg)/";
        	// $str=preg_replace($p, "<span style='color:red'>$1</span>", $name);
        	// var_dump($str);
        	// error_log($a,3,my.log)
        	// try () {
        	// 	throw new Exception("Error Processing Request", 1);
        		
        	// }catch () {

        	// }
        	$a="get_name_by_com";
        	$b=explode('_',$a);
        	$c='';
        	foreach ($b as $key => $value) {
        		$c.= ucwords($value);
        	}
        	$c=lcfirst($c);
        	var_dump($c);
        }
	}

