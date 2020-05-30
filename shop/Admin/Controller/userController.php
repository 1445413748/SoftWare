<?php 
	class userController extends Controller
	{ 

		public function __construct()
		{
			parent::__construct();

			$this->user = new userModel;
		}

		public function index()
		{
			$where = null;
			if( !empty($_GET['search']) ){
				$s = $_GET['search'];
				$where = 'tel like "%'.$s.'%" or  name like "%'.$s.'%"';
			}
			$page = new Page;
			$count = $this->user->count($where);
			$limit = $page->limit($count);

			$res = $this->user->getData($where,$limit);
			include './View/user/index.html';
		}
		// 添加用户
		public function add()
		{
			include './View/user/add.html';			
		}

		public function doAdd()
		{
			$res = $this->user->doAdd();

			if($res){
				notice('新增成功', 'index.php?c=user');
			}else{
				notice('新增失败');
			}

		}

		

		// 编辑用户
		public function edit()
		{
			$res = $this->user->getFind();

			include './View/user/edit.html';
		}


		// 用户详情
		public function details()
		{
			$res = $this->user->getFind();

			include './View/user/details.html';
		}

		public function doEdit()
		{
			$res = $this->user->doEdit();
              

			if( $res ){
				notice('更新成功', 'index.php?c=user');
			}else{
				notice('更新失败');
			}

		}


		public function doDel()
		{
			$this->user->doDel();

			// 跳转页面
				header('location:  index.php?c=user'); die; 
		}


		
	}
