<?php
	class UserModel extends BassModel{
		public $tableName='user';
		public function __construct () {
			parent::__construct();
		}
		public function getUserByInfo ($ids) {
			$mysqli = new mysqli('127.0.0.1','root','','message');
			$sql = "select id,username from user where id in ({$ids}) ";
			$query = $mysqli->query($sql); 
			if (!empty($query)&&$query->num_rows > 0) {
		      	$allUserList = $query->fetch_all(MYSQLI_ASSOC);
		    } else  {
		      	$allUserList =array ();
		    } 
		    return $allUserList;
		}
	}