<?php


	class indexModel
	{

		public function __construct()
		{
			$this->db = new DB;

		}

		// 统计用户人数
		public function usersum()
		{
			$count = $this->db
						  ->field(' count(id) as total ')
						  ->table('`user`')
						  ->select();
			return $count[0]['total'];
		}

		// 统计交易金额
		public function amount()
		{
			$amount = $this->db
						   ->field('`totalprice`')
						   ->table('`orders`')
						   ->select();
			$sum='';
			foreach ($amount as $k => $v) {
				if (empty($v['totalprice'])) {

					continue;
				}

				$sum += $v['totalprice'];
			}

			if (empty($sum)) {
					return false;
				}
			return $sum;
		}

		// 统计订单数量
		public function orderQuantity()
		{
			$quantity = $this->db
						  ->field(' count(orderid) as sum ')
						  ->table('`orders`')
						  ->select();
			return $quantity[0]['sum'];

		}

		// 统计商品数量
		public function goodsSum()
		{
			$goods = $this->db
						  ->field('count(id) as sum')
						  ->table('`goods`')
						  ->select();
			return $goods[0]['sum'];
		}

		// 统计评论数量
		public function evaSum()
		{
			$eva = $this->db
						->field('count(id) as sum')
						->table('appraises')
						->select();
			return $eva[0]['sum'];
		}
	}











