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
		$data = $_POST;

		@$code = $_SESSION['code'];
		unset($_SESSION['code']);
		if(  strtolower($code) != strtolower($data['code'])  ){

			notice('验证码不正确');
		}

		$data['password'] = md5($data['password']);

		$res = $this->db
			->field('`id`,`userid`')
			->table('`admin`')
			->where('userid = "' . $data['userid'] . '" and password = "' . $data['password'] . '"')
			->find();

		$user_exist = $this->db
			->field('`userid`')
			->table('`admin`')
			->where('userid = "' . $data['userid'] . '"')
			->find();

		$admin_status = $this->db
			->field('`status`')
			->table('`admin`')
			->where('userid = "' . $data['userid'] . '"')
			->select();

		
		

		if ($user_exist) {
			$admin_status = $admin_status[0]['status'];
			if ($admin_status == 0) {
				notice('账号已被锁定，暂时无法登录', 'index.php?c=login');
			} else {
				if ($res) {
					if (!empty($data['status'])) {
						setcookie('userid',  $data['userid'],  time() + 7 * 24 * 3600);
						setcookie('password',  $data['password'],  time() + 7 * 24 * 3600);
					}
					$_SESSION['ErrNum_' . $data['userid']] = 0;
					$_SESSION['admin']['id'] = $res['id'];
					$_SESSION['admin']['userid'] = $res['userid'];
					notice('登录成功,正在跳转中。。。', 'index.php');
				} else {
					if (!isset($_SESSION['ErrNum_' . $data['userid']]))
						$_SESSION['ErrNum_' . $data['userid']] = 0;
					$_SESSION['ErrNum_' . $data['userid']]++;
					if ($_SESSION['ErrNum_' . $data['userid']] == ERROR_LIMIT) {
						$datas['status'] = 0;
						$user_exist = $this->db
							->field('`status`')
							->table('`admin`')
							->where('userid = "' . $data['userid'] . '"')
							->update($datas);
						notice('错误超过三次，账号已被锁定', 'index.php?c=login');
					}

					notice('密码错误，请重新输入', 'index.php?c=login');
				}
			}
		} else {
			notice('账号不存在，请重新输入', 'index.php?c=login');
		}
	}

	public function doCookie()
	{
		$data = $_COOKIE;
		var_dump($data);
		$res = $this->db
			->field('`id`, `userid`')
			->table('`admin`')
			->where('`userid` ="' . $data['userid'] . '" and `password` = "' . $data['password'] . '"')
			->find();
		if ($res) {
			$_SESSION['admin']['id'] = $res['id'];
			$_SESSION['admin']['userid'] = $res['userid'];
			header('location: index.php');
			die;
		}

		header('location: index.php?c=login');
		die;
	}


	public function logout()
	{
		unset($_SESSION['admin']);

		header('location: index.php');
		die;
	}
}
