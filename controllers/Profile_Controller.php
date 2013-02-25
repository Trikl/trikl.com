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
        $streamModel = new Stream_Model;
        $view = new View_Model($this->template);
        $stuff = $profileModel->profile();
        if ($stuff['user']) { $singleuser = $stuff['user']->getId(); }
    	$view->assign('status', $streamModel->stream(NULL, NULL, NULL, $singleuser));
        $view->assign('userinfos', $stuff);
                        
        if ($_POST['submit']) {
        	$profileModel->friendme();
        }
	}
}