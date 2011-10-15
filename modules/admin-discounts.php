<?php
if(isset($_GET['action'])){
	$action=$_GET['action'];
	if($action=='add' && isset($_POST['name_ru']) && isset($_POST['city']) && isset($_POST['interest'])){
		
		$city_id=(int)$_POST['city'];
		$interest=(int)$_POST['interest'];
		$last_ingr=(int)$_POST['last_ingr'];
		$all_production=xss_clean($_POST['all_production']);
		if($_POST['all_production']=='on')
			$ap=1;
		else
			$ap=0;
		$arrIngr = Array();
		for($i=0; $i<=$last_ingr; $i++){
			$arrIngr[$i]['id']=(int)$_POST['ingrid_'.$i];
			if($_POST['ingr_'.$i]=='on')
				$arrIngr[$i]['ingr']=1;
			else
				$arrIngr[$i]['ingr']=0;
		}
		$arrIngrSer=serialize($arrIngr);
		//print_r($arrIngr);
		
		addDiscounts(xss_clean($_POST['name_ru']), $city_id, $interest, $arrIngrSer, $ap);
		header('Location: /admin-discounts/');
		exit;
	}elseif($action=='del' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		delDiscountsById($id);
		header('Location: /admin-discounts/');
		exit;
	}elseif($action=='edit' && isset($_GET['id']) && isset($_POST['name_ru']) && isset($_POST['city']) && isset($_POST['interest'])){
		$id=(int)$_GET['id'];
		$city_id=(int)$_POST['city'];
		$interest=(int)$_POST['interest'];
		$last_ingr=(int)$_POST['last_ingr'];
		$all_production=xss_clean($_POST['all_production']);
		if($_POST['all_production']=='on')
			$ap=1;
		else
			$ap=0;
		$arrIngr = Array();
		for($i=0; $i<=$last_ingr; $i++){
			$arrIngr[$i]['id']=(int)$_POST['ingrid_'.$i];
			if($_POST['ingr_'.$i]=='on')
				$arrIngr[$i]['ingr']=1;
			else
				$arrIngr[$i]['ingr']=0;
		}
		$arrIngrSer=serialize($arrIngr);
		editDiscountsById($id, xss_clean($_POST['name_ru']), $city_id, $interest, $arrIngrSer, $ap);
		header('Location: /admin-discounts/');
		exit;
	}elseif($action=='edit' && isset($_GET['id'])){
		$id=(int)$_GET['id'];
		$data=getDiscountsById($id);
		$citys=getAllCitys();
	}elseif($action=='add'){
		$citys=getAllCitys();
	}
}else{
	$action='main';
	$data=getAllDiscounts();
	$citys=getAllCitys();
}