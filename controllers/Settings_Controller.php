<?php

class Settings_Controller
{


    /**
     * This template variable will hold the 'view' portion of our MVC for this 
     * controller
     */
    public $template = 'settings';

    /**
     * This is the default function that will be called by router.php
     * 
     * @param array $getVars the GET variables posted to index.php
     */
    public function main()
    {
        $settingsModel = new Settings_Model;
        			$discard = 1;
    	$view = new View_Model($this->template, $discard);
		
        $view->assign('settings', $settingsModel->settings());					

		$profile = $settingsModel->settings();
		
        if ($_POST['profile']) {
	        if ($profile['profile']) {
		        $settingsModel->saveProfile();
	        } else {
		        $settingsModel->createProfile();
	        }
	    }

		if ($_POST['banner']) {
		    $settingsModel->banner();
		}
		if ($_POST['create_bucket']) {
		    $settingsModel->createBucket();
		}
		if ($_POST['delete_bucket']) {
		    $settingsModel->deleteBucket();
		}
		if ($_POST['assign_bucket']) {
		    $settingsModel->assignBucket();
		}
		if ($_POST['submit_privacy']) {
		    $settingsModel->privacy();
		}

    }
}