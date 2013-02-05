<?php

class Messages_Controller
{
	/**
	 * This template variable will hold the 'view' portion of our MVC for this
	 * controller
	 */
	public $template = 'messages';

	/**
	 * This is the default function that will be called by router.php
	 *
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main()
	{
			$messagesModel = new Messages_Model;
			
			switch($_POST['action']) {
			case 'createmessage':
				$discard = 1;
				$messagesModel->createmessage();				
				break;
			case 'replymessage':
				$messagesModel->replymessage($data);
				break;
			default:
				$view = new View_Model($this->template);
				$view->assign('list', $messagesModel->messagelist());
				$view->assign('contents', $messagesModel->messagecontents());
				break;
			}

	}
}
