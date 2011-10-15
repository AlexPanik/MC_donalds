<?php
/* SEO */
function getTitleByModule($module){
	$module = xss_clean($module);
	$result = sql_one("SELECT name_ru FROM mc_titles WHERE mode='$module'");
	return $result['name_ru'];
}

function getDescriptionByModule($module){
	$module = xss_clean($module);
	$result = sql_one("SELECT name_ru FROM mc_descriptions WHERE mode='$module'");
	return $result['name_ru'];
}

function getKeywordsByModule($module){
	$module = xss_clean($module);
	$result = sql_one("SELECT name_ru FROM mc_keywords WHERE mode='$module'");
	return $result['name_ru'];
}
/* /SEO */

/* USERS */
function checkLoginPass($l, $p){
	$sess=session_id();
	$l = xss_clean($l);
	$p = md5(xss_clean($p));
	$result = sql_one("SELECT count(*) as c FROM mc_users WHERE login='$l' AND pass='$p'");
	$time=time()+60*60*10;
	$ip=$_SERVER['REMOTE_ADDR'];
	if($result['c']==1){
		sql_query("UPDATE mc_users SET lastlogin = '$time', session_id = '$sess', ip = '$ip' WHERE login = '$l' AND pass = '$p'");
	}
	
	return $result['c'];
}




function islogedin(){
	$time=time();
	$sess = session_id();
	$result = sql_one("SELECT count(*) as c FROM mc_users WHERE session_id='$sess' AND lastlogin>'$time'");
	if($result['c']==1){
		$result1 = sql_one("SELECT * FROM mc_users WHERE session_id='$sess'");
		return $result1;
	}
	else
		return false;
}

/* /USERS */

/* CITYS */
function addCity($name){
	$name = xss_clean($name);
	$res=sql_query("INSERT INTO mc_citys (name_ru) VALUES ('$name')");
	return $res;
}

function getAllCitys(){
	$result = sql_all("SELECT * FROM mc_citys ORDER BY name_ru");
	return $result;
}

function delCityById($id){
	$id=(int)$id;
	$res=sql_query("DELETE FROM mc_citys WHERE id = '$id'");
	return $res;
}

function getCityById($id){
	$id=(int)$id;
	$result=sql_one("SELECT * FROM mc_citys WHERE id = '$id'");
	return $result;
}

function editCityById($id, $name_ru){
	$id = xss_clean($id);
	$name_ru = xss_clean($name_ru);
	sql_query("UPDATE mc_citys SET name_ru = '$name_ru' WHERE id = '$id'");
}
/* /CITYS */

/* ingredients */
function addIngredient($name, $city){
	$city=(int)$city;
	$name = xss_clean($name);
	$res=sql_query("INSERT INTO mc_ingredients (name_ru, city_id) VALUES ('$name', '$city')");
	return $res;
}
function delIngredientById($id){
	$id=(int)$id;
	$res=sql_query("DELETE FROM mc_ingredients WHERE id = '$id'");
	return $res;
}
function editIngredientById($id, $name_ru, $city){
	$id=(int)$id;
	$city=(int)$city;
	$name_ru = xss_clean($name_ru);
	$res=sql_query("UPDATE mc_ingredients SET name_ru = '$name_ru', city_id = '$city' WHERE id = '$id'");
	return $res;
}
function getIngredientById($id){
	$id=(int)$id;
	$result=sql_one("SELECT * FROM mc_ingredients WHERE id = '$id'");
	return $result;
}
function getAllIngredients(){
	$result = sql_all("SELECT * FROM mc_ingredients ORDER BY name_ru");
	return $result;
}
function getIngrByCity($city){
	$city=(int)$city;
	$result=sql_all("SELECT * FROM mc_ingredients WHERE city_id = '$city' OR city_id = '0' ORDER BY name_ru");
	return $result;
}
/* /ingredients */

/* packages */
function addPackage($name, $city, $cost, $price_free){
	$name = xss_clean($name);
	$city=(int)$city;
	$cost=(float)$cost;
	$price_free=(float)$price_free;
	$res=sql_query("INSERT INTO mc_packages (name_ru, city_id, cost, price_free) VALUES ('$name', '$city', '$cost', '$price_free')");
	return $res;
}
function delPackageById($id){
	$id=(int)$id;
	$res=sql_query("DELETE FROM mc_packages WHERE id = '$id'");
	return $res;
}
function editPackageById($id, $name_ru, $city, $cost, $price_free){
	$id=(int)$id;
	$city=(int)$city;
	$cost=(float)$cost;
	$price_free=(float)$price_free;
	$name_ru = xss_clean($name_ru);
	$res=sql_query("UPDATE mc_packages SET name_ru = '$name_ru', city_id = '$city', cost = '$cost', price_free = '$price_free' WHERE id = '$id'");
	return $res;
}
function getPackageById($id){
	$id=(int)$id;
	$result=sql_one("SELECT * FROM mc_packages WHERE id = '$id'");
	return $result;
}
function getAllPackages(){
	$result = sql_all("SELECT * FROM mc_packages ORDER BY name_ru");
	return $result;
}
function getPackagesByCity($city){
	$city=(int)$city;
	$result=sql_all("SELECT * FROM mc_packages WHERE city_id = '$city' OR city_id = '0' ORDER BY name_ru");
	return $result;
}
/* /packages */

/* productions */
function addProductions($name, $city, $cost, $ingredients){
	$city=(int)$city;
	$cost=(float)$cost;
	$name = xss_clean($name);
	$res=sql_query("INSERT INTO mc_productions (name_ru, city_id, cost, ingredients) VALUES ('$name', '$city', '$cost', '$ingredients')");
	return $res;
}
function delProductionsById($id){
	$id=(int)$id;
	$res=sql_query("DELETE FROM mc_productions WHERE id = '$id'");
	return $res;
}
function editProductionsById($id, $name_ru, $city, $cost, $ingredients){
	$id=(int)$id;
	$city=(int)$city;
	$cost=(float)$cost;
	$name_ru = xss_clean($name_ru);
	$res=sql_query("UPDATE mc_productions SET name_ru = '$name_ru', city_id = '$city', cost = '$cost', ingredients = '$ingredients' WHERE id = '$id'");
	return $res;
}
function getProductionsById($id){
	$id=(int)$id;
	$result=sql_one("SELECT * FROM mc_productions WHERE id = '$id'");
	return $result;
}
function getAllProductions(){
	$result = sql_all("SELECT * FROM mc_productions ORDER BY name_ru");
	return $result;
}
function getProductionsByCity($city){
	$city=(int)$city;
	$result=sql_all("SELECT * FROM mc_productions WHERE city_id = '$city' OR city_id = '0' ORDER BY name_ru");
	return $result;
}
/* /productions */

/* discounts */
function addDiscounts($name, $city, $interest, $production, $all_production){
	$city=(int)$city;
	$interest=(int)$interest;
	$all_production=(int)$all_production;
	$name = xss_clean($name);
	$res=sql_query("INSERT INTO mc_discount (name_ru, city_id, interest, production, all_production) VALUES ('$name', '$city', '$interest', '$production', '$all_production')");
	return $res;
}
function delDiscountsById($id){
	$id=(int)$id;
	$res=sql_query("DELETE FROM mc_discount WHERE id = '$id'");
	return $res;
}
function editDiscountsById($id, $name_ru, $city, $interest, $production, $all_production){
	$id=(int)$id;
	$city=(int)$city;
	$interest=(int)$interest;
	$name_ru = xss_clean($name_ru);
	$all_production=(int)$all_production;
	$res=sql_query("UPDATE mc_discount SET name_ru = '$name_ru', city_id = '$city', interest = '$interest', production = '$production', all_production = '$all_production' WHERE id = '$id'");
	return $res;
}
function getDiscountsById($id){
	$id=(int)$id;
	$result=sql_one("SELECT * FROM mc_discount WHERE id = '$id'");
	return $result;
}
function getAllDiscounts(){
	$result = sql_all("SELECT * FROM mc_discount ORDER BY name_ru");
	return $result;
}
function getDiscountsByCity($city){
	$city=(int)$city;
	$result=sql_all("SELECT * FROM mc_discount WHERE city_id = '$city' OR city_id = '0' ORDER BY name_ru");
	return $result;
}
/* /discounts */


/* user_productions */
function addUrProductions($name, $city, $ingredients){
	$city=(int)$city;
	$name = xss_clean($name);
	$res=sql_query("INSERT INTO mc_user_productions (name_ru, city_id, ingredients) VALUES ('$name', '$city', '$ingredients')");
	return $res;
}
function delUrProductionsById($id){
	$id=(int)$id;
	$res=sql_query("DELETE FROM mc_user_productions WHERE id = '$id'");
	return $res;
}
function editUrProductionsById($id, $name_ru, $city, $ingredients){
	$id=(int)$id;
	$city=(int)$city;
	$name_ru = xss_clean($name_ru);
	$res=sql_query("UPDATE mc_user_productions SET name_ru = '$name_ru', city_id = '$city', ingredients = '$ingredients' WHERE id = '$id'");
	return $res;
}
function getUrProductionsById($id){
	$id=(int)$id;
	$result=sql_one("SELECT * FROM mc_user_productions WHERE id = '$id'");
	return $result;
}
function getUrAllProductions(){
	$result = sql_all("SELECT * FROM mc_user_productions ORDER BY name_ru");
	return $result;
}
function getUrProductionsByCity($city){
	$city=(int)$city;
	$result=sql_all("SELECT * FROM mc_user_productions WHERE city_id = '$city' OR city_id = '0' ORDER BY name_ru");
	return $result;
}
/* /user_productions */
?>