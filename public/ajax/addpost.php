<?php 
		include 'include.php';

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
			->filterByPostid($_POST['PID'], \Criteria::GREATER_THAN)
			->find();
			
				foreach ($posts as $post) {
					$user = UserQuery::create()->findPK($post->getUserid());
					$text = $post->getStatus();
					$text = preg_replace('"\b(http://\S+)"', '<a href="$1">$1</a>', $text);
					$text = preg_replace( '/(?!<\S)~(\w+\w)(?!\S)/i', '<a href="/profile/$1" target="_blank">~$1</a>', $text );
					$newPost .= "<div class='post'>";
					$newPost .= "<img class='usr_img' src='public/avatars/" . $user->getAvatarFilename() . "'/>";
					$newPost .= "<a href='profile/" . $user->getUsername() . "'>" . $user->getFirstName(). " " . $user->getLastName() . "</a>";
					$newPost .= "<span class='date'>" . $post['date'] . "</span>";
					$newPost .= "<p>" . $text . "</p>";
					$newPost .= "<br />";
					$newPost .= "</div>";
					$TEMPPID = $post->getPostid();
					if ($TEMPPID > $PID) {
						$PID = $TEMPPID;
					}
			}
			
			$updates = array(
				'first' => $newPost,
				'last' => $PID,
				);
			
			echo json_encode($updates,JSON_FORCE_OBJECT);