<?php
$id=(int)$_GET['action'];
$data=getProductionsById($id);
$ingr=Array();
$ingr=unserialize($data['ingredients']);
$allIngr=getAllIngredients();	
$citys=getAllCitys();
