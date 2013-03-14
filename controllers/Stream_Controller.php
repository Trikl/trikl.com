<?php

class Stream_Controller
{
	public function main()
	{
		$streamModel = new Stream_Model;
		switch($_POST['action']) {
		case 'new':
			$view = new View_Model('postpage', 1);
			$view->assign('status', $streamModel->stream(NULL, 'new', NULL, $_POST['PID'], NULL));
			break;
		case 'newcomment':
			$discard = 1;
			$view = new View_Model('comments', $discard);
			$view->assign('comments', $streamModel->newcomments());
			break;
		case 'more':
			$view = new View_Model('postpage', 1);
			$view->assign('status', $streamModel->stream(NULL, $_POST['page']));
			break;
		case 'createpost':
			$streamModel->post($_POST['post']);
			break;
		case 'updates':
			$streamModel->updates($_POST['PID']);
			break;
		case 'geturl':
			$streamModel->urlinfo($_POST['URL']);
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
		case 'deletepost':
			$streamModel->delete_post($_POST['post']);
			break;
		case 'endresponses':
			$view = new View_Model('postpage', 1);
			$view->assign('status', $streamModel->stream($_POST['id'], 'endresponses'));
			break;	
		case 'beginresponses':
			$view = new View_Model('postpage', 1);
			$view->assign('status', $streamModel->stream($_POST['id'], 'beginresponses'));
			break;			
		default:
			$view = new View_Model('stream');
			$view->assign('status', $streamModel->stream());
			break;
		}

	}
}
