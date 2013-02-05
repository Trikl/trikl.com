<?php
class Messages_Model {
	function messagelist() {
		$messageid = UserMessageQuery::create()->filterbyUserID($_SESSION['uid'])->find();
		foreach ($messageid as $mesid) {
			$infos = UserMessageQuery::create()->filterbyMessageID($mesid->getMessageID())->find();
			foreach ($infos as $userid) {
				$userinfo = UserQuery::create()->findPK($userid->getUserID());
				$userinfos[] = $userinfo;
			}
			$messagethread = MessagesQuery::create()->filterbyMessageID($mesid->getMessageID())->find();
			foreach ($messagethread as $thread) {
				$threads[] = array(
					'thread' => $thread,
					'userinfo' => $userinfos,
				);
				unset($userinfos);

			}
		}
		return $threads;

	}


	function messagecontents() {
		$params = explode( "/", $_GET['p'] );
		$subpage = $params['1'];
		if ($subpage) {
			$messageid = UserMessageQuery::create()->filterbyMessageID($subpage)->filterbyUserID($_SESSION['uid'])->findOne();
			if ($messageid) {
				$msgcontents = MessageContentsQuery::create()->filterbyMessageID($subpage)->find();
				foreach ($msgcontents as $userid) {
					$usermsg = UserQuery::create()->findPK($userid->getUserID());
					$usrmsg[] = $usermsg;
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


	function replymessage($stuff) {
		$params = explode( "/", $_GET['p'] );
		$subpage = $params['1'];

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