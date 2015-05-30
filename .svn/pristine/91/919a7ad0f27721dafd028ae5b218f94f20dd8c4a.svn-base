<?php
 require_once 'vendor/PHPExcel/PHPExcel.php';

class DownloadExcelModel{
     
    /*
    *流程：1. 创建Excel表
    *2. 构建Excel内容
    *3. 保存Excel并download
    *参数：$titleStr  Excel表前两行内容
    *      $filedname Excel字段名
    *      $tableSequence  数据库查询到的内容中在创建Excel时将要用到的几列
    *      $content 数据库查询到的需在Excel中保存的数据
    */
	function download($titleStr,$filedname,$tableSequence,$content){
		 // Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		DownloadExcelModel::setExcelHead($objPHPExcel,$titleStr);
		DownloadExcelModel::setExcelTitle($objPHPExcel,$titleStr);
		DownloadExcelModel::setExcelContent($objPHPExcel,$filedname,$tableSequence,$content);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}
	 //创建excel头信息
	function setExcelHead(PHPExcel $objPHPExcel,$titleStr){
     // Set document properties
		$objPHPExcel->getProperties()->setCreator("ZSDataMiner")
		->setLastModifiedBy("ZSDataMiner")
		->setTitle("Office 2007 XLSX Test Document")
		->setSubject("Office 2007 XLSX Test Document")
		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
		->setKeywords("office 2007 openxml php")
		->setCategory("NWPU data file");
		// Redirect output to a client’s web browser (Excel5)
		$excName=$titleStr.".xls";
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$excName);
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('喜报');
	}

	//设置Excel的title
	function setExcelTitle(PHPExcel $objPHPExcel,$titleStr){
		$objPHPExcel->setActiveSheetIndex(0);
		//合并单元格
		$objPHPExcel->getActiveSheet()
		->mergeCells('A1:G2')
		->setCellValue('A1',$titleStr);
		//设置font
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('utf-8');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(24);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//垂直居中
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()
		       ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()
		       ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	}

	/*设置Excel的content
	*参数：$titleStr  Excel表前两行内容
    *      $filedname Excel字段名
    *      $tableSequence  数据库查询到的内容中在创建Excel时将要用到的几列
    *      $content 数据库查询到的需在Excel中保存的数据
    */
	function setExcelContent(PHPExcel $objPHPExcel,$filedname,$tableSequence,$content){
		//Add filedname
		foreach ($filedname as $key => $value) {
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue(chr(ord('A')+$key).'3', $value);
		}

		// Add some data
         foreach ($content as $conkey => $convalue) {
         	foreach ($filedname as $filedkey => $filedvalue) {
         		 $filedNum=4+$conkey;
         		 $con=array_values($convalue);
         		 $objPHPExcel->setActiveSheetIndex(0)
		         ->setCellValue(chr(ord('A')+$filedkey).$filedNum, 
		         	$con[$tableSequence[$filedkey]]);
         	}
         }
		
	}

	//专门处理中文字符串：
	function convertUTF8($str){
	   if(empty($str)) return '';
	   return  iconv('gb2312', 'utf-8', $str);
	}

}