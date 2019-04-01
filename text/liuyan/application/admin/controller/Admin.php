<?php

namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as AdminModel;
use think\Db;
use think\Session;

/**
 * 
 */
class Admin extends Controller
{
	
	public function lst() {
		if(!session('username')) {
				$this->error('error','Admin/login');
			}
		// $arr=Db::table('Word')->select();
		// $this->assign('he',$arr);
		$admin=new AdminModel();
		$adminres=$admin->getadmin();
		$this->assign('adminres',$adminres);
		return $this->fetch('admin/newlist');
	}
	public function addadmin() {

	}
	public function reg() {

		if(Request()->isPost()){
			// $data=input('post.');
			$list=new AdminModel();
			// $arr=$list->zhuce(input('post.'));
			if($list->addadmin(input('post.'))){
				$this->success('success','Admin/login');
			}else{
				$this->error('error');
			}
			return;

		}
		return $this->fetch();
	}
	public function login() {
		if(Request()->isPost()) {
			$lists=input('post.');
			$data=Db::table('admin')->where('phone',$lists['phone'])->find();
			Session::set('username',$data['username']);
			if($lists['password']=$data['password']) {
				$this->success('login success',url('admin/lst'));
			}else{
				$this->error('failed');
			}
			// dump($data);die();
			return;
		}
		return $this->fetch();
	}
	
	public function outlogin() {
		session(null);
		return $this->fetch('login');
	}
	public function edit($id) {
		if(Request()->isPost()) {
			$data=input('post.');
			$res=db('admin')->update($data);
			if(!$res==false){
				$this->success('修改成功',url('lst'));
			}else{
				$this->error('修改失败');
			}

			return;
		}
		$admin=db('admin')->find($id);
		if(!$admin) {
			$this->error('该管理员不存在');
		}
		// dump($admin);die;
		$this->assign('admin',$admin);
		return $this->fetch();
	}
	public function delete($id) {
		
		$words=Db::table('admin')->delete($id);
		if($words){
				$this->success('删除成功',url('lst'));
			}else{
				$this->error('删除失败');
			}
		return $this->fetch('lst');
	}
}