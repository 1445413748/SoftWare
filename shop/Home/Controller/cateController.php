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

			$page = new Page;
			$count = $this->cate->count();
			$limit = $page->limit($count);

 		$res = $this->cate->categoods($limit);
 		include './View/goods/goodslist.html';
 	}
 }






