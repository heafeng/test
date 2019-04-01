<?php
namespace app\admin\model;
use think\Db;
use think\Model;
/**
 * 
 */
class Word extends Model
{
	
	public function aad($data) {
		if($this->save($data)) {
			return true;
		}else{
			return false;
		}
	}
	public function getwords() {
		return $this::paginate(5);
	}
}