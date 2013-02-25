<?php
class Global_Model {
	function notifications() {
		$requests = RequestsQuery::create()->findByFriendid($_SESSION['uid']);
		$requestscount = RequestsQuery::create()->findByFriendid($_SESSION['uid'])->count();
		$reqarray = array(
			'requests' => $requests,
			'count' => $requestscount,
		);
		return $reqarray;
	}
	
	function acceptfriend() {
		$friend = new Friend();
		$friend->setUserid($_POST['friendid']);
		$friend->setFriendid($_SESSION['uid']);
		$friend->save();

		$friend = new Friend();
		$friend->setUserid($_SESSION['uid']);
		$friend->setFriendid($_POST['friendid']);
		$friend->save();

		$request = RequestsQuery::create()->findOneByRequestid($_POST['request']);
		$request->delete();

		echo "You have friended this fool";
	}

	function messagelist() {
		$messageid = UserMessageQuery::create()->filterbyUserID($_SESSION['uid'])->find();

		foreach ($messageid as $id => $k) {
			$thatthing = $k->getMessageid();
			$messagearchive = MessageArchiveQuery::create()->filterbyUserID($_SESSION['uid'])->filterbyMessageId($thatthing)->findOne();
			$msgstuff = MessageContentsQuery::create()->filterbyMessageID($thatthing)->orderByThreadID('desc')->findOne();
			if ($messagearchive == NULL) {
					$info[] = $k->getMessageid();
				} else { 
					if ($messagearchive->getThreadId() < $msgstuff->getThreadID()) {
						$info[] = $k->getMessageid();
					}
				}
		}
		if (is_array($info)) {
		foreach ($info as $messs) {
			$messagethread = MessagesQuery::create()->filterbyMessageID($messs)->findOne();
			$msgall = MessageContentsQuery::create()->filterbyMessageID($messs)->orderByDate('desc')->findOne();
			$msgusers = UserMessageQuery::create()->filterbyMessageID($messs)->find();
			$count = count($info);
			
			foreach ($msgusers as $users) {
				$user[] = UserQuery::create()->findPK($users->getUserID());
			}
			$messagecontents[] = array(
				'thread' => $messagethread,
				'contents' => $msgall,
				'users' => $user,
				'count' => $count,
			);
			unset($user);
		}
		}
		return $messagecontents;
	}
	
	function replymessage() {
		if ($_POST['content']) {
			$content = new MessageContents();
			$content->setMessageID($_POST['messageid']);
			$content->setUserID($_SESSION['uid']);
			$content->setContent($_POST['content']);
			$content->setDate(date('r'));
			$content->save();
		}
	}
	
	function archivemessage() {
		$msgall = MessageContentsQuery::create()->filterbyMessageID($_POST['messageid'])->orderByDate('desc')->findOne();
		$archive = MessageArchiveQuery::create()->filterbyMessageID($_POST['messageid'])->findOne();
		if ($archive == NULL) {
			$archive = new MessageArchive();
		}
		$archive->setMessageId($_POST['messageid']);
		$archive->setThreadId($msgall->getThreadId());
		$archive->setUserId($_SESSION['uid']);
		$archive->save();
	}
	
	function createmessage() {
		$message = new Messages();
		$message->setDate(date('r'));
		$message->setSubject($_POST['subject']);
		$message->save();

		$messageid = $message->getMessageID();

		$user = new UserMessage();
		$user->setMessageID($messageid);
		$user->setUserID($_POST['to']);
		$user->save();

		if ($_POST['to'] !== $_SESSION['uid']) {
			$me = new UserMessage();
			$me->setMessageID($messageid);
			$me->setUserID($_SESSION['uid']);
			$me->save();
		}


		$content = new MessageContents();
		$content->setMessageID($messageid);
		$content->setUserID($_SESSION['uid']);
		$content->setContent($_POST['content']);
		$content->setDate(date('r'));
		$content->save();
	}
}


