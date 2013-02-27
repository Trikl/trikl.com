<?php
class Page_Controller
{

	public function __construct() {

		$params = explode( "/", $_GET['p'] );
		$page = $params['0'];
		$subpage = $params['1'];

		if (!$_SESSION['uid']) {
			$page = 'login';
		}

		$class = ucfirst($page) . '_Controller';
		$target = SERVER_ROOT . '/controllers/' . $class . '.php';
		if (file_exists($target)) {
			spl_autoload_register(array($this, 'loadPage'));
			if (class_exists($class)) {
				$controller = new $class;
				$controller->main($subpage);
			} else {
				$this->fourohfour();
			}
		} else {
			$this->fourohfour();
		}

	}

	public static function loadPage($class){
		require_once $class . '.php';
	}

	public static function fourohfour() {
		echo "not found";
	}

}
