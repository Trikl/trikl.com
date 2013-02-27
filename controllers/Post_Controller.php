<?php

class Post_Controller
{
    /**
     * This template variable will hold the 'view' portion of our MVC for this 
     * controller
     */
    public $template = 'postpage';

    /**
     * This is the default function that will be called by router.php
     * 
     * @param array $getVars the GET variables posted to index.php
     */
    public function main($subpage)
    {
    
    	$streamModel = new Stream_Model;
		$view = new View_Model($this->template);
		$view->assign('status', $streamModel->stream($subpage, 'single'));

     }
}


