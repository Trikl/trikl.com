<?php

class Global_Controller
{
	// This Controller handles events that can take place at any part of the site.
	// This was done to mitigate confusing things (like the call to photos from the stream)
	// The primary function of this is to handle the right sidebar contents via ajax calls.
	// There is no "view" for this controller, it simply handles ajax calls.
    public function main()
    {
	    switch($_POST['action']) {
	    case 'getNotifications':
			$discard = 1;
			$page = 'friendrequests';
			$view = new View_Model($page, $discard);
			$globalModel = new Global_Model;
			$view->assign('userpanel', $globalModel->notifications());
			break;
		case 'acceptfriend':
			$globalModel = new Global_Model;
			$globalModel->acceptfriend();
			break;
		case 'createmessage':
			$messagesModel = new Global_Model;
			$messagesModel->createmessage();				
			break;
		case 'replymessage':
		//	var_dump($_POST);
			$messagesModel = new Global_Model;
			$messagesModel->replymessage();
			break;
	    case 'getMessages':
			$discard = 1;
			$page = 'messages';
			$view = new View_Model($page, $discard);
			$messagesModel = new Global_Model;
			$view->assign('list', $messagesModel->messagelist());
			break;
	    }
    }
}