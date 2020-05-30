<?php 

	class indexModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		public function goodslist($limit)
		{
			$res= $this->db
				 	   ->field('goods.id, `name`, `price`, `stock`, `sold`,`up`,`hot`,`icon`,`face`,`gid`')
				 	   ->table('goods,goodsimg')
				 	   ->where('goods.id=goodsimg.gid and face=1')
				 	   ->limit($limit)
				 	   ->select();
			return $res;
		}
	}
















