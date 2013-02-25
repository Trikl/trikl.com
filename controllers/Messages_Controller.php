<?php

class Messages_Controller
{
	/**
	 * This template variable will hold the 'view' portion of our MVC for this
	 * controller
	 */
	public $template = 'allmessages';

	/**
	 * This is the default function that will be called by router.php
	 *
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main()
	{
			$messagesModel = new Messages_Model;
			$params = explode( "/", $_GET['p'] );
			$page = $params['0'];
			$subpage = $params['1'];
			if ($subpage) {
				$page = 'singlemessage';
				$view = new View_Model($page);
				$view->assign('contents', $messagesModel->messagecontents());
				$view->assign('title', $messagesModel->messagetitle());
			} else {
				$view = new View_Model($this->template);
				$view->assign('list', $messagesModel->messagelist());
			}

	
	}
}
