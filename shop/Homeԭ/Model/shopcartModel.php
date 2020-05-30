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
			// var_dump($data); die;
			$goods = $this->db
							->field('g.`id`,`name`, `price`, `icon`')
							->table(' goods as g, goodsimg as i')
							->where('g.id = i.gid and face = 1 and g.id = '.$id)
							->find();

			// var_dump($goods); die;

			if($goods){
					// 查询成功
					$goods['count'] = $_GET['count'];

					// 	存session
					$_SESSION['cart'][$id] = $goods; 
				}else{
					// 查询失败
					//  提示并跳转
					notice('添加购物车失败');
				}
		}
	}













