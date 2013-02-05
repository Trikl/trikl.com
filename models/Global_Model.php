<?php
class Global_Model {
	function notifications() {
		$requests = RequestsQuery::create()->findByFriendid($_SESSION['uid']);
			return $requests;
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
}