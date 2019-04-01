<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\model\Word as WordAdmin;
use think\Db;
use think\Session;

/**
 * 
 */
class Word extends Controller
{
	
	public function add() {
		return $this->fetch();
	}
	public function save() {
		

		if(Request()->isPost()){
			$data=input('post.');
			// $data = ['foo' => 'bar', 'bar' => 'foo'];
			// Db::table('Word')->insert($data);
			$word=new WordAdmin();
			
			$adminres=$word->aad($data);
			
		}
		$this->success('添加成功','word/lit');
	}
	public function lit() {
		// $adminres=Db::table('Word')->select();
		// $this->assign('adminres',$adminres);
		$word=new WordAdmin();
		// if(class_exists('ws')){
		// 	echo "ok";
		// }else{
		// 	return $this->fetch('admin/login');
		
		// }
		$wordres=$word->getwords();
		$this->assign('wordres',$wordres);
		// return $this->fetch();
		return $this->fetch();
	}
	public function update($id) {
		if(Request()->isPost()) {
			$data=input('post.');
			//todo 
			$res=db('word')->update($data);
			if(!$res==false){
				$this->success('修改成功',url('lit'));
			}else{
				$this->error('修改失败');
			}

			return;
		}
		$word=db('word')->find($id);
		if(!$word) {
			$this->error('该信息不存在');
		}
		
		$this->assign('word',$word);
		return $this->fetch();
	}
	public function delete($id) {
		
		$words=Db::table('word')->delete($id);
		if($words){
				$this->success('删除成功',url('lit'));
			}else{
				$this->error('删除失败');
			}
	}
}