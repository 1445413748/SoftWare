<?php 


	class loginController
	{

		public function __construct()
		{
			
			$this->login = new loginModel;
		}

		// 加载登录页
		public function index()
		{
			include './View/login/login.html';
		}
	
		public function dologin()
		{
			$this->login->dologin();
		}
		// 退出
		public function lgout()
		{
			$res = $this->login->lgout();
			
			notice ('退出成功','index.php');
		
		}

		// 加载注册页面
		public function register()
		{
			include './View/login/register.html';
		}

		// 注册用户
		public function doregister()
		{

			$res = $this->login->doregister();

			if ($res) {
				notice('注册成功','index.php?c=login');
			}else{
				notice('注册失败','index.php?c=login&m=register');
			}
		}
	}













