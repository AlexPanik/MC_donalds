<?
	function check_user(){
		$ses_id=session_id();
		$now_time=time();
		checkUser($ses_id, $now_time);
	}
?>