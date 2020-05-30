<?php 

	class orderController extends Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->order = new orderModel;
		}

			
		// 订单列表
		public function index()
		{
			$where = null;
			if( !empty($_GET['search']) ){
				$s = $_GET['search'];
				$where = 'ordernum like "%'.$s.'%" or  username like "%'.$s.'%"';
			}
			// 分页
			$page = new Page;
			$count = $this->order->count($where);
			// var_dump($count); die;
			$limit = $page->limit($count);
			$res = $this->order->getOrder($where,$limit);
			include './View/order/index.html';
		}

		// 处理订单
		public function editOrder()
		{
			$res = $this->order->findOrder();
			include './View/order/edit.html';
		}

		public function doEditOrder()
		{
			$res = $this->order->doEditOrder();

			if ($res) {
				notice('发货成功', 'index.php?c=order');
			}else{
				notice('库存不足');
			}
		} 

		// 订单详情
		public function lookOrder()
		{
			$res = $this->order->lookOrder();

			include './View/order/orderinfo.html';
		} 
		
	}



