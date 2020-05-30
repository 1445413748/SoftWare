<?php 
	
	class Upload
	{
		public function is_upload()
		{
			$key = key($_FILES);
			if( empty($key) ){
				return false;
				
			}

			$error = $_FILES[$key]['error'];
			if( $error == 4){
				return false;
			}

			return true;
		}

		public function singleFile($savePath = '../upload/', $allowType = ['image'])
		{
				$key = key($_FILES);
				if( empty($key) ){
					return '您的文件过大';
				}

				$error = $_FILES[$key]['error'];
				if( $error > 0){
					switch( $error ){
						case 1: return '您的文件过大';
						case 2: return '您的文件过大';
						case 3: return '请检查您的网络';
						case 4: return '请上传你的文件';
						case 6: return '服务器繁忙';
						case 7: return '服务器繁忙';
					}
				}

				$tmp = $_FILES[$key]['tmp_name'];
				if(  !is_uploaded_file( $tmp ) ){
					return '非法上传';
				}

				$type = strtok($_FILES[$key]['type'], '/');
				if( !in_array($type, $allowType)){
					return '文件格式不正确';
				}

				$suffix = strrchr($_FILES[$key]['name'], '.');
				$file = date('Ymd').uniqid().$suffix;

				$dir = $savePath.date('/Y/m/d/');
				if( !file_exists($dir) ){
					mkdir($dir, 0777, true);
				}

				if( move_uploaded_file($tmp, $dir.$file) ){
					$arr[] = $file;
					return $arr;
				}

				return '上传失败';
		}

	}

