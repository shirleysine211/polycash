<?php
if ($session_key == "") {
	$session_key = session_id();
}

if ($session_key == "") {
	session_start();
	$session_key = session_id();
}

if (strlen($session_key) > 0) {
	$query = "SELECT * FROM user_sessions WHERE session_key='$session_key' AND expire_time > '".time()."' AND logout_time=0;";// AND ip_address='".$_SERVER['REMOTE_ADDR']."';";
	$result = run_query($query);
	
	if (mysql_numrows($result) > 0) {
		$session = mysql_fetch_array($result);
		$q = "SELECT * FROM users WHERE user_id='".$session['user_id']."';";
		$r = run_query($q);
		
		if (mysql_numrows($r) == 1) {
			$thisuser = mysql_fetch_array($r);
		}
	}
}
?>