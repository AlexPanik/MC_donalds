<?php
$r=islogedin();
if($r!=false){
	header('Location: /managment/');
}
if(isset($_POST['l'])){
	$l=xss_clean($_POST['l']);
	$p=xss_clean($_POST['p']);
	$logedin=checkLoginPass($l,$p);
	//print_r($logedin);
	if($logedin==1){
		header('Location: /managment/');
	}
	else{
		echo '<h5>Вы неправельно ввели пароль!!!</h5>';
	}
	
}


?>