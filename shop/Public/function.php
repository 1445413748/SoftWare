<?php 
	
	function notice($msg, $url = '', $time = 3)
	{
		echo $msg;

		if( $url == '' ){
			$url = $_SERVER['HTTP_REFERER'];
		}
		echo '<meta http-equiv="refresh" content="'.$time.'; url= '.$url.'">'; die;
	}

	function pass($pwd)
	{
		// 密码复杂度
		// 长度: 6 - 14
		// 内容: 可以有数字, 小写字母, 大写字母, 标点
		$preg = '/^.{6,14}$/';
		if( !preg_match($preg, $pwd)  ){
			return false;
		}

		$preg = '/ /';
		if( preg_match($preg, $pwd)  ){
			return false;
		}

		return true;

	}

	// 上传图片的路径
	function imgUrl($filename)
	{
		$url = '/shop/upload/';
		$url .= substr($filename, 0, 4). '/';
		$url .= substr($filename, 4, 2). '/';
		$url .= substr($filename, 6, 2). '/';
		$url .= $filename;
		return $url;
	}


	function security()
	{
		foreach ($_GET as $key => $value) {
				$_GET[$key] = htmlentities($value);
		}
		foreach ($_POST as $key => $value) {
				$_POST[$key] =htmlentities($value);
		}
	}
	security();
