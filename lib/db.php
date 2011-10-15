<?php

function sql_query($query) {
	$db = sqlite_open(DB_DIR.DB_NAME);
	$res = sqlite_query($db,$query);
	if (!$res) {
		die();
	}
	sqlite_close($db);
	return $res;
}

function sql_one($query) {
	$db = sqlite_open(DB_DIR.DB_NAME);
	$res = sqlite_query($db,$query);
	if (!$res) {
		die();
	}
	$result = sqlite_fetch_array($res);
	sqlite_close($db);
	return $result;
}

function sql_all($query) {
	$db = sqlite_open(DB_DIR.DB_NAME);
	$res = sqlite_query($db,$query);
	if (!$res) {
		die();
	}
	$result = array();
	while ($array = sqlite_fetch_array($res))  
	{ 
		$result[] = $array;
	} 
	sqlite_close($db);
	return $result;
}
?>