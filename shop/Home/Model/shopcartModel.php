<?php 


	class shopcartModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		public function getdata()
		{
			$id = $_GET['id'];
			$goods = $this->db
							->field('g.`id`,`name`, `price`, `icon`')
							->table(' goods as g, goodsimg as i')
							->where('g.id = i.gid and face = 1 and g.id = '.$id)
							->find();


			if($goods){
					$goods['count'] = $_GET['count'];

					$_SESSION['cart'][$id] = $goods; 
				}else{
					notice('添加购物车失败');
				}
		}
	}













