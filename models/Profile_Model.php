<?php
class Profile_Model
{
	// Get general settings info and return to page
	function profile() {
		$params = explode( "/", $_GET['p'] );
		$page = $params['0'];
		$subpage = $params['1'];

		if ($subpage) {
			$user = UserQuery::create()->findOneByUsername(strtolower($subpage));
		} else {
			$user = UserQuery::create()->findPK($_SESSION['uid']);
		}

		if ($user) {
			$profile = ProfileQuery::create()->findPK($user->getId());
			$nbFriends = FriendQuery::create()->filterByUserid($user->getId())->count($con);

			if ($userid != $user->getId() && $userid && $user->getId()) {
				$friends = FriendQuery::create()
				->filterByUserid($_SESSION['uid'])
				->filterByFriendid($user->getId())
				->findOne();

				if ($friends) {
					$bucket = FriendBucketQuery::create()
					->filterByUserid($friends->getUserid())
					->findOne();
				}
			}
			if ($nbFriends > 0) {
				$friendslist = FriendQuery::create()
				->filterByUserid($user->getId())
				->find();

				// Load friends Userid's into array, include logged in user.
				foreach ($friendslist as $friendlist) {
					$friendid = $friendlist->getFriendid();
					$groupid = $friendlist->getGroupid();
					$aFriends[$groupid] = $friendid;
				}

				foreach ($aFriends as $aFriend) {
					$myfriend = UserQuery::create()
					->findPK($aFriend);

					$friendList[] = array (
						"username" => $myfriend->getUsername(),
						"firstname" => $myfriend->getFirstname(),
						"lastname" => $myfriend->getLastname(),
					);
				}
			}
			$notfound = 1;
		}

		if ($_SESSION['uid']) {
			if (is_array($user)) {
				if ($user->getId() !== $_SESSION['uid']) {
					$requestinmotion = RequestsQuery::create()->filterByUserid($_SESSION['uid'])->filterByFriendid($user->getId())->findOne();
					if (!$requestinmotion) {
						$showfriend = 1;
					} else {
						$showfriend = NULL;
					}
				}
			}
		}
		$info = array (
			"user" => $user,
			"profile" => $profile,
			"friendlist" => $friendList,
			"showfriend" => $showfriend,
			"notfound" => $notfound,
		);
		return $info;
	}
	function friendme() {
		$params = explode( "/", $_GET['p'] );
		$page = $params['0'];
		$subpage = $params['1'];
		$user = UserQuery::create()->findOneByUsername(strtolower($subpage));
		$request = new Requests();
		$request->setUserid($_SESSION['uid']);
		$request->setFriendid($user->getId());
		$request->save();
		echo "You have friended this fool";
	}
}
