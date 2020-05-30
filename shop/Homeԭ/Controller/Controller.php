<?php 


	class Controller
	{
		public function __construct()
		{

			$this->base = new baseModel;

		}
		
		// 首页头部
		public function top()
		{
			// 调用查询商品分类
			$cate  = $this->base->catedata();
			include './View/index/top.html';
		}
		// 首页尾部
		public function footer()
		{
			include './View/index/footer.html';
		}

		// 个人中心头部
		public function usertop()
		{
			include './View/user/top.html';
		}

		// 个人中心左侧菜单
		public function userleft()
		{
			include './View/user/left.html';
		}

		// 我的订单左侧菜单
		public function orderleft()
		{
			
			include './View/order/left.html';
		}
	}















