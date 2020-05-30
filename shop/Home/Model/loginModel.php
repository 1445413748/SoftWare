<?php 


	class loginModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		// 登陆
		public function doLogin()
		{
			// 1. 接收数据
				$data = $_POST;
				$tel = $_POST['tel'];
	 			$pwd = $_POST['pwd'];
	 			$code = $_POST['code'];

			// 2. 验证数据
				if ( empty( $_POST['tel'] ) ) {
					notice('数据不能为空');die;
				}

				//手机号验证
				$preg = '/^1   (3\d|4[67]|5\d|66|7[3729510]|8\d|9[89])  \d{8}$/x';
				if( !preg_match($preg, $tel ) ){
					notice('您的手机号码格式不正确');die;
				}
				// 判断验证码
				$code = $_SESSION['code'];
				unset($_SESSION['code']);
				if(  strtolower($code) != strtolower($data['code'])  ){
					
					notice('验证码不正确');
				}

				$data['pwd'] = md5($data['pwd']);

				$res = $this->db
							->field('`id`,`tel`,`name`,`pwd`,`status`')
							->table('`user`')
							->where(' tel = "'.$data['tel'].'" and pwd = "'.$data['pwd'].'"')
							->find();
				if ($res['status']==2) {
					notice('您的账号已被禁用');die;
				}

			// 4. 查询成功
				if( $res ){

					$_SESSION['user']['tel'] = $res['tel'];		
					$_SESSION['user']['id'] = $res['id'];
					notice('登录成功', 'index.php');
				}else{

					notice('你的账号或密码有误', 'index.php?c=login');
				}
		}


		public function lgout()
		{
			unset($_SESSION['user']);
		}

		// 注册用户
		public function doregister()
		{
			$data = $_POST;
			if ( empty( $data['tel'] & $data['pwd'] ) ) {
				notice('数据不能为空');die;
			}
		// 手机号是否已经注册验证
			$tel = $this->db
						 ->field('tel')
						 ->table('user')
						 ->where('tel='.$data['tel'])
						 ->find();
			if (!empty($tel)) {
				notice('该手机号已经注册');die;
			}

			$preg = '/^1(3\d|4[5-9]|5[012356789]|66|7[0345678]|8\d|9[89])\d{8}$/';
			if( !preg_match($preg,  $data['tel']) ){
				notice('手机号码格式不正确'); die;
			}
			// 密码长度判断
			$pwd = $data['pwd'];
			$repwd = $_POST['repwd'];
			$preg = '/^.{6,15}$/';
			if(  !preg_match($preg, $pwd)  ){
				notice('密码长度不符合');die;
			}

			// 格式 必须含有数字, 大写字母, 小写字母 
				$a = preg_match('/\d/',$pwd);
				$b = preg_match('/[A-Z]/',$pwd);
				$c = preg_match('/[a-z]/',$pwd);

				if(   !($a && $b && $c )     ){
					notice('密码格式不正确');die;
				}

				if( $pwd !== $repwd ){
					notice('两次密码输入不一致');die;
				}

			if( $data['pwd'] ){
				$data['pwd'] = MD5($data['pwd']);
			}else{
				notice('密码格式不正确');
			}

			$data['regtime'] = date('Y-m-d',time());
			unset($data['repwd']);
			unset($data['code']);

			$res = $this->db
						  ->table('`user`')
						  ->insert($data);
			return $res;
		}
	}











