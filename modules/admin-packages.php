<?php
if(isset($_GET['action'])){
	$action=$_GET['action'];
	if($action=='add' && isset($_POST['name_ru']) && isset($_POST['city']) && isset($_POST['cost'])){
		$city_id=(int)$_POST['city'];
		$cost=(float)$_POST['cost'];
		//$ingredients=(float)$_POST['ingredients'];
		addPackage(xss_clean($_POST['name_ru']), $city_id, $cost, $ingredients);
		header('Location: /admin-packages/');
		exit;
	}elseif($action=='del' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		delPackageById($id);
		header('Location: /admin-packages/');
		exit;
	}elseif($action=='edit' && isset($_GET['id']) && isset($_POST['name_ru']) && isset($_POST['city']) && isset($_POST['cost'])){
		$id=(int)$_GET['id'];
		$city_id=(int)$_POST['city'];
		$cost=(float)$_POST['cost'];
		$ingredients=(float)$_POST['ingredients'];
		editPackageById($id, xss_clean($_POST['name_ru']), $city_id, $cost, $ingredients);
		header('Location: /admin-packages/');
		exit;
	}elseif($action=='edit' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		$data=getPackageById($id);
		$citys=getAllCitys();
	}elseif($action=='add'){
		$citys=getAllCitys();
	}
}else{
	$action='main';
	$data=getAllPackages();
	$citys=getAllCitys();
}