<?php 


	class baseModel
	{
		public function __construct()
		{
			$this->db = new DB;

			if (!empty($_SESSION['user']['id'])) {
				$id = $_SESSION['user']['id'];

				$res = $this->db
							->field('`id`')
							->table('user')
							->where('id='.$id)
							->find();

				if (empty($res)) {
					unset($_SESSION['user']);
					notice('该用户不存在','index.php');die;
				}
			}
		}


		public function catedata()
		{
			$res= $this->db
					   ->field('name,id')
					   ->table('category')
					   ->where('pid!=0')
					   ->select();
			return $res;
		}

		
	}













