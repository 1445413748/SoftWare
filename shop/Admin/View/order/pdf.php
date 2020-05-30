<?php
//-----------获取订单数据---------------------------------------
include_once '../../../Config/config.php';
include_once '../../../Config/DB.php';
include_once '../../Model/orderModel.php';
$order = new orderModel;
$where = null;
if( !empty($_GET['search']) ){
    $s = $_GET['search'];
    $where = 'ordernum like "%'.$s.'%" or  username like "%'.$s.'%"';
}
$res = $order->getOrder($where); 

//-----------生成PDF-----------------------------------------------
include '../../../Plugin/FPDF/chinese.php';
	$pdf = new PDF_Chinese();
    $pdf->AddGBFont('simhei', '黑体');
    $pdf->AddPage();
    $pdf->SetFont('simhei', '', 20);

    $pdf->Cell(40,10,iconv("utf-8","gbk","订单列表"));
    $pdf->Ln();//换行

    $pdf->SetFont('simhei', '', 10);
    //输出表格
    //Cell方法最后一个参数表示是否显示边框
    $pdf->Cell(10,10,iconv("utf-8","gbk","ID"),1);
    $pdf->Cell(17,10,iconv("utf-8","gbk","用户昵称"),1);
    $pdf->Cell(40,10,iconv("utf-8","gbk","订单号"),1);
    $pdf->Cell(17,10,iconv("utf-8","gbk","订单金额"),1);
    $pdf->Cell(17,10,iconv("utf-8","gbk","支付方式"),1);
    $pdf->Cell(17,10,iconv("utf-8","gbk","订单状态"),1);
    $pdf->Cell(17,10,iconv("utf-8","gbk","已取消"),1);
    $pdf->Ln();

    foreach ($res as $k => $v){
        if ($v['orderstatus']== 1):
            $orderstatus='已发货';
       elseif ($v['orderstatus']== 2):
            $orderstatus='未发货';
       elseif ($v['orderstatus']== 3):
        $orderstatus='待评价';
       else:
        $orderstatus='已评价';   
    endif;
        $pdf->Cell(10,10,iconv("utf-8","gbk",$v['orderid']),1);
        $pdf->Cell(17,10,iconv("utf-8","gbk",$v['username']),1);
        $pdf->Cell(40,10,iconv("utf-8","gbk",$v['ordernum']),1);
        $pdf->Cell(17,10,iconv("utf-8","gbk",$v['totalprice']),1);
        $pdf->Cell(17,10,iconv("utf-8","gbk","在线支付"),1);
        $pdf->Cell(17,10,iconv("utf-8","gbk",$orderstatus),1);
        $pdf->Cell(17,10,iconv("utf-8","gbk","否"),1);
        $pdf->Ln();
         
}  

   

    //插入图片
    //Image参数：文件，x坐标，y坐标，宽，高
    //$pdf->Image('test.jpg',null,null,50,50);

    $pdf->Output();//直接输出，即在浏览器显示

    //$pdf->Output('example.pdf','F');//保存为example.pdf文件
    ?>
