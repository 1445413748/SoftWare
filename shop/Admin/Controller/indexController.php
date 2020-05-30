<?php 
	
	class indexController extends Controller
	{
		public function __construct()
		{
			// 继承Controller中的构造判断是否登陆
			parent::__construct();

			$this->index = new indexModel;

		}			
		// 后台首页
		public function index()
		{
			include './View/index/index.html';
		}

		public function info()
		{
			$usersum = $this->index->usersum();
			$amount = $this->index->amount();
			$order = $this->index->orderQuantity();
			$goods = $this->index->goodsSum();
			$eva = $this->index->evaSum();
			include './View/index/info.html';
		}
		
		
		// 访问不存在的方法时自动跳转
		public function __call($c, $v)
		{
			notice('您的操作有误', 'index.php');
		}
	}

