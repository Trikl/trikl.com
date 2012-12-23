<?php

class Post_Controller
{
    /**
     * This template variable will hold the 'view' portion of our MVC for this 
     * controller
     */
    public $template = 'post';

    /**
     * This is the default function that will be called by router.php
     * 
     * @param array $getVars the GET variables posted to index.php
     */
    public function main()
    {
    	$params = explode( "/", $_GET['p'] );
		$page = $params['0'];
		$subpage = $params['1'];
    
    	$streamModel = new Stream_Model;
		$view = new View_Model($this->template);
		$view->assign('post', $streamModel->stream($subpage));

     }
}
