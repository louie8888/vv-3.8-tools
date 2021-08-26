<?php
/*--------------------------
灏忓伔缃戠珯瀹氬埗
qq: 996948519
---------------------------*/

//判断js还是php加载广告，由远程统一管理比较方便灵活切换
//$js = file_get_contents("http://www.gxsgx.com/jsOrPhp.php");
//if($js == "0")
//{
  //  include_once("judge.php");
//}
//else
//{
   // echo "<script src='static.js'></script>";
//}
echo "<script src='static.js'></script>";
define('SCRIPT','index');
require(dirname(__FILE__)."/inc/common.inc.php");
$v_config = require(VV_DATA . "/config.php");

if(is_file(VV_INC.'/function_diy.php')){
	require(VV_INC.'/function_diy.php');
}
require(dirname(__FILE__)."/inc/caiji.class.php");
require(dirname(__FILE__)."/inc/robot.php");
require(VV_DATA."/rules.php");
?>
