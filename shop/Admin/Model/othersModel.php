<?php
class othersModel
{
    public function __construct()
    {
        $this->db = new DB;
    }
    public function doAdd()
    {

        if ($_FILES["file"]["error"] > 0) {
            echo "错误：" . $_FILES["file"]["error"] . "<br>";
            return false;
        } else {
            $filename = $_FILES["file"]["tmp_name"];
            $objPHPExcelReader = PHPExcel_IOFactory::load($filename);
            $sheet = $objPHPExcelReader->getSheet(0); //读取第一个工作表
            $highestRow = $sheet->getHighestRow();   //总行数
            $highestColumn = $sheet->getHighestColumn();  //总列数

            for ($row = 1; $row <= $highestRow; $row++) {
                for ($column = 0; $column <= 1; $column++) {
                    $val = $sheet->getCellByColumnAndRow($column, $row)->getValue();
                    if($column==0)
                    $data['tel']=$val;
                    else
                    $data['pwd']=md5($val);
                }
                $data['status']=1;
                $res = $this->db
                ->table('`user`')
                ->insert($data);
            }
            return true;
        }
    }
}
