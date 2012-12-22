<?php

class Photo_Controller
{


    /**
     * This template variable will hold the 'view' portion of our MVC for this 
     * controller
     */
    public $template = 'photo';

    /**
     * This is the default function that will be called by router.php
     * 
     * @param array $getVars the GET variables posted to index.php
     */
    public function main()
    {
        $photoModel = new Photo_Model;
    	$view = new View_Model($this->template);
    	$view->assign('photos', $photoModel->wildphotos());
    	$view->assign('galleries', $photoModel->galleries());					
	

    }
}