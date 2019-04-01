<?php
	class UserController {
		public function tet () {
			include "./view/Public/tet.html";
		}
		public function test () {
			$number=$_POST['number'];
			$url = "http://mobsec-dianhua.baidu.com/dianhua_api/open/location?tel={$number}";
			$ch = curl_init();

			// curl_setopt($ch, CURLOPT_URL, $url); 
   //          curl_setopt($ch, CURLOPT_HEADER, TRUE); 
   //          curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body 
   //          curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 


			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$rsu=curl_exec($ch);
			$b=json_decode($rsu,true);

			foreach ($b['response'] as $key => $value) {
				$a[]="phone:{$key},{$value['detail']['province']}-{$value['detail']['area']['0']['city']},{$value['detail']['operator']}";
			}
			include "./view/Public/test.html";
			
		}
		public function login () {
			include "./view/User/login.html";
		}
		public function doLogin () {
		    $phone = !empty($_POST['phone']) ? $_POST['phone'] : '';
			$password = !empty($_POST['password']) ? $_POST['password'] : '';
			$code = !empty($_POST['yzm']) ? $_POST['yzm'] : '';
			if (empty($phone)||empty($password)){
		  		echo '没有数据'; die();
			}
			if (empty($code)) {
				echo '没有验证码'; die();
			}
			if ($code!=$_SESSION['verify']) {
				echo '验证码错误'; die();
			}
			$sql = "select * from User where phone='{$phone}' ";
			$mysqli = new mysqli ('127.0.0.1','root','','message');
			$query  = $mysqli->query($sql);
			$info =$query->fetch_array(MYSQLI_ASSOC);
			if (empty($info)) {
				echo '电话不存在'; die ();
			}
			if ($info['password']==$password) {
				unset($info['password']);
				$_SESSION['me']=$info;
				header("refresh:3;url=index.php?c=message&a=lists");
                echo 'success 3秒后跳转';
                die();
			}
			else { echo '登录失败'; die ();}
		}
		public function reg () {
			include "./view/User/reg.html";
		}
		public function doReg () {
			$name = !empty($_POST['username']) ? $_POST['username'] : '';
			$phone = !empty($_POST['phone']) ? $_POST['phone'] : '';
			$password = !empty($_POST['password']) ? $_POST['password'] : '';
			if (empty($name)||empty($phone)||empty($password)){
		  		echo '没有数据'; die();
			}
			$sql = "select * from User where phone='{$phone}' ";
			$mysqli = new mysqli ('127.0.0.1','root','','message');
			$query  = $mysqli->query($sql);
			$info =$query->fetch_array(MYSQLI_ASSOC);
			if (!empty($info)) {
				header("refresh:3;url=index.php?c=User&a=reg");
                echo 'success 3秒后跳转';
                die();
			}
			$time   = time();
			$sql    = "insert into User (username,phone,password,createtime) value('{$name}','{$phone}','{$password}',{$time})"; //拼凑
			// 连接
			$query  = $mysqli->query($sql);//执行
			if ($query){
				header("refresh:3;url=index.php?c=User&a=login");
                 'success 3秒后跳转';
                dieecho();
			}
		}
		public function loginOut () {
			unset($_SESSION['me']);
			header("refresh:3;url=index.php?c=User&a=login");
        	echo 'success 3秒后跳转';
            die();

		}
	}