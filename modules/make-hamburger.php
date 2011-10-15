<?php
	if(isset($_POST['name_ru']) && isset($_POST['city'])){
		$city_id=(int)$_POST['city'];
		$cost=(float)$_POST['cost'];
		$last_ingr=(int)$_POST['last_ingr'];
		$arrIngr = Array();
		for($i=0; $i<=$last_ingr; $i++){
			$arrIngr[$i]['id']=(int)$_POST['ingrid_'.$i];
			if($_POST['ingr_'.$i]=='on')
				$arrIngr[$i]['ingr']=1;
			else
				$arrIngr[$i]['ingr']=0;
		}
		
		$arrIngrSer=serialize($arrIngr);

		addUrProductions(xss_clean($_POST['name_ru']), $city_id, $arrIngrSer);
		header('Location: /');
		exit;
	}
	$citys=getAllCitys();

?>