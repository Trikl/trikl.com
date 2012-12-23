<?php
if ($page === '' || !$_SESSION['uid']) {
	$page = 'login';
}
$target = SERVER_ROOT . '/controllers/' . ucfirst($page) . '_Controller.php';
if (file_exists($target)) {
	spl_autoload_register(function ($class) { require_once $class . '.php'; });
	$class = ucfirst($page) . '_Controller';
	if (class_exists($class)) {
		$controller = new $class;
	} else {
		die('class does not exist!');
	}
} else {
	die('page does not exist!');
}
spl_autoload_register(function ($classes) { require_once $classes . '.php'; });
$controller->main($subpage);