<?php
class Logout_Model
{
	// Get general settings info and return to page
	function logout() {
			$_SESSION = array();
	    	session_destroy();
	    	header( "refresh:2;url=/login" );
	}
}