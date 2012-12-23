<?php

class Friends_Controller
{

    /**
     * This template variable will hold the 'view' portion of our MVC for this 
     * controller
     */
    public $template = 'friends';

    /**
     * This is the default function that will be called by router.php
     * 
     * @param array $getVars the GET variables posted to index.php
     */
    public function main()
    {
        $friendsModel = new Friends_Model;
    	$view = new View_Model($this->template);
		
        $view->assign('userinfos', $friendsModel->friends());
	}
}