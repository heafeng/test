<?php
namespace app\admin\controller;
use think\Controller;
/**
 * 
 */
class Admin extends Controller
{
	
	public function add() {
		return $this->fetch();
	}
}