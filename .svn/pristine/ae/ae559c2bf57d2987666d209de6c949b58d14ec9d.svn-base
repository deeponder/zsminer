<?php
require_once 'app/models/DownloadExcelModel.class.php';

class XBController {
	/*
	*将喜报结果生成的tabel转换成excel并供用户下载
	*/
	public function downXBExcel($f3){
		 //查询数据库找需要的结果
		$XBContent=$f3->get('resultData');
		//file_put_contents("D:/mylog.log",count($f3->get('resultData')),FILE_APPEND);
		$objDownExcel=new DownloadExcelModel();
		//Excel表名称
        $titleStr=$f3->get('schoolName').'喜报';
        
        //创建的数据表要保存的字段名数组
        $filedname=array(0 => '姓名',1 =>'竞赛/获奖',2 =>'竞赛/获奖等级');
        //数据库查询到的内容中在创建Excel时将要用到的几列
        $tableSequence=array(0=>0, 1=>1, 2 =>2);
        //download函数
		$objDownExcel->download($titleStr,$filedname,$tableSequence,$XBContent);
    }
}