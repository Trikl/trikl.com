<?php

class Stream_Controller
{
	/**
	 * This template variable will hold the 'view' portion of our MVC for this
	 * controller
	 */
	public $template = 'stream';

	/**
	 * This is the default function that will be called by router.php
	 *
	 * @param array $getVars the GET variables posted to index.php
	 */
	public function main()
	{
			$streamModel = new Stream_Model;

		switch($_POST['action']) {
		case 'new':
			$discard = 1;
			$page = 'postpage';
			$view = new View_Model($page, $discard);
			$view->assign('status', $streamModel->stream(NULL, NULL, $_POST['pid']));
			break;
		case 'more':
			$discard = 1;
			$page = 'postpage';
			$view = new View_Model($page, $discard);
			$view->assign('status', $streamModel->stream(NULL, $_POST['page']));
			break;
		case 'createpost':
			$streamModel->post($_POST['post']);
			break;
		case 'updates':
			$streamModel->updates($_POST['PID']);
			break;
		case 'comment':
			$streamModel->comment($_POST);
			break;
		case 'geturl':
			$streamModel->urlinfo($_POST['URL']);
			break;
		case 'loadedit':
			$discard = 1;
			$page = 'postedit';
			$view = new View_Model($page, $discard);
			$view->assign('status', $streamModel->stream($_POST['id']));
			break;
		case 'editpost':
			$streamModel->edit_post($_POST['post']);
			break;
		case 'upvote':
			$streamModel->upvote($_POST);
			break;
		case 'downvote':
			$streamModel->downvote($_POST);
			break;
		default:
			$view = new View_Model($this->template);
			$view->assign('status', $streamModel->stream());
			break;
		}

	}
}
