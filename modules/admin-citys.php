<?php
if(isset($_GET['action'])){
	$action=$_GET['action'];
	if($action=='add-city' && isset($_POST['name_ru'])){
		addCity(xss_clean($_POST['name_ru']));
		header('Location: /admin-citys/');
		exit;
	}elseif($action=='del' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		delCityById($id);
		header('Location: /admin-citys/');
		exit;
	}elseif($action=='edit' && isset($_GET['id']) && isset($_POST['name_ru'])){
		$id=(int)$_GET['id'];
		editCityById($id, xss_clean($_POST['name_ru']));
		header('Location: /admin-citys/');
		exit;
	}elseif($action=='edit' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		$city=getCityById($id);
	}
}else{
	$action='main';
	$citys=getAllCitys();
}