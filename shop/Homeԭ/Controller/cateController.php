<?php 

 class cateController extends Controller
 {
 	public function __construct()
 	{
 		parent:: __construct();
 		$this->cate = new cateModel;
 	}

 	public function index()
 	{

 		// 分页
			$page = new Page;
			$count = $this->cate->count();
			// var_dump($count); die;
			$limit = $page->limit($count);

 		$res = $this->cate->categoods($limit);
 		include './View/goods/goodslist.html';
 	}
 }






