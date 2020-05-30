<?php 

	class evaluateController extends Controller
	{	
		public function __construct()
		{
			parent::__construct();
			$this->evaluate = new evaluateModel;
		}

		// 加载评论页面
		public function index()
		{
			$where = null;
			if( !empty($_GET['search']) ){
				$s = $_GET['search'];
				$where = '( o.`ordernum` = "'.$s.'" or  u.`name` like "%'.$s.'%" )' ;
				// var_dump($where); die;
			}
			// 分页
			$page = new Page;
			$count = $this->evaluate->count($where);
			// var_dump($count); die;
			$limit = $page->limit($count);

			$res = $this->evaluate->getAll($where,$limit);

			include './View/evaluate/index.html';
		}

		// 隐藏评论
		public function isShow()
		{
			$res = $this->evaluate->isShow();

			header('location: index.php?c=evaluate'); die;
		}

		// 删除评论
		public function delEva()
		{
			$del = $this->evaluate->delEva();

			if ($del) {
				notice('删除评论成功');
			}else{
				notice('删除失败,请稍后再试');
			}
		}

		// 加载处理评价页面
		public function evaEdit()
		{
			$res = $this->evaluate->findEva();
			include './View/evaluate/edit.html';
		}

		// 处理评价
		public function doEdit()
		{
			$res = $this->evaluate->doEdit();
			if ($res) {
				notice('回复成功','index.php?c=evaluate');
			}else{
				notice('回复失败,请稍后再试');
			}
		}

		// 加载评论详情页
		public function evaInfo()
		{
			$res = $this->evaluate->findEva();

			include './View/evaluate/evaluateinfo.html';
		}







	}

	








