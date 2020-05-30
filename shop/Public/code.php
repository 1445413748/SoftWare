<?php 

	yzm();

	function yzm($width=100, $height=42, $num=4, $type=2, $img_type='png'){
		$img = imagecreatetruecolor($width,$height);

		$font = imagecolorallocate($img, 255,  255, 255);
		$back = imagecolorallocate($img, 116,  212, 182);


		imagefilledrectangle($img, 0,0, $width,$height, $back);

			$yzm = '';
			for($i = 0; $i < $num; $i++){
				switch($type){
					case '1': $yzm .= array_rand( range(0,9), 1); break;
					case '2': 
						switch(mt_rand(1,3)){
							case '1': $yzm .= array_rand( range(0,9), 1); break;
							case '2': $yzm .= array_rand( array_flip( range('a','z')), 1); break;
							case '3': $yzm .= array_rand( array_flip( range('A','Z')), 1); break;
						}
						break;
					case '3':
						$str = '泛 民 议 员 范 国 威 在 发 言 结 束 后 故 意 点 名 邀 请 市 民 张 倩 盈 用 他 剩 余 的 发 言 时 间 再 度 发 言 主 持 会 议 的 政 制 事 务 委 员 会 主 席 廖 长 江 表 明 发 言 时 间 的 分 配 应 由 主 席 决 定 而 他 刚 才 已 裁 决 公 众 发 言 环 节 完 结 范 国 威 仍 不 依 不'; 
						$arr = explode(' ',$str);
						$yzm .= array_rand(   array_flip($arr) , 1);
						break;
				}
			}

			$w = $width/$num;

			if($type != 3){
				for($i=0; $i<$num; $i++){
					$x = $w*$i + 5;
					$y = mt_rand(15,$height-5);
					imagettftext($img, 20, mt_rand(-20,20), $x,$y, $font, './Bold.ttf', $yzm[$i]);
				}
			}else{
				for($i=0, $j=0; $i<$num*3; $i+=3, $j++){
					$x = $w*$j + 5;
					$y = mt_rand(15,$height-5);
					imagettftext($img, 20, mt_rand(-20,20), $x,$y, $font, './Bold.ttf', $yzm[$i].$yzm[$i+1].$yzm[$i+2]);
				}
			}

			for($i = 0; $i < 100; $i++){
				$x = mt_rand(0, $width);
				$y = mt_rand(0, $height);
				imagesetpixel($img, $x,$y, $font);
			}

		session_start();
		$_SESSION['code'] = $yzm;

		header('content-type:image/'.$img_type.';');
		$func = 'image'.$img_type;
		$func($img);

		imagedestroy($img);
	}


 ?>
