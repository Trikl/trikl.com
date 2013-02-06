<?php

	// Starting the session
	session_name('tiklLogin');
	session_set_cookie_params(2*7*24*60*60);
    session_start();
    
    $UID = $_SESSION['uid'];
    
	define('SERVER_ROOT' , '/home/socss/domains/trikl.com/public_html');
    define('SITE_ROOT' , 'http://trikl.com');
    
    $params = explode( "/", $_GET['p'] );
	$page = $params['0'];
	$subpage = $params['1'];
    
	require_once SERVER_ROOT . '/lib/Propel/runtime/lib/Propel.php';
	Propel::init(SERVER_ROOT . "/lib/Propel/social/build/conf/social-conf.php");
	set_include_path(SERVER_ROOT . "/lib/Propel/social/build/classes" . PATH_SEPARATOR . get_include_path());