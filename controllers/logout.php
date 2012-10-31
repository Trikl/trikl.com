<?php

class Logout_Controller
{

	public $template = 'logout';


    /**
     * This is the default function that will be called by router.php
     * 
     * @param array $getVars the GET variables posted to index.php
     */
    public function main()
    {
	    $logoutModel = new Logout_Model;
	    $view = new View_Model($this->template);
	    $logoutModel->logout();

     }
}