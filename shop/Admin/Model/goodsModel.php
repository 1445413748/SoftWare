<?php 


	class goodsModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		public function getData($where = null, $limit = null)
		{
			if ( !empty($where)){
				$where = 'and '.$where;
			}
			
			$res = $this->db
						->field('goods.id, `name`, `price`, `stock`, `sold`,`up`,`hot`,`icon`,`face`,`gid`')
						->table('`goods`,`goodsimg`')
						->where('goods.id = goodsimg.gid and goodsimg.face = 1 '.$where)
					    ->order('goods.id desc')
					    ->limit($limit)
						->select();
			return $res;		
		}

		public function count($where=null)
		{	
			$count = $this->db
						  ->field(' count(id) as total ')
						  ->table('`goods`')
						  ->where($where)
						  ->select();
			return $count[0]['total'];

		}
		public function doAdd()
		{
				$data = $_POST;
				if (!($data['price']>0 & $data['stock']>0)) {
					notice('商品价格或库存格式不正确');
				}								
				$upload = new Upload;
				$file = $upload->singleFile();
				if( is_string($file) ){
					notice($file);
				}

				$data['addtime'] = date('Y-m-d');
			
				$res = $this->db
							->table('`goods`')
							->insert($data);
				$gid = $res;


				$img['gid'] = $gid;
				$img['icon'] = $file[0];
				$img['face'] = 1;
				$gimg = $this->db
							->table('`goodsimg`')
							->insert($img);

				return $gimg;
		}

		public function doDelgoods()
		{
			$id = $_GET['id'];
			$goods = $this->db
						  ->table('goods')
						  ->where('id = '.$id)
						  ->delete();

			$res = $this->db
						->table('goodsimg')
						->where('gid='.$id)
						->delete();
			return $res;
		}

		public function getFind()
		{
			$id = $_GET['id'];

			$res = $this->db
					    ->field(' `id`,`cid`, `name`, `price`, `stock`,`up`,`hot`,`desc`')
					    ->table('`goods`')
					    ->where('id='.$id)
					    ->find();

			return $res;
		}
		public function doEdit()
		{
			//  接收数据
				$id = $_POST['id'];
				$data = $_POST;
				if (!($data['price']>0 & $data['stock']>=0)) {
					notice('商品价格或库存格式不正确');
				}	
				// 准备sql 语句
				$res =  $this->db
							 ->table('`goods`')
							 ->where('id='.$id)
							 ->update($data);
				return $res;
		}

		// 商品上下架切换
		public function goodsUp()
		{
			$id=$_GET['id'];

			// 2. 根据 id 查询 
				$data = $this->db
							->field('`up`')
							->table('`goods`')
							->where(' `id` = '.$id)
							->find();
			// 3. 修改状态
				$data['up'] = $data['up'] == 1?2:1;

				$res = $this->db
							->table('goods')
							->where('id = '.$id)
							->update($data);
				return $res;
		}


		public function imglist()
		{
			$gid = $_GET['id'];

			$res = $this->db
						->field('icon,gid,id,face')
						->table('`goodsimg`')
						->where('gid='.$gid)
						->select();
			return $res;
		}

		public function doAddimg()
		{
			// 接收数据
			$data = $_POST;

			// 验证数据
			$upload = new Upload;
			$res = $upload->is_upload();
			if($res){
				$file = $upload->singleFile();
				if( is_string($file) ){
					notice($file);
				}else{
					$data['icon'] = $file[0];
				}
			}

			$res = $this->db
						->table('goodsimg')
						->insert($data);
			return $res;
		}

		// 删除一张商品图片
		public function doDelimg()
		{
			// 接收数据
			$id = $_GET['id'];

			$res = $this->db
						->table('goodsimg')
						->where(' id = '.$id.' and face != 1')
						->delete();
			return $res;
		}

		// 商品图片是否设置为封面
		public function doisFace()
		{
			$id = $_GET['id'];
			$gid = $_GET['gid'];

			$face['face'] = 2;

			$res = $this->db
						->table('`goodsimg`')
						->where('gid = '.$gid)
						->update($face);
			

			$face['face'] = 1;
						
			$face = $this->db
		   	 			 ->table('`goodsimg`')
		   	 			 ->where('id = '.$id)
		   	 		     ->update($face);

			return $res;

		}


	}











