<?php

class TriklAutoLoad{
	public static function loadPage($class){
		require_once $class . '.php';
	}
}

?>