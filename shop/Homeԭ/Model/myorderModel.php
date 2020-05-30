<?php 

	class myorderModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		// 为下订单页面查询默认地址
		public function findaddress()
		{
			// 拿到session 下存放的id
			@$id = $_SESSION['user']['id'];

			// var_dump($id); die;
			// 根据id查询用户收货地址信息
			$res = $this->db
						->field('`userid`,`addressid`,`username`,`usertel`,`zipcode`,`useraddress`,`isdefault`')
						->table('`useraddress`')
						->where('userid='.$id. ' and isdefault=1')
						->find();
			// var_dump($res); die;
			
			return $res;			
		}

		// 下订单页面新增地址
		// 新增用户收货地址
		public function doaddress()
		{
			// 接收数据
			$data = $_POST;
			// var_dump($data); die;
			$id = $data['userid'];
			$data['isdefault']=1;
			$res = $this->db
						->table('`useraddress`')
						->where('userid='.$id)
						->insert($data);

			// var_dump($this->db->sql); die;		
			return $res;
		}

		// 下单
		public function dorder()
		{
			
			$data = $_POST;

			

 			// var_dump($this->db->sql);die;
			$cart = $_SESSION['cart'];
			// var_dump($cart); die;
			
			foreach ($cart as $k => $v) {

				$kucun = $this->db
							  ->field('`stock`')
							  ->table('goods')
							  ->where('id='.$v['id'])
							  ->find();
				if ($v['count'] > $kucun['stock']) {
					notice('库存不足');
				}
				
				// $data = $_POST;
				// var_dump($data);

				$data['totalprice'] = $v['price'] * $v['count'];
				
				$data['ordernum'] =  time().rand(111111,999999);
				$data['ordertime'] = date("Y-m-d h:i:s");
				$data['orderstatus'] = 2;

				// var_dump($data);die;
	 			$newID = $this->db
	 						  ->table('`orders`')
	 						  ->insert($data);


				// var_dump($v);
				$goods = null;
				$goods['orderid'] = $newID;
				$goods['goodsid'] = $v['id'];
				$goods['goodsname'] = $v['name'];
				$goods['cartnum'] = $v['count'];
				$goods['price'] = $v['price'];
				
				$res = $this->db
							->table('`ordergoods`')
							->insert($goods);

				// jiankucun

		 		$goodsid = $goods['goodsid'];

				$goodsstock  = $this->db
								   ->field('`id`,`stock`,`sold`')
								   ->table('`goods`')
								   ->where('id='.$goodsid)
								   ->find();

				$stockgoods	= [];		   
				$stockgoods['stock'] = $goodsstock['stock'] - $goods['cartnum'];

				$stockgoods['sold'] = $goodsstock['sold'] + $goods['cartnum'];

				$stock = $this->db
							  ->field('`stock`,`sold`')
							  ->table('`goods`')
							  ->where(' id = '.$goodsid )
							  ->update($stockgoods);
		 		
			}

		
			unset($_SESSION['cart']);

			// die;
			return $newID;

		}


		public function getALL()
		{
			// var_dump($_SESSION); die;
			$userid = $_SESSION['user']['id'];

			$res = $this->db
						->field(' o.userid, og.orderid, o.orderid,`ordernum`,`ordertime`,`orderispay`,`orderisappraise`,`orderstatus`,`totalprice`,og.price,og.cartnum,g.name,`icon`,`face`,og.goodsid')
						->table('`orders` o,`ordergoods` og,`goods` g,`goodsimg` gi')
						->where(' og.orderid = o.orderid and og.goodsid = g.id and  g.id = gi.gid and gi.face = 1 and o.userid='.$userid)
						->select();
			return $res;

			// var_dump($this->db->sql);die;
			// var_dump($res); die;
		}

		// public function getOrdernum()
		// {
		// 	$ordernum = $this->db
		// 					->field('ordernum')
		// 					->table('`orders`')
		// 					->select();
		// 	// var_dump($this->db->sql);die;

		// 	return $ordernum;
		// }

		// 确认收货
		public function affirm()
		{
			$data = $_GET;
			// var_dump($data);die;
			unset($data['c']);
			unset($data['m']);
			$id = $data['id'];
			unset($data['id']);
			$data['orderstatus'] = 3;
			// var_dump($data); die;
			$res = $this->db
						 ->table('`orders`')
						 ->where('orderid='.$id)
						 ->update($data);
			return $res;

		}

		// 提交评价
		public function doevaluate()
		{
			$data = $_POST;
			$id = $data['orderid'];
			$data['createtime'] = date('Y-m-d H:i:s');
			// var_dump($data); die;
			// 提交评论
			$res = $this->db
						->table('appraises')
						->insert($data);
			// var_dump($this->db->sql);die;
			// 更改订单评论状态

			$order['orderstatus'] = 4;
			// var_dump($order);die;

			$st = $this->db
						   ->field('`orderid`')
						   ->table('orders')
						   ->where('orderid='.$id)
						   ->update($order);
			// var_dump($status); die;
			return $st;
		}

		// 我的评论管理
		public function myeva()
		{
			$id = $_SESSION['user']['id'];

			$res = $this->db
						->field('a.`id`,a.`userid`,`content`,`createtime`,a.`orderid`,o.`orderid`,`ordernum`')
						->table('`appraises` a,`orders` o')
						->where('a.userid='.$id. ' and o.`orderid`=a.`orderid`')
						->select();
			// var_dump($res);die;
			return $res;
		}

		// 用户删除评论
		public function deleva()
		{
			$id = $_GET['id'];
			// var_dump($id);die;
			$res = $this->db
						->field('`id`')
						->table('`appraises`')
						->where('id='.$id)
						->delete();

			return $res;
		}
		

		// 查询待发货状态页面信息
		public function unshipped()
		{
			$userid = $_SESSION['user']['id'];

			$res = $this->db
						->field(' o.userid, og.orderid, o.orderid,`ordernum`,`ordertime`,`orderispay`,`orderisappraise`,`orderstatus`,`totalprice`,og.price,og.cartnum,g.name,`icon`,`face`,og.goodsid')
						->table('`orders` o,`ordergoods` og,`goods` g,`goodsimg` gi')
						->where(' og.orderid = o.orderid and og.goodsid = g.id and  g.id = gi.gid and gi.face = 1 and `orderstatus`=2 and o.userid='.$userid)
						->select();
			return $res;

		} 

		// 查询待收货状态页面信息
		public function waitgoods()
		{
			$userid = $_SESSION['user']['id'];

			$res = $this->db
						->field(' o.userid, og.orderid, o.orderid,`ordernum`,`ordertime`,`orderispay`,`orderisappraise`,`orderstatus`,`totalprice`,og.price,og.cartnum,g.name,`icon`,`face`,og.goodsid')
						->table('`orders` o,`ordergoods` og,`goods` g,`goodsimg` gi')
						->where(' og.orderid = o.orderid and og.goodsid = g.id and  g.id = gi.gid and gi.face = 1 and `orderstatus`=1 and o.userid='.$userid)
						->select();
			return $res;

		} 

		// 查询待评论状态页面信息
		public function waiteva()
		{
			$userid = $_SESSION['user']['id'];

			$res = $this->db
						->field(' o.userid, og.orderid, o.orderid,`ordernum`,`ordertime`,`orderispay`,`orderisappraise`,`orderstatus`,`totalprice`,og.price,og.cartnum,g.name,`icon`,`face`,og.goodsid')
						->table('`orders` o,`ordergoods` og,`goods` g,`goodsimg` gi')
						->where(' og.orderid = o.orderid and og.goodsid = g.id and  g.id = gi.gid and gi.face = 1 and `orderstatus`=3 and o.userid='.$userid)
						->select();
			return $res;

		} 

	
	}











