
<?php
require_once dirname(__FILE__) . '/../Classes/PHPExcel/IOFactory.php';
$filename = '1.xlsx';
$objPHPExcelReader = PHPExcel_IOFactory::load($filename);
$sheet = $objPHPExcelReader->getSheet(0); //读取第一个工作表
$highestRow = $sheet->getHighestRow();   //总行数
$highestColumn = $sheet->getHighestColumn();  //总列数


//$column=1;$row=2;
for ($row = 1; $row <= $highestRow; $row++) {
    for ($column = 0; $column <= 1; $column++) {
        $val = $sheet->getCellByColumnAndRow($column, $row)->getValue();
        echo ' ';
        echo $val;
    }
}
