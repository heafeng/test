<?php
namespace app\index\model;
use think\Model;
/**
 * 
 */
class User extends Model
{
	
	public function add($a) {
		$this->save($a);
	}
}