<?php

date_default_timezone_set('PRC');
require_once "../../../lib/mysql.func.php";
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
$cellKey = array(
    'A','B','C','D','E','F','G','H','I','J','K','L','M',
    'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
    'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
    'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
);
if(isset($_REQUEST['id'])){
    $StoreID=$_REQUEST['id'];
}

$mysql=new mysql;
$sum=$mysql->fetchOne("select sum(price2) as sum from participant left join activity on actid=activity.id where participant.store=$StoreID")['sum'];
$data=$mysql->fetchAll("select nickname,participant.name,participant.phone,participant.address,title,price1,price2,(case when mode=0 then '外送' else '到店自取' end) as mode,store.name as sname,(case when state=1 then '待发货' when state=4 then '未完成' when state=2 or 3 then '已收货' when state=5 then '已取消' end) as state,time,(1),price2 as price from participant LEFT JOIN activity on actid=activity.id left join userinfo using (openid) left join store on participant.store=store.id where store.id=$StoreID");
$thead=array('昵称','姓名','联系方式','地址','商品名称','原价','购买价','配送方式','自提核销','状态','添加时间','单数','价格');
if($data==null){
    echo "<script>alert('暂无订单');history.go(-1);</script>";
}else{
    exportOrderExcel($thead,$data);
}


function exportOrderExcel($thead,$data)
{
    global $sum;
    global $cellKey;
    $fileName= $xlsTitle=$time = date('YmdHis');
    $objPHPExcel = new PHPExcel();
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("长恒文化公司")
        ->setLastModifiedBy("M长恒文化公司")
        ->setTitle("长恒文化公司报表")
        ->setSubject("长恒文化公司报表")
        ->setDescription("")
        ->setKeywords("")
        ->setCategory("长恒文化公司");
    $objPHPExcel->getActiveSheet()->setTitle('拼团订单数据_' . $time);
    $objPHPExcel->setActiveSheetIndex(0);

    //表头
    $len=count($thead);
    for($i=0;$i<$len;$i++){
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($cellKey[$i].'1', $thead[$i]);
    }

    //数据
    $i=1;$j=0;
    foreach($data as $row){
        $i++;
        $j=0;
        //echo '<br>';
        foreach($row as $key=>$val){  
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($cellKey[$j].$i,$row[$key]);
           //echo $key.' ';
            $j++;
        }
    }

    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue($cellKey[--$j].++$i,$sum);
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue($cellKey[++$j].$i,'总消费');

    header('pragma:public');
    header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xlsx"');
    header("Content-Disposition:attachment;filename=$fileName.xlsx"); //attachment新窗口打印inline本窗口打印
    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
}
