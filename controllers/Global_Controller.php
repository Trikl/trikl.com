<?php

class Global_Controller
{
	// This Controller handles events that can take place at any part of the site.
	// This was done to mitigate confusing things (like the call to photos from the stream)
	// The primary function of this is to handle the right sidebar contents via ajax calls.
	// There is no "view" for this controller, it simply handles ajax calls.
    public function main()
    {
    	$globalModel = new Global_Model;
	    switch($_POST['action']) {
	    case 'getNotifications':
			$discard = 1;
			$page = 'friendrequests';
			$view = new View_Model($page, $discard);
			$view->assign('userpanel', $globalModel->notifications());
			break;
		case 'acceptfriend':
			$globalModel->acceptfriend();
			break;
		case 'createmessage':
			$globalModel->createmessage();				
			break;
		case 'replymessage':
			$globalModel->replymessage();
			break;
		case 'archivemessage':
			$globalModel->archivemessage();
			break;
		case 'generalNotifications':
			$discard = 1;
			$page = 'globalnotes';
			$view = new View_Model($page, $discard);
			$view->assign('global', $globalModel->getNotifications());
			break;
		case 'clearnotification':
			$globalModel->clearnotification();
			break;
		case 'pinpost':
			$globalModel->pinpost();
			break;
		case 'getMessages':
			$discard = 1;
			$page = 'messages';
			$view = new View_Model($page, $discard);
			$view->assign('list', $globalModel->messagelist());
			break;
	    }
    }
}