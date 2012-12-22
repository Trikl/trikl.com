<?php
	// Where are we going?
	if ($page === '' || !$_SESSION['uid']) {
			$page = 'login';
	}
	//compute the path to the file
	$target = SERVER_ROOT . '/controllers/' . $page . '.php';
	

	
	//get target
	if (file_exists($target)) {
	    include_once($target);
	
	    //modify page to fit naming convention
	    $class = ucfirst($page) . '_Controller';
	
	    //instantiate the appropriate class
	    if (class_exists($class)) {
	        $controller = new $class;
	    } else {
	        //did we name our class correctly?
	        die('class does not exist!');
	    }
	    
	} else {
	    //can't find the file in 'controllers'! 
	    die('page does not exist!');
	}
	
	include_once(SERVER_ROOT . '/models/view.php'); 
		include_once(SERVER_ROOT . '/models/stream.php'); 

	
	$classes = SERVER_ROOT . '/models/' . $page . '.php';
	if (file_exists($classes)) {
		include_once($classes);
	} else {
		die('class does not exist');
	}
	
	
	//once we have the controller instantiated, execute the default function
	//pass any GET varaibles to the main method
	$controller->main($subpage);