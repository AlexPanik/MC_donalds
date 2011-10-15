<?php
@session_start();
require_once 'config.php';


if(!isset($_REQUEST['mode'])){
	$mode='main';
}else{
	$mode=$_REQUEST['mode'];
}



$avaible_modules= array('main','make-hamburger','admin', 'managment', 'admin-citys', 'admin-ingredients', 'admin-packages', 'admin-productions', 'admin-discounts', 'make-order', 'production', 'user-production');
$avaible_modules = array_flip ($avaible_modules);
if (!isset($avaible_modules[$mode])) $mode='main';
$search_module = $mode;

#Проверка на права
$admin_modules= array('managment', 'admin-citys', 'admin-ingredients', 'admin-packages', 'admin-productions', 'admin-discounts');
$admin_modules = array_flip ($admin_modules);
if (isset($admin_modules[$mode]) && USER_ADMIN!=1){
	header('Location: /');
	exit;
}

#/Проверка на права
	
$title=getTitleByModule($search_module);
$description=getDescriptionByModule($search_module);
$keywords=getKeywordsByModule($search_module);



if(file_exists(MODULES_DIR.$search_module.'.php')){
	require_once (MODULES_DIR.$search_module.'.php');
	require_once(TEMPLATES_DIR.'block/header.tpl');
    require_once(TEMPLATES_DIR.$search_module.'.tpl');
    require_once(TEMPLATES_DIR.'block/footer.tpl');
}else{
	die ('Модуль не найден!');
}
?>