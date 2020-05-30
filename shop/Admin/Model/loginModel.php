<?php 
	
	class loginModel
	{
		protected $db;
		public function __construct()
		{
			$this->db = new DB;
		}

		public function doLogin()
		{
			// 1. 接收数据
				$data = $_POST;

			// 2. 验证数据
				@$code = $_SESSION['code'];
				unset($_SESSION['code']);
				if(  strtolower($code) != strtolower($data['code'])  ){
					
					notice('验证码不正确');
				}

				$data['password'] = md5($data['password']);

			// 3. 准备并执行sql
				$res = $this->db
							->field('`id`,`userid`')
							->table('`admin`')
							->where('userid = "'.$data['userid'].'" and password = "'.$data['password'].'"')
							->find();
				


			// 4. 查询成功
				if( $res ){
					if( !empty($data['status']) ){
						setcookie('userid',  $data['userid'],  time()+7*24*3600);
						setcookie('password',  $data['password'],  time()+7*24*3600);
					}

					$_SESSION['admin']['id'] = $res['id'];		
					$_SESSION['admin']['userid'] = $res['userid'];			
					notice('登录成功', 'index.php');
				}else{

					//    查询失败
					//  返回登录页
					notice('密码错误,登录失败', 'index.php?c=login');
				}
		}

		public function doCookie()
		{
				$data = $_COOKIE;
				var_dump($data); 
				$res = $this->db
							->field('`id`, `userid`')
							->table('`admin`')
							->where('`userid` ="'.$data['userid'].'" and `password` = "'.$data['password'].'"')
							->find();
			if( $res ){
				$_SESSION['admin']['id'] = $res['id'];		
				$_SESSION['admin']['userid'] = $res['userid'];		
				header('location: index.php'); die;	
			}

			// 查询失败	
				//  跳转到 登录页
				header('location: index.php?c=login'); die;
		}


		public function logout()
		{
			unset($_SESSION['admin']);
	
			header('location: index.php');die;
		}


	}

