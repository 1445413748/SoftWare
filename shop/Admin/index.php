<?php

include '../Public/function.php';
include '../Config/config.php';

include '../Plugin/PHPExcel/Classes/PHPExcel/IOFactory.php';

function __autoload($class)
{
	if (file_exists('./Controller/' . $class . '.php')) {
		include './Controller/' . $class . '.php';
	} elseif (file_exists('./Model/' . $class . '.php')) {
		include './Model/' . $class . '.php';
	} elseif (file_exists('../Config/' . $class . '.php')) {
		include '../Config/' . $class . '.php';
	} elseif (file_exists('../Public/' . $class . '.php')) {
		include '../Public/' . $class . '.php';
	} else {
		notice('您所访问的页面不存在', 'index.php');
	}
}

$c = empty($_GET['c']) ? 'index' : $_GET['c']; 
$m = empty($_GET['m']) ? 'index' : $_GET['m'];	
$c .= 'Controller';

$a = new $c; 
$a->$m();
