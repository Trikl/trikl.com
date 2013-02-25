<?php
class Messages_Model {
	function messagelist() {
		$messageid = UserMessageQuery::create()->filterbyUserID($_SESSION['uid'])->find();
		foreach ($messageid as $id => $k) {
			$info[] = $k->getMessageid();
		}
		foreach ($info as $messs) {
			$messagethread = MessagesQuery::create()->filterbyMessageID($messs)->orderByDate('desc')->findOne();
			$msgall = MessageContentsQuery::create()->filterbyMessageID($messs)->orderByDate('desc')->findOne();
			$msgusers = UserMessageQuery::create()->filterbyMessageID($messs)->find();
			foreach ($msgusers as $users) {
				$user[] = UserQuery::create()->findPK($users->getUserID());
			}
			$messagecontents[] = array(
				'thread' => $messagethread,
				'contents' => $msgall,
				'users' => $user,
			);
			unset($user);
		}
		return $messagecontents;
	}

	function messagecontents() {
		$params = explode( "/", $_GET['p'] );
		$subpage = $params['1'];
		if ($subpage) {
			$messageid = UserMessageQuery::create()->filterbyMessageID($subpage)->filterbyUserID($_SESSION['uid'])->findOne();
			if ($messageid) {
				$msgcontents = MessageContentsQuery::create()->filterbyMessageID($subpage)->find();
				foreach ($msgcontents as $userid) {
					$usermsg = UserQuery::create()->filterbyId($userid->getUserID())->findOne();
					$usrmsg = $usermsg;
					$messagereturn[] = array(
						'msgcontents' => $userid,
						'usrinfo' => $usrmsg,
					);
					unset($usrmsg);
				}
				return $messagereturn;
			}
		}
	}

	function messagetitle() {
		$params = explode( "/", $_GET['p'] );
		$subpage = $params['1'];
		$messagethread = MessagesQuery::create()->filterbyMessageID($subpage)->findOne();
		return $messagethread;
	}

	function replymessage($stuff) {
		if ($_POST['content']) {
			$content = new MessageContents();
			$content->setMessageID($subpage);
			$content->setUserID($_SESSION['uid']);
			$content->setContent($_POST['content']);
			$content->setDate(date('r'));
			$content->save();
		}
	}


}