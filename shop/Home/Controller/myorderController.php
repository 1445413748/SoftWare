<?php 

	class myorderController extends Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->myorder = new myorderModel;
		}

		// 加载我的订单页面
		public function index()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}

			$res = $this->myorder->dorder();
			if ($res) {
				notice('下单成功','index.php?c=myorder&m=getALL');
			}
				notice('下单失败');

		}

		// 加载收货地址页面
		public function address()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			include './View/order/address.html';
		} 

		// 加载添加收货地址页面
		public function addaddress()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			include './View/order/add-address.html';
		}

		//加载下单页面
		public function order()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			$res = $this->myorder->findaddress();
			include './View/order/order.html';
		}

		// 加载下订单添加收货地址页面
		public  function  orderaddress()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			include './View/order/orderaddress.html';
		}

		// 下单时增加新地址
		public function doaddress()
		{

			$res = $this->myorder->doaddress();

			if ($res) {
				notice('新增地址成功','index.php?c=myorder&m=order');
			}else{
				notice('新增失败,请稍后再试...','index.php?c=myorder&m=order');
			}
		}

		// 提交订单
		public function getALL()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}

			$res = $this->myorder->getALL();
			
			include './View/order/myorder.html';
			
		}

		// 确认收货
		public function affirm()
		{
			$res = $this->myorder->affirm();
			if ($res) {
				notice('收货成功,快去评价吧','index.php?c=myorder&m=getALL');
			}else{
				notice('网络有点小问题呢,稍后再试','index.php?c=myorder&m=getALL');
			}
		}

		public function  evaluate()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			
			$res= $_GET;
			include './View/order/evaluate.html';
		}

		public function doevaluate()
		{
			$st = $this->myorder->doevaluate();
			if ($st) {
				notice('感谢客官您的评价','index.php?c=myorder&m=getALL');
			}else{
				notice('评价提交失败,请稍后再试','index.php?c=myorder&m=getALL');
			}
		}

		public function myeva()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			$res = $this->myorder->myeva();
			include './View/order/myeva.html';
		}

		// 用户删除评论
		public function deleva()
		{
			$res = $this->myorder->deleva();

			if ($res) {
				notice('删除评论成功');
			}else{
				notice('删除失败');
			}
		}


		public function obligation()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}

			include './View/order/myorder2.html';
		}

		// 加载待发货页面
		public function unshipped()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}

			$res = $this->myorder->unshipped();
			include './View/order/myorder3.html';
		}

		// 加载待收货页面
		public function waitgoods()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}

			$res = $this->myorder->waitgoods();
			include './View/order/myorder3.html';
		}


		// 加载待评论页面
		public function waiteva()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}

			$res = $this->myorder->waiteva();
			include './View/order/myorder3.html';
		}


		public function cancel()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}

			include './View/order/myorder5.html';
		}


	}













