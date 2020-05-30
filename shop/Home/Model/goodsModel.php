<?php 


	class goodsModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		// 商品详情信息
		public function details()
		{
			$id = $_GET['id'];
			
			$res = $this->db
						->field('goods.id,`name`, `price`, `stock`, `sold`,`icon`,`face`,`gid`')
						->table('goods,goodsimg')
						->where('goods.id=goodsimg.gid and face=1 and goods.id='.$id)
						->find();
			
			return $res;
		}
		// 商品详情图
		public function imgslist()
		{
			$id = $_GET['id'];
			$imgs = $this->db
						 ->field('icon')
						 ->table('goodsimg')
						 ->where('gid='.$id)
						 ->select();
			return $imgs;
		}
		public function evaluate()
		{
			$id = $_GET['id'];

			$eva = $this->db
						->field('`goodsid`,`content`,`createtime`,`reply`,`replytime`,`userid`,u.`id`,u.`name`')
						->table('appraises a,user u')
						->where('goodsid='.$id. ' and `userid`=u.`id`')
						->select();
			
			return $eva;
		}

	}













