<?php 


	class userModel extends Controller
	{
		public function __construct()
		{
			parent::__construct();
			
			$this->db = new DB;
		}


		public function getData($where = null, $limit = null)
		{
			$res = $this->db
						->field('`id`,`icon`, `name`, `tel`, `email`, `status`')
						->table('`user`')
						->where($where)
					    ->order('regtime desc')
					    ->limit($limit)
						->select();
			return $res;		
		}

		public function getFind()
		{
			$id = $_GET['id'];

			$res = $this->db
						->field(' `id`, `name`,`tel`, `address`, `age`, `email`, `sex`, `status`,`icon` ')
						->table('`user`')
						->where('id = '.$id)
						->find();
			return $res;
		}

		public function count($where=null)
		{
			$count = $this->db
						  ->field(' count(id) as total ')
						  ->table('`user`')
						  ->where($where)
						  ->select();

			return $count[0]['total'];
		}

		// 增加一个新用户
		public function doAdd()
		{
			// 1. 接收数据 
				$data = $_POST;

			// 2. 验证数据
			
			// 姓名验证
				 $preg = '/^[\x{4e00}-\x{9fa5}]{2,15}$/isu';
				 if( !preg_match($preg,  $data['name']) ){
						echo '姓名格式不正确';
						echo '<meta http-equiv="refresh" content="3; url= '.$_SERVER['HTTP_REFERER'].'">'; die;
				 }

			// 年龄验证
				$preg = '/^[0-9]{3}$/';
				if( !preg_match($preg,  $data['age']) ){
					echo '年龄格式不正确';
					echo '<meta http-equiv="refresh" content="3; url= '.$_SERVER['HTTP_REFERER'].'">'; die;
				}

			// 手机验证
				$preg = '/^1(3\d|4[5-9]|5[012356789]|66|7[0345678]|8\d|9[89])\d{8}$/';
				if( !preg_match($preg,  $data['tel']) ){
					notice('手机号码格式不正确'); die;
				}

			// 邮箱验证
				$preg = '/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z0-9]{2,6}$/';
				if( !preg_match($preg,  $data['email']) ){
					echo '邮箱格式不正确';
					echo '<meta http-equiv="refresh" content="3; url= '.$_SERVER['HTTP_REFERER'].'">'; die;
				}

			// 密码
				
				$preg = '/^.{6,15}$/';
				if(  !preg_match($preg, $data['pwd'])  ){
					notice('密码长度不符合');die;
				}

			// 格式 必须含有数字, 大写字母, 小写字母 
				$a = preg_match('/\d/',$data['pwd']);
				$b = preg_match('/[A-Z]/',$data['pwd']);
				$c = preg_match('/[a-z]/',$data['pwd']);
				$d = preg_match('/^[A-Z]/',$data['pwd']);

				if(   !($a && $b && $c && $d)     ){
					notice('密码格式不正确');die;
				}


				$bool = pass($data['pwd']);
				if( $bool ){
					$data['pwd'] = MD5($data['pwd']);
				}else{
					notice('密码格式不正确');die;
				}

				$data['regtime'] = date('Y-m-d',time());
				unset($data['repwd']);

				$res = $this->db
							  ->table('`user`')
							  ->insert($data);

				return $res;
		}

		// 修用户资料
		public function doEdit()
		{
			// 1. 接收数据
				$data = $_POST;
				if (empty($data)) {
					return false;
				}
				

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

				}

			// 姓名验证
				 
				 $preg = '/^[\x{4e00}-\x{9fa5}]{2,15}$/isu';
				 if( !preg_match($preg,  $data['name']) ){
						echo '姓名格式不正确';
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


			// 密码
				
				// 判断两次密码是否输入一致
				if ( $data['pwd']!=$data['repwd'] ) {
				notice('两次密码输入不一致');die;
				}
				unset($data['repwd']);
				
				// 判断密码是否为空
				if ( empty($data['pwd'])) {
					unset($data['pwd']);
				}else{
					$preg = '/^.{6,15}$/';
					if(  !preg_match($preg, $data['pwd'])  ){
						notice('密码长度不符合');die;
					}else{
						// 格式 必须含有数字, 大写字母, 小写字母 
						$a = preg_match('/\d/',$data['pwd']);
						$b = preg_match('/[A-Z]/',$data['pwd']);
						$c = preg_match('/[a-z]/',$data['pwd']);
						$d = preg_match('/^[A-Z]/',$data['pwd']);

						if(  !($a && $b && $c && $d)     ){
							notice('密码格式不正确');die;
						}
					}

					
				}

				


				$res = $this->db
						->table('`user`')
						->where(' id = '.$data['id'])
					    ->update($data);
			
			 return $res;	
		}
		public function doDel()
		{
				$id = $_GET['id'];

			$res = $this->db
						->table('`user`')
						->where(' id = '.$id)
						->delete();

				return $res;
		}

	}


