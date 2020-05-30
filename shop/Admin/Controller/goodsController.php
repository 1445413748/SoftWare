<?php 

	class goodsController extends Controller
	{
	

		public function __construct()
		{
			parent::__construct();
			$this->goods = new goodsModel;
		}

		// 商品列表
		public function index()
		{
			$where = null;
			if( !empty($_GET['search']) ){
				$s = $_GET['search'];
				$where = 'name like "%'.$s.'%" ';
			}
			// 分页
			$page = new Page;
			$count = $this->goods->count($where);
			// var_dump($count); die;
			$limit = $page->limit($count);

			// 获取所有数据
			$res = $this->goods->getData($where,$limit);

			// $res = $this->goods->getData();
			include './View/goods/index.html';
		}
		// 添加商品
		public function add()
		{
			$cate = new categoryController;
			$cateList = $cate->cateList();

			foreach ($cateList as $k => $v) {
				// 1. 统计逗号
					$num = substr_count($v['path'], ',');
				
				// 2. 将 空格 重复 num-1次
					$nbsp = str_repeat('-', ($num-1)*5  );

				// 3. 将 空格 放回 分类列表中
					$cateList[$k]['nbsp'] = $nbsp; 
			}

			include './View/goods/add-goods.html';
		}

		public function doAdd()
		{
			$res = $this->goods->doAdd();
			// var_dump($res); die;
			if($res){
				notice('新增成功', 'index.php?c=goods');
			}
			
			notice('新增失败');
		}
		// 删除商品
		public function Delgoods()
		{
			$res = $this->goods->doDelgoods();
			if($res){
				notice('删除成功', 'index.php?c=goods');
			}
			
			notice('删除失败');
		}

		// 编辑商品
		public function Editgoods()
		{
			$cate = new categoryController;
			$cateList = $cate->cateList();

			foreach ($cateList as $k => $v) {
				// 1. 统计逗号
					$num = substr_count($v['path'], ',');
				
				// 2. 将 空格 重复 num-1次
					$nbsp = str_repeat('-', ($num-1)*5  );

				// 3. 将 空格 放回 分类列表中
					$cateList[$k]['nbsp'] = $nbsp; 
			}


			// 根据id 查询相关信息
			$res = $this->goods->getFind();
			// var_dump($res); die;
			include './View/goods/edit-goods.html';

		}

		// 商品上下架切换
		public function goodsUp()
		{
			$res = $this->goods->goodsUp();

			if($res){
				notice('更改成功', 'index.php?c=goods');
			}
			notice('更改失败');
			
		}


		public function doEdit()
		{
			$res = $this->goods->doEdit();
			// var_dump($res); die;
			if($res){
				notice('编辑成功', 'index.php?c=goods');
			}
			notice('编辑失败');
		}

		// 添加商品图片
		public function goodsimg()
		{
			$res = $this->goods->imglist();
			include './View/goods/img-goods.html';
		}

		public function addimg()
		{
			$gid = $_GET['id'];
			include './View/goods/add-img.html';
		}

		public function doAddimg()
		{
			$res = $this->goods->doAddimg();
			if($res){
				notice('添加图片成功', 'index.php?c=goods');
			}
			notice('添加失败');
		}

		// 删除一张商品图片
		public function doDelimg()
		{
			// echo 111 ; die;
			$res = $this->goods->doDelimg();
			if ( $res ) {
				notice('删除成功');
			}
			// var_dump($res); die;
			notice('删除失败');
		}

		// 设置封面图
		public function doisFace()
		{
			$res = $this->goods->doisFace();
			
			if ( $res ){
				notice('封面提交成功');
			}else{
				notice('封面提交失败');
			}
		}


		
	}



