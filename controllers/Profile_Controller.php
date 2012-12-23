<?php

class Profile_Controller
{

    /**
     * This template variable will hold the 'view' portion of our MVC for this 
     * controller
     */
    public $template = 'profile';

    /**
     * This is the default function that will be called by router.php
     * 
     * @param array $getVars the GET variables posted to index.php
     */
    public function main()
    {
        $profileModel = new Profile_Model;
    	$view = new View_Model($this->template);
		
        $view->assign('userinfos', $profileModel->profile());
        
        if ($_POST['submit']) {
        	$profileModel->friendme();
        }
	}
}