<?php

date_default_timezone_set('PRC');
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
$time = date('YmdHis');

$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("长恒文化公司")
							 ->setLastModifiedBy("M长恒文化公司")
							 ->setTitle("长恒文化公司报表")
							 ->setSubject("长恒文化公司报表")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("长恒文化公司");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');




$objPHPExcel->getActiveSheet()->setCellValue('A8',"Hello\nWorld");
$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);


$value = "-ValueA\n-Value B\n-Value C";
$objPHPExcel->getActiveSheet()->setCellValue('A10', $value);
$objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getStyle('A10')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A10')->setQuotePrefix(true);



$objPHPExcel->getActiveSheet()->setTitle('拼团订单数据_'.$time);

$objPHPExcel->setActiveSheetIndex(0);


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

// header("Pragma: public");  
// header("Expires: 0");  
// header("Cache-Control:must-revalidate, post-check=0, pre-check=0");  
// header("Content-Type:application/force-download");  
// header("Content-Type:application/vnd.ms-execl");  
// header("Content-Type:application/octet-stream");  
// header("Content-Type:application/download");;  
// header('Content-Disposition:attachment;filename='.$filename.'');  
// header("Content-Transfer-Encoding:binary");  
// $objWriter->save('php://output');  
$fileName=$time;
$xlsTitle=2;
header('pragma:public');
header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xlsx"');
header("Content-Disposition:attachment;filename=$fileName.xlsx");//attachment新窗口打印inline本窗口打印
$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>