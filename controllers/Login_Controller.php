<?php

class Login_Controller
{


    /**
     * This template variable will hold the 'view' portion of our MVC for this 
     * controller
     */
    public $template = 'login';

    /**
     * This is the default function that will be called by router.php
     * 
     * @param array $getVars the GET variables posted to index.php
     */
    public function main()
    {
    
    	if ($_SESSION['uid']) {
    		header("Location: /stream");
    	} else {
    		$loginModel = new Login_Model;
    		//create a new view and pass it our template
    		$view = new View_Model($this->template);
    		if ($_POST['login']) {
				$loginModel->login();
			} elseif ($_POST['register']) {
				$loginModel->register();
			}
		}
     }
}