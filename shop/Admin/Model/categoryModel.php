<?php 


	class categoryModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		public function getData()
		{
			$pid = empty($_GET['id'])? 0 :$_GET['id'];

			$res = $this->db
					   ->field('`id`,`name`,`pid`,`path`,`display`')
					   ->table('`category`')
					   ->where('pid = '.$pid)
					   ->select();
			return $res;
		}

		public function getFind()
		{
				$id = $_GET['id'];

				$res = $this->db
							->field(' `id`, `name`,`pid`, `path`, `display`')
							->table(' `category` ')
							->where(' id = '.$id)
							->find();

				return $res;
		}

		public function count()
		{	

			$count = $this->db
						  ->field(' count(id) as total ')
						  ->table('`category`')
						  ->select();

			return $count[0]['total'];

		}

		public function doDel()
		{
				$id = $_GET['id'];

				$find = $this->db
							 ->field('`id`')
							 ->table('`category`')
							 ->where('`pid` ='.$id)
							 ->find();

				if(!$find){
						$res = $this->db
									->table('`category`')
									->where('id = '.$id)
									->delete();
				}else{
					notice('当前分类还有商品, 请先删除商品', 'index.php?c=category');
				}

		}

		public function doAdd()
		{
				$data = $_POST;


				$res = $this->db
							->table('`category`')
							->insert($data);
				return $res;
		}

		public function doEdit()
		{
				$data = $_POST;

				$res = $this->db
							->table('`category`')
							->where('id = '.$data['id'])
							->update($data);
				return $res;
		}
		public function display()
		{
				$id = $_GET['id'];
			
				$data = $this->db
							->field('`display`')
							->table('`category`')
							->where(' `id` = '.$id)
							->find();

				$data['display'] = $data['display'] == 1?2:1;

				$res = $this->db
							->table('category')
							->where('id = '.$id)
							->update($data);

		}

		public function getCateList()
		{
			
			$res = $this->db
						->field('`id`, `name`, `path`')
						->table('`category`')
						->order('concat(`path`, `id`)')
						->select();
			return $res;


		}
		
	}












