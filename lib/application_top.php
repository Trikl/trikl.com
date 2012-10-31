<?php
	// calculate page load times -- this should always be at the top!
	$m_time = explode(" ",microtime());
	$m_time = $m_time[0] + $m_time[1];
	$loadstart = $m_time;

	// Starting the session
	session_name('tiklLogin');
	session_set_cookie_params(2*7*24*60*60);
    session_start();
    

?>
