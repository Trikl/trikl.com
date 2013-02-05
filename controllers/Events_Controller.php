<?php

class Events_Controller
{
	/**
	 * This template variable will hold the 'view' portion of our MVC for this
	 * controller
	 */
	public $template = 'events';

	/**
	 * This is the default function that will be called by router.php
	 *
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main()
	{
			$eventsModel = new Events_Model;
			$view = new View_Model($this->template);
			//$view->assign('status', $eventsModel->stream());
	}
}
