<?php

class TestController{
	function test($f3){
		//数据库操作
		//需要打开index.php中关于数据库的两行注释
		// $db = $f3->get('DB');
		// $uModel = new \DB\SQL\Mapper($db,'user');
		// $users = $uModel->select('*');
		// var_dump($users);

		$f3->set("test_var","Hello World!");
		echo Template::instance()->render('application/test.htm');
	}
}