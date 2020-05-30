<?php 

	class mycenterModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		// 查询用户信息
		public function userdata()
		{
			// 拿到session 下存放的id
			$id = $_SESSION['user']['id'];

			// 根据id查询用户信息
			$res = $this->db
						->field('`id`,`name`,`sex`,`email`,`tel`,`age`,`address`,`icon`')
						->table('`user`')
						->where('id='.$id)
						->find();
			// var_dump($res); die;
			
			return $res;
			
		}

		// 用户上传头像
		public function upicon()
		{
			$data = $_POST;
			// var_dump($data); die;

			// 头像
			$upload = new Upload;

			$img = $upload->is_upload();

			if($img){
				$file = $upload->singleFile();
				if( is_string($file) ){
					notice($file);
				}else{
						$data['icon'] = $file[0];
					}
			}else{
				notice('请重新选择文件');
			}
			// var_dump($img); die;
			$res = $this->db
						->table('`user`')
						->where(' id = '.$data['id'])
					    ->update($data);
			// var_dump($res) ; die;
			return $res;

		}


		// 执行修改用户信息
		public function doupdata()
		{
			$data = $_POST;
			// var_dump($data); die;
			
			// *. 验证数据
			// 姓名验证
			 $preg = '/^[\x{4e00}-\x{9fa5}]{2,15}$/isu';
			 if( !preg_match($preg,  $data['name']) ){
					echo '姓名格式不正确,请输入2-15中文汉字';
					echo '<meta http-equiv="refresh" content="3; url= '.$_SERVER['HTTP_REFERER'].'">'; die;
				}
			// 年龄验证
			$preg = '/^[0-9]{1,3}$/';
			if( !preg_match($preg,  $data['age']) ){
				echo '年龄格式不正确';
				echo '<meta http-equiv="refresh" content="3; url= '.$_SERVER['HTTP_REFERER'].'">'; die;
			}

			// 	电话验证
			$preg = '/^1(3\d|4[5-9]|5[012356789]|66|7[0345678]|8\d|9[89])\d{8}$/';
			if( !preg_match($preg,  $data['tel']) ){
				echo '手机号码格式不正确';
				echo '<meta http-equiv="refresh" content="3; url= '.$_SERVER['HTTP_REFERER'].'">'; die;
			}


			// 邮箱验证
			$preg = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/';
			if( !preg_match($preg,  $data['email']) ){
				echo '邮箱格式不正确';
				echo '<meta http-equiv="refresh" content="3; url= '.$_SERVER['HTTP_REFERER'].'">'; die;
			}

			$res = $this->db
						->table('user')
						->where(' id= '.$data['id'])
						->update($data);
			// var_dump($this->db->sql); die;
			return $res;
		}

		// 修改密码
		public function uppwd()
		{
			$data = $_POST;
			// var_dump($data); die;
			
			// 验证数据...
			// 接收原密码数据加密
			$data['password'] = md5($data['password']);
			// 判断与数据库密码是否一致
			$res = $this->db
				 		->field('`id`,`pwd`')
				 		->table('user')
				 		->where('id='.$data['id'])
				 		->find();
			if ($data['password']==$res['pwd']) {
				unset($data['password']);
			}else{
				notice('原密码输入不正确');
			}

			$preg = '/^.{6,15}$/';
			if(  !preg_match($preg, $data['pwd'])  ){
				notice('密码长度不符合');die;
			}

			// 格式 必须含有数字, 大写字母, 小写字母, 必须以大写开头 
			$a = preg_match('/\d/',$data['pwd']);
			$b = preg_match('/[A-Z]/',$data['pwd']);
			$c = preg_match('/[a-z]/',$data['pwd']);
			$d = preg_match('/^[A-Z]/',$data['pwd']);

			if(   !($a && $b && $c && $d)     ){
				notice('密码格式不正确');die;
			}

			// 判断两次密码是否输入一致
			if ( $data['pwd']!=$data['repwd'] ) {
				notice('两次密码输入不一致');
			}

			unset($data['repwd']);

			$data['pwd'] = md5($data['pwd']);

			// 更新数据库密码
			$pwd = $this->db
						->table('`user`')
						->where('id='.$data['id'])
						->update($data);

			// var_dump($this->db->sql); die;

			return $pwd;

		}

		// 查询用户收货地址信息
		public function getaddress()
		{
			// 拿到session 下存放的id
			@$id = $_SESSION['user']['id'];

			// var_dump($id); die;
			// 根据id查询用户收货地址信息
			$res = $this->db
						->field('`userid`,`addressid`,`username`,`usertel`,`zipcode`,`useraddress`,`isdefault`')
						->table('`useraddress`')
						->where('userid='.$id)
						->select();
			// var_dump($res); die;
			
			return $res;
			
		}
		
		// 新增用户收货地址
		public function doaddress()
		{
			// 接收数据
			$data = $_POST;
			// var_dump($data); 
			// 拿到session 下存放的id
			$id = $data['userid'];

			// 姓名验证
			 $preg = '/^[\x{4e00}-\x{9fa5}]{2,15}$/isu';
			 if( !preg_match($preg,  $data['username']) ){
					notice('姓名格式不正确');die;
			}

			//手机号验证
			$preg = '/^1   (3\d|4[67]|5\d|66|7[3729510]|8\d|9[89])  \d{8}$/x';
			if( !preg_match($preg, $_POST['usertel'] ) ){
				notice('您的手机号码格式不正确');die;
			}

			// 邮编验证
			if ( empty($_POST['zipcode']) ) {
				unset( $_POST['zipcode']);
			}else{
				$preg = '/^[0-9]{6}$/x';
				if( !preg_match($preg, $_POST['zipcode'] ) ){
					notice('邮编格式不正确');die;
				}
			}

			$res = $this->db
						->table('`useraddress`')
						->where('userid='.$id)
						->insert($data);
			// var_dump($this->db->sql); die;			
			return $res;
		}

		// 删除用户收货地址
		public function deladdress()
		{
			$id = $_GET['addressid'];

			$res = $this->db
						->table('`useraddress`')
						->where('addressid='.$id)
						->delete();

			return $res;
		}

		// 根据地址id 查询一条地址信息
		public function findaddress()
		{
			$id = $_GET['addressid'];

			$res = $this->db
						->field('`username`,`usertel`,`zipcode`,`useraddress`,`addressid`')
						->table('useraddress')
						->where('addressid='.$id)
						->find();
			// var_dump($res); die;
			return $res;
		}

		// 编辑用户收货地址
		public function doeditaddress()
		{
			$data = $_POST;
			$id = $_POST['addressid'];
			// var_dump($data); die;
			
			// 姓名验证
			 $preg = '/^[\x{4e00}-\x{9fa5}]{2,15}$/isu';
			 if( !preg_match($preg,  $data['username']) ){
					notice('姓名格式不正确');die;
			}

			//手机号验证
			$preg = '/^1   (3\d|4[67]|5\d|66|7[3729510]|8\d|9[89])  \d{8}$/x';
			if( !preg_match($preg, $_POST['usertel'] ) ){
				notice('您的手机号码格式不正确');die;
			}

			// 邮编验证
			if ( empty($_POST['zipcode']) ) {
				unset( $_POST['zipcode']);
			}else{
				$preg = '/^[0-9]{6}$/';
				if( !preg_match($preg, $_POST['zipcode'] ) ){
					notice('邮编格式不正确');die;
				}
			}

			$res = $this->db
						->table('useraddress')
						->where('addressid='.$id)
						->update($data);
			return $res;
		}

		// 设置默认用户地址
		public function isdefault()
		{
			$aid = $_GET['addressid']; 
			$uid = $_GET['userid'];

			$isdefault['isdefault'] = 2;
			$sex = $this->db
						->table('`useraddress`')
						->where('userid = '.$uid)
						->update($isdefault); 

			$isdefault['isdefault'] = 1;

			$res = $this->db
						->table('useraddress')
						->where('addressid='.$aid )
						->update($isdefault);

			// var_dump($res); die;
			return $res;
		}


	}
















