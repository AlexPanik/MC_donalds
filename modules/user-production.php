<?php
$id=(int)$_GET['action'];
$data=getUrProductionsById($id);
$ingr=Array();
$ingr=unserialize($data['ingredients']);
//print_r($ingr);
$allIngr=getAllIngredients();	
$citys=getAllCitys();
