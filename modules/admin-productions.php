<?php
if(isset($_GET['action'])){
	$action=$_GET['action'];
	if($action=='add' && isset($_POST['name_ru']) && isset($_POST['city']) && isset($_POST['cost'])){
		
		$city_id=(int)$_POST['city'];
		$cost=(float)$_POST['cost'];
		$last_ingr=(int)$_POST['last_ingr'];
		$arrIngr = Array();
		for($i=0; $i<=$last_ingr; $i++){
			$arrIngr[$i]['id']=(int)$_POST['ingrid_'.$i];
			$arrIngr[$i]['ingr']=$_POST['ingr_'.$i];
		}
		$arrIngrSer=serialize($arrIngr);
		//print_r($arrIngrSer);
		addProductions(xss_clean($_POST['name_ru']), $city_id, $cost, $arrIngrSer);
		header('Location: /admin-productions/');
		exit;
	}elseif($action=='del' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		delProductionsById($id);
		header('Location: /admin-productions/');
		exit;
	}elseif($action=='edit' && isset($_GET['id']) && isset($_POST['name_ru']) && isset($_POST['city']) && isset($_POST['cost'])){
		$id=(int)$_GET['id'];
		$city_id=(int)$_POST['city'];
		$cost=(float)$_POST['cost'];
		$last_ingr=(int)$_POST['last_ingr'];
		$arrIngr = Array();
		for($i=0; $i<=$last_ingr; $i++){
			$arrIngr[$i]['id']=(int)$_POST['ingrid_'.$i];
			$arrIngr[$i]['ingr']=xss_clean($_POST['ingr_'.$i]);
		}
		$arrIngrSer=serialize($arrIngr);
		editProductionsById($id, xss_clean($_POST['name_ru']), $city_id, $cost, $arrIngrSer);
		header('Location: /admin-productions/');
		exit;
	}elseif($action=='edit' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		$data=getProductionsById($id);
		$citys=getAllCitys();
	}elseif($action=='add'){
		$citys=getAllCitys();
	}
}else{
	$action='main';
	$data=getAllProductions();
	$citys=getAllCitys();
}