<?php
include SERVER_ROOT . '/lib/application_top.php';


    define('SERVER_ROOT' , '/home/socss/domains/bitpul.se/public_html');
    define('SITE_ROOT' , 'http://bitpul.se');

	require_once SERVER_ROOT . '/lib/Propel/runtime/lib/Propel.php';
	Propel::init(SERVER_ROOT . "/lib/Propel/social/build/conf/social-conf.php");
	set_include_path(SERVER_ROOT . "/lib/Propel/social/build/classes" . PATH_SEPARATOR . get_include_path());



	require_once(SERVER_ROOT . '/controllers/' . 'router.php');