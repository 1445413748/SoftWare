<?php 

	class loginController
	{
		protected $login;

		public function __construct()
		{
			
			$this->login = new loginModel;
		}

		// 加载登陆页面
		public function index()
		{
			include './View/login/login.html';
		}

		public function doLogin()

		{
			$this->login->doLogin();			
		}

		public function doCookie()
		{
			$this->login->doCookie();	
		}

		// 删除session,退出登录
		public function logout()
		{
			$this->login->logout();
		}

	}


