<?php 
	class Page
	{
		protected $page;
		protected $all;
		protected $count;

		public function goodsshowPage()
		{

			$html = null;

			if ( empty($_GET['id']) ) {
				$cid = null; 
			}else{
				$cid = '&id='.$_GET['id'];
			}

			$numList = null;
			for ($i=1; $i <= $this->all; $i++) { 
				$numList .= '<a href="index.php?c=cate&page='.$i.$cid.'"  onFocus="this.blur()"> '. $i .' </a>';
			}

			$html .= $this->count.' 条数据 '.$this->page.'/'.$this->all.' 页';
			$html .= '<a href="index.php?c=cate&page=1'.$cid.'"  onFocus="this.blur()">首页</a>';
			$html .= '<a href="index.php?c=cate&page='.($this->page - 1).$cid.'" onFocus="this.blur()">上一页</a>';

			$html .= $numList;

			$html .= '<a href="index.php?c=cate&page='.($this->page + 1).$cid.'" onFocus="this.blur()">下一页</a>';
			$html .= '<a href="index.php?c=cate&page='.$this->all.$cid.'" onFocus="this.blur()">尾页</a>';
			return $html;
		}

		public function showPage()
		{
			$c = $_GET['c'];
			$numList = null;

			if ( empty($_GET['search'])) {
				$search = null;
			}else{
				$search = '&search='.$_GET['search'].'';
			}

			for($i = 1; $i <= $this->all; $i++  ){
				$numList .= '<a href="index.php?c='.$c.'&page='.$i.$search.'" target="myIframe" class="btn-limit" "> '. $i .' </a>';
			}
			
			$html = '<a href="index.php?c='.$c.'&page=1" target="myIframe" class="btn-limit" ">首页</a>';
			$html .= '<a href="index.php?c='.$c.'&page='.($this->page - 1).$search.'" target="myIframe" class="btn-limit" "> << </a>';

			$html .= $numList;
	
			$html .= '<a href="index.php?c='.$c.'&page='.($this->page + 1).$search.'" target="myIframe" class="btn-limit" "> >> </a>';
			$html .= '<span class="btn-limit-span" > '.$this->count.' 条数据 '.$this->page.'/'.$this->all.'页</span>';
			$html .= '<a href="index.php?c='.$c.'&page='.$this->all.'" target="myIframe" class="btn-limit" ">尾页</a>';

			return $html;
		}




		public function limit($count)
		{
				$this->page = empty($_GET['page'])? 1 : $_GET['page'] ;

				$this->count = $count;
				$this->all = ceil($count / ROWS);

				$this->page = max($this->page, 1);
				$this->page = min($this->page, $this->all);

				$key = ($this->page - 1) * ROWS;

				$limit = $key.','.ROWS;
				return $limit;

		}



	}

