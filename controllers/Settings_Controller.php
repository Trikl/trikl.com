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
		switch($_POST['action']) {
		case 'createsettings':
			$settingsModel->createProfile();
			break;
		case 'updatesettings':
			$settingsModel->saveProfile();
			break;
		case 'changeprivacy':
			$settingsModel->privacy();
			break;
		default:
			$discard = 1;
			$view = new View_Model($this->template, $discard);
			$view->assign('settings', $settingsModel->settings());
			$profile = $settingsModel->settings();
			break;
		}

	}
}