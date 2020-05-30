<?php 


	class categoryController extends Controller
	{

		public function __construct()
		{
			parent::__construct();
			$this->category = new categoryModel;
		}

		// 商品分类
		public function index()
		{

			// 获取所有数据
			$res = $this->category->getData();

			include './View/category/index.html';
		}

		public function doDel()
		{
			$this->category->doDel();
			header('location: index.php?c=category'); die;
		}

		// 增加分类
		public function add()
		{	
			$pid = empty($_GET['id'])? 0 : $_GET['id'];
			$path = empty($_GET['path'])? '0,' : $_GET['path'].$_GET['id'].',';
			
			include './View/category/add.html';
		}
		public function doAdd()
		{
			@$id = $GET__['id'];
			$res = $this->category->doAdd();
			// var_dump($res);  die;
			if($res){
				notice('新增成功', 'index.php?c=category&id="'.$id.'"');
			}
			// var_dump($res); die;
			notice('新增失败');
		}
		// 编辑分类
		public function edit()
		{
			// 根据id查询相关信息
			$res = $this->category->getFind();
			include './View/category/edit.html';
		}

		public function doEdit()
		{
			$res = $this->category->doEdit();
		
			if($res){
				notice('编辑成功', 'index.php?c=category');
			}
			notice('编辑失败');
		}

		// 上下架切换
		public function display()
		{
			$this->category->display();

			header('location: index.php?c=category'); die;
		}


		public function cateList()
		{
			$res = $this->category->getCateList();
			return $res;
		}

	}












