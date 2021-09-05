<?php
/*--------------------------
小偷网站定制
qq: 996948519
---------------------------*/

//�ж�js����php���ع�棬��Զ��ͳһ�����ȽϷ�������л�
//$js = file_get_contents("http://www.gxsgx.com/jsOrPhp.php");
//if($js == "0")
//{
  //  include_once("judge.php");
//}
//else
//{
   // echo "<script src='static.js'></script>";
//}
//新增广告js的nofollow属性，看看是否会比较不会被k。
echo "<script rel='nofollow' src='static.js'></script>";
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
