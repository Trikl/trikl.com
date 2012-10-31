<?php
class Stream_Model
{
	function stream() {
		$friends = FriendQuery::create()->findByUserid($_SESSION['uid']);

		// Load friends Userid's into array, include logged in user.
		$aFriends[0] = $_SESSION['uid'];
		foreach ($friends as $friend) {
			$friendid = $friend->getFriendid();
			$groupid = $friend->getGroupid();
			$aFriends[$groupid] = $friendid;
		}
				
		$buckets = FriendBucketQuery::create()
			->filterByUserid($_SESSION['uid'])
			->find();
		
		$aBucket[0] = "0";
		foreach ($buckets as $bucket) {
			$bucketid = $bucket->getBucketid();
			$aBucket[$bucketid] = $bucketid;
		}
		
		$posts = StatusQuery::create()
			->filterByUserid($aFriends)
			->filterByBucketid($aBucket)
			->orderByPostid('desc')
			->find();
			
		return $posts;
	}
}