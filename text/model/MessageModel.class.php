<?php
	class MessageModel extends BassModel {
		public $tableName="message";
		public $file='id,user_id,img,content,createtime';

		public function getListsByUserId ($userId) {
            $where = array('user_id'=> $userId);
            $lists = $this->getListByWhere($where);
            return $lists;
        }

	}  


