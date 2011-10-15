<?php
@session_start();
require_once 'config.php';
header("Content-type: text/html; charset=windows-1251");
if(!isset($_REQUEST['mode'])){
	$mode='';
}else{
	$mode=xss_clean($_REQUEST['mode']);
}

$avaible_modules= array('ingr', 'ingr_by_id', 'disc', 'disc_by_id', 'ingr_user', 'order_prod', 'order_prod_pack', 
						'order_prod_disc', 'order_prod_by_disc', 'get_cost');
$avaible_modules = array_flip ($avaible_modules);
if (!isset($avaible_modules[$mode])) $mode='';
$search_module = $mode;

if($search_module==''){
	header('Location: /');
	exit;
}
else{
	switch ($search_module){
		case 'ingr':
			$city=(int)$_REQUEST['city'];
			if($city!=0){
				$ingr=getIngrByCity($city);
			}
			else{
				$ingr=getAllIngredients();
			}
			if(sizeof($ingr)!=0){
				$str='<h2>Ингредиенты (кол-во):</h2>';
				$i=0;
				foreach ($ingr as $key=>$val){
					$str.='<div class="label">'.$val['name_ru'].':</div><div class="value" ><input type="hidden" name="ingrid_'.$i.'" value="'.$val['id'].'"><input type="text" name="ingr_'.$i.'"></div><br><br>';
					$i++;
				}
				$str.='<input type="hidden" name="last_ingr" value="'.($i-1).'">';
				echo $str;
			}
			else{
				echo 'Вначале добавьте ингредиенты';
			}
		break;
		case 'ingr_by_id':
			$id=(int)$_REQUEST['id'];
			$city=(int)$_REQUEST['city'];
			if($city!=0){
				$ingr=getIngrByCity($city);
			}
			else{
				$ingr=getAllIngredients();
			}
			$prod=getProductionsById($id);
			$useIngr=unserialize($prod['ingredients']);
			//print_r($useIngr);
			
			if(sizeof($ingr)!=0){
				$str='<h2>Ингредиенты (кол-во):</h2>';
				$i=0;
				foreach ($ingr as $key=>$val){
					foreach ($useIngr as $k=>$v){
						if($v['id']==$val['id']){
							$str.='<div class="label">'.$val['name_ru'].':</div><div class="value" ><input type="hidden" name="ingrid_'.$i.'" value="'.$val['id'].'"><input type="text" name="ingr_'.$i.'" value="'.$v['ingr'].'"></div><br><br>';
						}
					}
					$i++;
				}
				$str.='<input type="hidden" name="last_ingr" value="'.($i-1).'">';
				echo $str;
			}
			else{
				echo 'Вначале добавьте ингредиенты';
			}
		break;
		case 'disc':
			$city=(int)$_REQUEST['city'];
			if($city!=0){
				$prod=getProductionsByCity($city);
			}
			else{
				$prod=getAllProductions();
			}
			if(sizeof($prod)!=0){
				$str='<h2>Продукция относящеяся к скидке:</h2>';
				$i=0;
				foreach ($prod as $key=>$val){
					$str.='<div class="label">'.$val['name_ru'].':</div><div class="value" ><input type="hidden" name="ingrid_'.$i.'" value="'.$val['id'].'"><input type="checkbox" name="ingr_'.$i.'"></div><br><br>';
					$i++;
				}
				$str.='<input type="hidden" name="last_ingr" value="'.($i-1).'">';
				echo $str;
			}
			else{
				echo 'Вначале добавьте продукцию';
			}
		break;
		case 'order_prod':
			$city=(int)$_REQUEST['city'];
			if($city!=0){
				$prod=getProductionsByCity($city);
			}
			else{
				$prod=getAllProductions();
			}
			if(sizeof($prod)!=0){
				$str='<h2>Что будете заказывать(кол-во):</h2>';
				$i=0;
				foreach ($prod as $key=>$val){
					$str.='<div class="label">'.$val['name_ru'].' ('.$val['cost'].'$):</div><div class="value" ><input type="hidden" name="ingrid_'.$i.'"  id="ingrid_'.$i.'" value="'.$val['id'].'"><input type="text"  name="ingr_'.$i.'"  id="ingr_'.$i.'"></div><br><br>';
					$i++;
				}
				$str.='<input type="hidden" name="last_ingr" id="last_ingr" value="'.($i-1).'">';
				echo $str;
			}
			else{
				echo 'Нет продукции';
			}
		break;
		case 'disc_by_id':
			$city=(int)$_REQUEST['city'];
			$id=(int)$_REQUEST['id'];
			if($city!=0){
				$prod=getProductionsByCity($city);
			}
			else{
				$prod=getAllProductions();
			}
			$disc=getDiscountsById($id);
			$useProd=unserialize($disc['production']);
			
			
			if(sizeof($prod)!=0){
				$str='<h2>Продукция относящеяся к скидке:</h2>';
				$i=0;
				foreach ($prod as $key=>$val){
					foreach ($useProd as $k=>$v){
						if($val['id']==$v['id']){
							$chk='';
							if($v['ingr']==1){
								$chk='checked';
							}
							$str.='<div class="label">'.$val['name_ru'].':</div><div class="value" ><input type="hidden" name="ingrid_'.$i.'" value="'.$val['id'].'"><input type="checkbox" '.$chk.' name="ingr_'.$i.'"></div><br><br>';
						}
					}
					$i++;
				}
				$str.='<input type="hidden" name="last_ingr" value="'.($i-1).'">';
				echo $str;
			}
			else{
				echo 'Вначале добавьте ингредиенты';
			}
		break;
		case 'ingr_user':
			$city=(int)$_REQUEST['city'];
			if($city!=0){
				$ingr=getIngrByCity($city);
			}
			else{
				$ingr=getAllIngredients();
			}
			if(sizeof($ingr)!=0){
				$str='<h2>Ингредиенты:</h2>';
				$i=0;
				foreach ($ingr as $key=>$val){
					$str.='<div class="label">'.$val['name_ru'].':</div><div class="value" ><input type="hidden" name="ingrid_'.$i.'" value="'.$val['id'].'"><input type="checkbox" name="ingr_'.$i.'"></div><br><br>';
					$i++;
				}
				$str.='<input type="hidden" name="last_ingr" value="'.($i-1).'">';
				echo $str;
			}
			else{
				echo 'Вначале добавьте ингредиенты';
			}
		break;
		case 'order_prod_pack':
			$city=(int)$_REQUEST['city'];
			if($city!=0){
				$pack=getPackagesByCity($city);
			}
			else{
				$pack=getAllPackages();
			}
			if(sizeof($pack)!=0){
						echo '<option value="0">Без упаковки</option>';
				foreach ($pack as $key=>$val){
					$cost='';
					if($val['cost']!=0){
						$cost=$val['cost'].'($)';
					}
					echo '<option value="'.$val['id'].'">'.$val['name_ru'].' '.$cost.'</option>';
				}
				
			}
			else{
				echo '<option value="0">Без упаковки</option>';
			}
		break;
		case 'order_prod_disc':
			$city=(int)$_REQUEST['city'];
			if($city!=0){
				$disc=getDiscountsByCity($city);
			}
			else{
				$disc=getAllDiscounts();
			}
			if(sizeof($disc)!=0){
						echo '<option value="0">Без скидки</option>';
				foreach ($disc as $key=>$val){
					
					
						$cost=$val['interest'].'%';
					
					echo '<option value="'.$val['id'].'">'.$val['name_ru'].' ('.$cost.')</option>';
				}
				
			}
			else{
				echo '<option value="0">Без скидки</option>';
			}
		break;
		case 'order_prod_by_disc':
			$city=(int)$_REQUEST['city'];
			$disc_id=(int)$_REQUEST['disc'];
			if($city!=0){
				$prod=getProductionsByCity($city);
			}
			else{
				$prod=getAllProductions();
			}
			$disc=getDiscountsById($disc_id);
			if($disc['all_production']==1 || $disc_id==0){
				if(sizeof($prod)!=0){
					$str='<h2>Что будете заказывать(кол-во):</h2>';
					$i=0;
					foreach ($prod as $key=>$val){
						$str.='<div class="label">'.$val['name_ru'].' ('.$val['cost'].'$):</div><div class="value" ><input type="hidden" name="ingrid_'.$i.'" id="ingrid_'.$i.'" value="'.$val['id'].'"><input type="text"  name="ingr_'.$i.'" id="ingr_'.$i.'"></div><br><br>';
						$i++;
					}
					$str.='<input type="hidden" name="last_ingr" id="last_ingr" value="'.($i-1).'">';
					echo $str;
				}
				else{
					echo 'Нет продукции';
				}
			}
			else{
				$disc_prod=unserialize($disc['production']);
				$str='<h2>Что будете заказывать(кол-во):</h2>';
				$i=0;
				foreach($disc_prod as $key=>$val){
					foreach ($prod as $k=>$v){
						if($v['id']==$val['id']){
							$str.='<div class="label">'.$v['name_ru'].' ('.$v['cost'].'$):</div><div class="value" ><input type="hidden" name="ingrid_'.$i.'" id="ingrid_'.$i.'" value="'.$v['id'].'"><input type="text"  name="ingr_'.$i.'" id="ingr_'.$i.'"></div><br><br>';
							$i++;
						}
					}
				}
				$str.='<input type="hidden" name="last_ingr" id="last_ingr" value="'.($i-1).'">';
				echo $str;
			}
		break;
		case 'get_cost':
			$pack_id=(int)$_REQUEST['pack'];
			$kol=(int)$_REQUEST['kol'];
			$disc_id=(int)$_REQUEST['disc'];
			$arr_prod = Array();
			for($i=0; $i<=$kol; $i++){
				if((int)$_REQUEST['ingr_'.$i]!=0){
					$arr_prod[$i]['kol']=(int)$_REQUEST['ingr_'.$i];
					$arr_prod[$i]['id']=(int)$_REQUEST['ingrid_'.$i];
				}
			}
			$all_cost=0;
			foreach($arr_prod as $key=>$val){
				$tek_prod=getProductionsById($val['id']);
				$all_cost+=$val['kol']*$tek_prod['cost'];
			}
			$tek_pak=getPackageById($pack_id);
			if($tek_pak==0 || $tek_pak['price_free']>$all_cost){
				$all_cost+=$tek_pak['cost'];
			}
			$tek_disc=getDiscountsById($disc_id);
			$tek_int=(int)$tek_disc['interest'];
			$all_cost=$all_cost-($tek_int/100*$all_cost);
			echo ' на '.$all_cost.'$';
		break;
		default:
		header('Location: /');
		exit;
	}
}