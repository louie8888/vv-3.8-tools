<?php
@ini_set('display_errors','On');
error_reporting(E_ALL&~E_NOTICE);
@set_time_limit(120);
@ini_set('pcre.backtrack_limit', 1000000);
date_default_timezone_set('PRC');
header("Content-type: text/html; charset=gbk");
define('VV_INC', str_replace("\\", '/', dirname(__FILE__)));
define('VV_ROOT', str_replace("\\", '/', substr(VV_INC, 0, -4)));
@ini_set('memory_limit','64M');
@ini_set('memory_limit','128M');
@ini_set('memory_limit','256M');
@ini_set('memory_limit','384M');
$GLOBALS['domain_suffix']=array('com', 'net', 'org', 'edu', 'info', 'biz', 'name','xyz','top', 'tw', 'eu', 'it', 'cn', 'mobi', 'cc', 'asia', 'pro', 'hk', 'me', 'uk', 'au', 'in', 'aero', 'ws', 'nu', 'ca', 'nz', 'us', 'fr', 'tv', 'ch', 'be', 'se', 'ie', 'ae', 'ru', 'pw', 'wang','gov.cn');
require(VV_ROOT . '/data/version.php');
require(VV_INC . '/define.php');
require(VV_INC . '/function.php');
@set_error_handler('errorHandler');
@register_shutdown_function('fatalErrorHandler');
define('RUN_TIME',debug_time());
$version = "万能小偷系统 " . VV_VERSION;
//iis7 REQUEST_URI
if(isset($_SERVER['HTTP_X_ORIGINAL_URL'])){
	$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];
}
//iis6 REQUEST_URI
if(isset($_SERVER['HTTP_X_REWRITE_URL'])) {
	$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
}
require(VV_INC . '/init.php');
?>