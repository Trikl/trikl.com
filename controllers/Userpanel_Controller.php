<?php

class Userpanel_Controller
{

	public $template = 'userpanel';

    /**
     * This is the default function that will be called by router.php
     * 
     * @param array $getVars the GET variables posted to index.php
     */
    public function main()
    {
        $userpanelModel = new Userpanel_Model;
	    $view = new View_Model($this->template);
	    $view->assign('userpanel', $userpanelModel->userpanel());					

	    if ($_POST['submit']) {
		    $userpanelModel->acceptfriend();
		}
    }
}
