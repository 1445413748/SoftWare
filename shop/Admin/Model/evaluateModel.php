<?php 


	class evaluateModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		public function getAll($where = null, $limit = null)
		{

			if ( !empty($where)){
				$where =$where. ' and ';
			}

			$res = $this->db
						->field('u.`name`,`tel`,u.`id`,a.`id`,a.`orderid`,a.`userid`,a.`goodsid`,`score`,`content`,`show`,o.`ordernum`,o.`userid`,o.`orderid`,g.`id`,a.`id`')
						->table('`appraises` a,`user` u,`orders` o,`goods` g')
						->where($where.' u.`id`= a.`userid` and u.`id` = o.`userid` and a.`goodsid`=g.`id` and a.`orderid`= o.`orderid`')
						->order('a.`id` desc')
						->limit($limit)
						->select();
			return $res;
						
		}
		public function count($where=null)
		{	
			
			if ( !empty($where)){
				$where = $where.' and ';
			}

			$count = $this->db
						  ->field(' count(a.`id`) as total ')
						  ->table('`appraises` as a,`orders` as o,`user` as u')
						  ->where($where.'u.`id`=a.`userid` and u.`id` = o.`userid` and a.`orderid`=o.`orderid` ')
						  ->select();
			return $count[0]['total'];

		}

		public function isShow()
		{
				$id = $_GET['id'];
			
				$data = $this->db
							->field('`show`')
							->table('`appraises`')
							->where(' `id` = '.$id)
							->find();
				$data['show'] = $data['show'] == 1?2:1;

				$res = $this->db
							->table('appraises')
							->where('id = '.$id)
							->update($data);
		}

		public function delEva()
		{
			$id = $_GET['id'];

			$del = $this->db
						->field('`id`')
						->table('`appraises`')
						->where('id='.$id)
						->delete(); 
			return $del;
		}

		public function findEva()
		{
			$id = $_GET['id']; 
			$res = $this->db
						->field('`goodsid`,`score`,`content`,`createtime`,`name`,g.`id`,a.`id`,`reply`,`replytime`')
						->table('appraises a,goods g')
						->where('a.`id`='.$id. ' and `goodsid`=g.`id`')
						->find();
			return $res;
		}

		public function doEdit()
		{
			$data = $_POST;
			$data['replytime'] = date('Y-m-d H:i:s');
			$id = $data['id'];
			
			$res = $this->db
						->field('`id`,`score`,`content`')
						->table('appraises')
						->where('id='.$id)
						->update($data);
			return $res;
		}
	}














