<?php 

		class indexController extends Controller
		{
			public function __construct()
			{
				parent::__construct();
				$this->index = new indexModel;
			}

			public function index()
			{

				$tuijian = $this->index->goodslist('0,5');
				$hotgoods = $this->index->goodslist('0,8');
				include './View/index/index.html';
			}
		}













