<?php 

	session_start();
	
	//账号密码输入错误次数
	define('ERROR_LIMIT',3);
	
	// 数据库配置
	define('DSN','mysql:host=localhost;dbname=s78;charset=utf8');
	define('USER','root');
	define('PWD','1445413748');

	// 后台css,js,image路径
	define('AC', '/shop/Admin/Style/css/');
	define('AI', '/shop/Admin/Style/images/');

	define('HC', '/shop/Home/style/css/');
	define('HI', '/shop/Home/style/images/');

	define('ROWS','10');

	// 设置当前时间区
	date_default_timezone_set('PRC');
