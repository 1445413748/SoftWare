<?php 


	class goodsController extends Controller
	{
		public function __construct()
	 	{
	 		parent:: __construct();
	 		$this->goods = new goodsModel;
	 	}

	 	public function index()
	 	{
	 		
	 		$res = $this->goods->details();

	 		$imgs = $this->goods->imgslist();

	 		$eva = $this->goods->evaluate();

	 		include './View/goods/details.html';
	 	}

	}












