<?php
namespace app\index\controller;
use \think\Controller;    
use \think\Db; 			
use \app\common\controller\Base;
use \app\index\model\User;
/**
 * 
 */
class Heafeng extends Base
{
	
	public function heafeng ()
	{
		// $a= new Base();
		// $a->a();
		$arr=[
			[
				'a'=>1,
				'b'=>'he'
			],

			[
				'a'=>2,
				'b'=>'hea'
			]
			
		];
		$this->assign('he',$arr);
        return $this->fetch();
		// $a=array(
		// 	'username'=>'123',
		// 	'phone' => '454545',
		// 			);
  //      $user  = new User();
  //      $adduser = $user->add($a);
		
		
		//  Db::execute('insert into user (username,phone) values (?, ?)',['h1e',10086679936]);
		// $a = Db::query('select * from user where id=?',[1]);
		// dump($a);
		// $b=Db::table('user')->where('id',1)->find();
		// dump($b);
		// $c=Db::table('user')->where('id',1)->select();
		// dump($c);
	// 	$data = ['username' => 'bar', 'phone' => '111111111'];
	// 	Db::table('user')->insert($data);
	 }
	// $a = Db::query('select * from user where id=?',[1]);
	
}
$data = [
    ['foo' => 'bar', 'bar' => 'foo'],
    ['foo' => 'bar1', 'bar' => 'foo1'],
    ['foo' => 'bar2', 'bar' => 'foo2']
];