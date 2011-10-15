<?php
if(isset($_GET['action'])){
	$action=$_GET['action'];
	if($action=='add' && isset($_POST['name_ru']) && isset($_POST['city'])){
		$city_id=(int)$_POST['city'];
		addIngredient(xss_clean($_POST['name_ru']), $city_id);
		header('Location: /admin-ingredients/');
		exit;
	}elseif($action=='del' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		delIngredientById($id);
		header('Location: /admin-ingredients/');
		exit;
	}elseif($action=='edit' && isset($_GET['id']) && isset($_POST['name_ru']) && isset($_POST['city'])){
		$id=(int)$_GET['id'];
		$city_id=(int)$_POST['city'];
		editIngredientById($id, xss_clean($_POST['name_ru']), $city_id);
		header('Location: /admin-ingredients/');
		exit;
	}elseif($action=='edit' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		$data=getIngredientById($id);
		$citys=getAllCitys();
	}elseif($action=='add'){
		$citys=getAllCitys();
	}
}else{
	$action='main';
	$data=getAllIngredients();
	$citys=getAllCitys();
}