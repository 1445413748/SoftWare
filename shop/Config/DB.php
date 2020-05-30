<?php 

	class DB
	{
		protected $pdo;
		protected $table;
		protected $field;
		protected $where;
		protected $group;
		protected $having;
		protected $order;
		protected $limit;
		public $sql;

		public function __construct()
		{
			$this->pdo = new PDO(DSN,USER,PWD);

		}
		
		public function table($table)
		{
			$this->table = $table;
			return $this;
		}

		public function select()
		{

				$this->sql = 'select '.$this->field.' from '.$this->table.$this->where.$this->group.$this->having.$this->order.$this->limit;

				$ps = $this->pdo->query($this->sql);

				
				if( is_object($ps) ){
					$res = $ps->fetchAll(PDO::FETCH_ASSOC);
					return $res;
				}

			return false;
		}

		public function find()
		{
				$this->sql = 'select '.$this->field.' from '.$this->table.$this->where;
				$ps = $this->pdo->query($this->sql);

				if( is_object($ps) ){
					$res = $ps->fetch(PDO::FETCH_ASSOC);
					return $res;
				}

			return false;
		}

		public function insert($data = [])
		{
				if( empty($data) ){
					return false;
				}

				$field = null;
				$value = null;
				foreach ($data as $k => $v) {
					$field .= '`'.$k.'`,';
					$value .= '"'.$v.'",';
				}

				$field = rtrim($field, ',');
				$value = rtrim($value, ',');

				$this->sql = 'insert into '.$this->table.'('.$field.')   values('.$value.')  ';

				$res = $this->pdo->exec($this->sql);

				if( $res ){
					$newId = $this->pdo->lastInsertId();
					return $newId;	
				}
			return false;

		}

		public function update($data = [])
		{
				if( empty($data) ){
					return false;
				}

				$str = null;
				foreach($data as $k => $v){
					$str .= '`'.$k.'`="'.$v.'",';
				}

				$str = rtrim($str, ',');

				$this->sql = 'update '.$this->table.' set  '.$str.$this->where;

				$res = $this->pdo->exec($this->sql);

				return $res;
		}

		public function delete()
		{
				$this->sql = 'delete from '.$this->table.$this->where;

				$res = $this->pdo->exec($this->sql);

				if ($res) {
					return $res;
				}else{
					return false;
				}

		}



		public function field($field = '*')
		{
			if( $field != '*'){
				$this->field = $field;
			}
			return $this;
		}

		public function where($condition = '')
		{
			if($condition != ''){
				$this->where = ' where '. $condition;
			}
			return $this;
		}

		public function group($condition = '')
		{
			if($condition != ''){
				$this->group = ' group by '. $condition;
			}
			return $this;
		}

		public function having($condition = '')
		{
			if($condition != ''){
				$this->having = ' having '. $condition;
			}
			return $this;
		}

		public function order($condition = '')
		{
			if($condition != ''){
				$this->order = ' order by '. $condition;
			}
			return $this;
		}

		public function limit($condition = '')
		{
			if($condition != ''){
				$this->limit = ' limit '. $condition;
			}
			return $this;
		}


	}
