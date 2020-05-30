<?php 


	class cateModel
	{
		public function __construct()
		{
			$this->db = new DB; 
		}

		public function categoods($limit)
		{
			$cid = $_GET['id'];


			$res = $this->db
						->field('goods.id,`cid`,`name`, `price`, `stock`, `sold`,`up`,`hot`,`icon`,`face`,`gid`')
						->table('goods,goodsimg')
						->where('goods.id=goodsimg.gid and goods.cid='.$cid. ' and face=1 and up = 1')
						->limit($limit)
						->select();
			return $res;
		}

		public function count($where=null)
		{
			$cid = $_GET['id'];
			
			if (!empty($where)) {
				$where= ' and '.$where;
			}
			$count = $this->db
						  ->field(' count(id) as total ')
						  ->table('`goods`')
						  ->where(' up=1 and cid='.$cid.$where)
						  ->select();
			return $count[0]['total'];

		}
	}















