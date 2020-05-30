<?php 

	class orderModel
	{
		public function __construct()
		{
			$this->db = new DB;
		}

		// 查询所有订单
		public function getOrder($where = null, $limit = null)
		{
			$res = $this->db
						->field('`orderid`,`username`,`ordernum`,`totalprice`,`orderstatus`,`orderispay`,`ordertime`')
						->table('`orders`')
						->where($where)
						->order('`ordertime` desc')
						->limit($limit)
						->select();
			return $res;
		}

		// 统计订单id
		public function count($where=null)
		{	

			$count = $this->db
						  ->field(' count(orderid) as total ')
						  ->table('`orders`')
						  ->where($where)
						  ->select();

			return $count[0]['total'];

		}

		public  function findOrder()
		{
			$id = $_GET['id'];
			
			$res = $this->db
						->field('`orderid`,`username`,`ordernum`,`orderstatus`,`orderispay`')
						->table('`orders`')
						->where('`orderid`='.$id)
						->find();
			return $res;
		}

		// 处理订单(发货)
		public function doEditOrder()
		{
			$id = $_POST['orderid'];
			$data['orderstatus'] = $_POST['orderstatus'];
			$res = $this->db
						->table('`orders`')
						->where('`orderid`='.$id)
						->update($data);
			return $res;
			
		}

		// 查看订单详情
		public function lookOrder()
		{
			$orderid = $_GET['id'];
			
			$res = $this->db
						->field('o.`orderid`,o.`ordernum`,o.`username`,o.`useraddress`,o.`usertel`,o.`totalprice`,og.`orderid`,og.`goodsid`,og.`goodsname`,og.`cartnum`,g.`id`,gi.`gid`,gi.`face`,gi.`icon`')
						->table('`orders` o,`ordergoods` og,`goodsimg` gi,`goods` g')
						->where('o.orderid = og.orderid and og.goodsid = g.id and og.goodsid = gi.gid and gi.face = 1  and o.orderid='.$orderid )
						->find();
			return $res;
		}
	}


















