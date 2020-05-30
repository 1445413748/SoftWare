<?php 

	class mycenterController extends Controller
	{
		public function __construct()
	 	{
	 		parent:: __construct();
	 		$this->mycenter = new mycenterModel;
	 	}

		// 加载个人中心页面
		public function index()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			$res = $this->mycenter->userdata();
			include './View/user/mycenter.html';
		}

		// 修改上传头像
		public function upicon()
		{
			$res = $this->mycenter->upicon();
			// var_dump($res);die;
			
			if($res){
					notice('头像上传成功', 'index.php?c=mycenter');
				}else{
					notice('头像上传失败,请稍后再试...');
				}
		}


		// 加载修改信息页面
		public function updata()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			$res = $this->mycenter->userdata();
			include './View/user/update.html';
		}

		// 执行修改信息
		public function doupdata()
		{
			$res = $this->mycenter->doupdata();

			if($res){
					notice('资料修改成功', 'index.php?c=mycenter');
				}else{
					notice('资料修改失败,请稍后再试...');
				}
		}

		// 加载更改密码页面
		public function pwd()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			$res = $this->mycenter->userdata();
			include './View/user/pwd.html';
		}

		// 修改密码
		public function uppwd()
		{
			$pwd= $this->mycenter->uppwd();

			if ($pwd) {
				notice('密码修改成功','index.php?c=mycenter');
			}else{
				notice('密码修改失败,请稍后再试...','index.php?c=mycenter&m=pwd');
			}
		}


		// 加载收货地址页面
		public function useraddress()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			$res = $this->mycenter->getaddress();
			include './View/user/useraddress.html';
		}

		// 加载增加收货地址页面
		public function useradd()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			include './View/user/useradd.html';
		}

		// 增加用户收货地址
		public function doaddress()
		{
			$res = $this->mycenter->doaddress();

			// var_dump($res); die;
			if ($res) {
				notice('新增地址成功','index.php?c=mycenter&m=useraddress');
			}else{
				notice('新增失败,请稍后再试...','index.php?c=mycenter&m=useradd');
			}
		}

		// 加载编辑收货地址界面
		public function editaddress()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			$res = $this->mycenter->findaddress();
			// var_dump($res); die;
			include './View/user/editaddress.html';
		}

		// 提交编辑收货地址界面
		public function doeditaddress()
		{
			$res = $this->mycenter->doeditaddress();
			
			if ($res) {
				notice('更新收货信息成功','index.php?c=mycenter&m=useraddress');
			}else{
				notice('更新收货信息失败,请稍后再试...','index.php?c=mycenter&m=useraddress');
			}
		}

		// 设为默认收货地址
		public function isdefault()
		{
			$res = $this->mycenter->isdefault();

			if ( $res ){
				notice('默认地址提交成功');
			}else{
				notice('提交失败');
			}
		}

		// 删除用户收货地址
		public function deladdress()
		{
			$this->mycenter->deladdress();

			header('location:index.php?c=mycenter&m=useraddress');die;
		}

		

		

	}













