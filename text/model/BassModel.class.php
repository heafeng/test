<?php
	class BassModel {
		public $tableName= '';
		public $file= '*';


		public function __construct() {
            if(empty($this->tableName)) {
                    die('tableName not null');
            }
        }

		public function getInfoById ($id) {
			$sql = "select {$this->file} from {$this->tableName} where id={$id} ";
			$mysqli = new mysqli ('127.0.0.1','root','','message');
			$query  = $mysqli->query($sql);
			$info =$query->fetch_array(MYSQLI_ASSOC);
			return $info;
		}
		public function getListByWhere ($where) {
			if (is_array($where)) {
				$whereStr='';
				foreach ($whereStr as $key => $value) {
					$whereStr=$key."=".$value."and";
				}
				$whereStr=trim($whereStr,'and');
			} else{
				$whereStr=$where;
			}
			if (empty($whereStr)) {
                $whereStr = '1';
            }
			$sql = "select {$this->file} from {$this->tableName} where {$whereStr} "; 
			// var_dump($sql);die();
			$mysqli = new mysqli ('127.0.0.1','root','','message');
			$query = $mysqli->query($sql); 
			// var_dump($mysqli);die();
			$lists =$query->fetch_all(MYSQLI_ASSOC);
			// var_dump($sql);die();
			return $lists;

		}
		public function getCountByWhere ($where) {
			if (is_array($where)) {
				$whereStr='';
				foreach ($where as $key => $value) {
					$whereStr= $key . "=" . $value . "and";
				}
				$whereStr=trim($whereStr,'and');
			}else {
				$whereStr=$where;
			}
			
            
			$sql = "select count(1) as num from {$this->tableName} where  {$whereStr} ";
			$mysqli = new mysqli ('127.0.0.1','root','','message');
			$query = $mysqli->query($sql);       //   执行	
			// $count = $query->fetch_array(MYSQLI_ASSOC);
			// return !empty($count['num'])? $count['num']: 0 ;
			$lists = $query->fetch_array(MYSQLI_ASSOC);
            return !empty($lists['num']) ? $lists['num'] : 0 ;


         
		}
		public function update ($data,$where,$offset=0, $limit=1) {
			$whereStr='';
			if (is_array($where)) {
				foreach ($where as $key => $value) {
					$whereStr=$key . "=" . $value . "and";
				}
				$whereStr=trim($whereStr,'and');
			}else {
				$whereStr=$where;
			}
			if (empty($whereStr)) {
				$whereStr='1';
			}
			$dataStr='';
			if (is_string($data)) {
				foreach ($data as $key => $value) {
					$dataStr.="{$key}='{$value}',";	
				}
			}else {
				$dataStr.="{$key}={$value},";
			}
			
			$dataStr=trim($dataStr,',');
			$whereStr=trim($whereStr,'and');
			$sql="update {$this->tableName} set {$dataStr} where {$whereStr} limit {$offset},{$limit}";
			$mysqli = new mysqli('127.0.0.1','root','','message');
			$query = $mysqli->query($sql);
            return $query;
		}
		public function insert ($data) {
			$keys='';
			$values='';
			foreach ($data as $key => $value) {
				$keys.= $key.",";
				if (is_string($value)) {
					$values.="'{$value}',";
				}else {
					$values.=$value.",";
				}
			}
			$keys=trim($keys,',');
			$values=trim($values,',');
			$sql ="insert into {$this->tableName} ({$keys}) value ({$values}) ";

			$mysqli = new mysqli('127.0.0.1','root','','message');
			$query = $mysqli->query($sql);
            return $query;
		}
		public function delete ($where) {
			if (is_array($where)) {
				$whereStr='';
				foreach ($where as $key => $value) {
					$whereStr=$key."=".$value."and";
				}$whereStr=trim($whereStr,'and');
			}
				else {
					$whereStr=$where;
				}

			if (empty($whereStr)) {
                $whereStr = '1';
            }
            $mysqli = new mysqli('127.0.0.1','root','','message');
            $sql = "delete from message where {where}";
            $query = $mysqli->query($sql);
            return $query;
		}
		public function trunData ($allList) {
            $tmp = array();
            foreach ($allList as $key => $value) {
                $tmp[$value['id']] = $value;
            }
            return $tmp;
        }
	}  