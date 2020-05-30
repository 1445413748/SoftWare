<?php
	require 'chinese.php';
	$pdf = new PDF_Chinese();
    $pdf->AddGBFont('simhei', '黑体');
    $pdf->AddPage();
    $pdf->SetFont('simhei', '', 13);

    $pdf->MultiCell(180,10,iconv("utf-8","gbk","中文自动换行中文自动换行中文自动换行中文自动换行中文自动换行中文自动换行中文自动换行中文自动换行中文自动换行中文自动换行中文自动换行"));

    $pdf->Cell(40,10,iconv("utf-8","gbk","第一个单元格"));
    $pdf->Ln();//换行
    $pdf->Cell(40,10,iconv("utf-8","gbk","第二个单元格"));
    $pdf->Ln();//换行

    //输出表格
    $pdf->Cell(60,10,iconv("utf-8","gbk","姓名"),1);
    $pdf->Cell(60,10,iconv("utf-8","gbk","性别"),1);
    $pdf->Ln();
    $pdf->Cell(60,10,iconv("utf-8","gbk","张三"),1);
    $pdf->Cell(60,10,iconv("utf-8","gbk","男"),1);
    $pdf->Ln();
    $pdf->Cell(60,10,iconv("utf-8","gbk","李四"),1);
    $pdf->Cell(60,10,iconv("utf-8","gbk","女"),1);
    $pdf->Ln();


    $pdf->Output();//直接输出，即在浏览器显示
