<?php 


	class cartController extends Controller
	{
		public function __construct()
		{
			parent:: __construct();
			$this->cart = new shopcartModel;
		}
		// 加载购物车页面
		public function index()
		{
			if( empty( $_SESSION['user']['id'] ) ){
				header('location: index.php?c=login');die;
			}
			include './View/shopcart/shopcart.html';
		}

		public function addgoods()
		{
			$res = $this->cart->getdata();
			header('location: index.php?c=cart'); die;
		}

		// 商品数量减
		public function sub()
		{
			$id = $_GET['id'];
			if( $_SESSION['cart'][$id]['count']  <= 1 ){
				$_SESSION['cart'][$id]['count'] = 1;
			}else{
				$_SESSION['cart'][$id]['count']--;
			}

			header('location: index.php?c=cart'); die;
		}

		// 商品数量加
		public function add()
		{

			$id = $_GET['id'];

			// 进入Model 执行
			// if( $_SESSION['cart'][$id]['count'] <= 库存 ){
			// 	$_SESSION['cart'][$id]['count'] = 库存;
			// }else{
			// 	$_SESSION['cart'][$id]['count']++;
			// }

			$_SESSION['cart'][$id]['count']++;

			header('location: index.php?c=cart'); die;
		}

		// 删除购物车商品
		public function delcart()
		{
			$id = $_GET['id'];
			unset($_SESSION['cart'][$id]);
			header('location: index.php?c=cart'); die;
		}

	}















