<?php
ini_set('display_errors', true);

define('CURRENT_TIME', time() );
define('ROOT_DIR', dirname(__FILE__)."/");
define('LIB_DIR', ROOT_DIR."lib/" );
define('MODULES_DIR', ROOT_DIR."modules/" );
define('FUNCTIONS_DIR', ROOT_DIR."functions/" );
define('TEMPLATES_DIR', ROOT_DIR."tpl/" );
define('DB_DIR', ROOT_DIR."db/" );
define('DB_NAME', 'mcdonalds.sqlite' );

require_once(FUNCTIONS_DIR . "xss.php");
require_once(LIB_DIR . "db.php");
require_once(LIB_DIR . "dbutils.php");


$user=islogedin();
if($user!=false){
	define('USER_NAME', $user['name']);
	define('USER_CITY', $user['city']);
	define('USER_ADMIN', $user['admin']);
}else{
	define('USER_NAME', 'Гость');
	define('USER_CITY', 'Минск');
	define('USER_ADMIN', 0);
}
?>