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

	function listAllArticles($f3){
		$db = $f3->get('DB');
		$article = new \DB\SQL\Mapper($f3->get('DB'),'middleschool');
		$limit = 10;
		$page = \Pagination::findCurrentPage();
		$filter = array('provinceId = ?',11);
		$option = array('order' => 'code DESC');

		$subset = $article->paginate($page-1, $limit, $filter, $option);
		$f3->set('articleList', $subset);
		echo Template::instance()->render('test.html');

	}
}