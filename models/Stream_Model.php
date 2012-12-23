<?php
class Stream_Model {
	function auto_link_text($text) {
		$pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
		$callback = create_function('$matches', '
		$url       = array_shift($matches);
		$url_parts = parse_url($url);

		$text = parse_url($url, PHP_URL_HOST) . parse_url($url, PHP_URL_PATH);
		$text = preg_replace("/^www./", "", $text);

		$last = -(strlen(strrchr($text, "/"))) + 1;
		if ($last < 0) {
   	        $text = substr($text, 0, $last) . "&hellip;";
       }

       	return sprintf(\'<a rel="nofollow" href="%s">%s</a>\', $url, $text);
 	      ');

		return preg_replace_callback($pattern, $callback, $text);
	}


	function link_parse($text) {
		preg_match('#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#', $text, $link);
		if ($link['0']) {
			return $link['0'];
		}

	}


	function ago($datefrom, $dateto=-1) {
		// Defaults and assume if 0 is passed in that
		// its an error rather than the epoch

		if ($datefrom==0) { return "A long time ago"; }
		if ($dateto==-1) { $dateto = time(); }

		// Make the entered date into Unix timestamp from MySQL datetime field

		$datefrom = strtotime($datefrom);

		// Calculate the difference in seconds betweeen
		// the two timestamps

		$difference = $dateto - $datefrom;

		// Based on the interval, determine the
		// number of units between the two dates
		// From this point on, you would be hard
		// pushed telling the difference between
		// this function and DateDiff. If the $datediff
		// returned is 1, be sure to return the singular
		// of the unit, e.g. 'day' rather 'days'

		switch (true) {
			// If difference is less than 60 seconds,
			// seconds is a good interval of choice
		case(strtotime('-1 min', $dateto) < $datefrom):
			$datediff = $difference;
			$res = ($datediff==1) ? $datediff.' Now' : $datediff.'s';
			break;
			// If difference is between 60 seconds and
			// 60 minutes, minutes is a good interval
		case(strtotime('-1 hour', $dateto) < $datefrom):
			$datediff = floor($difference / 60);
			$res = ($datediff==1) ? $datediff.'m' : $datediff.'m';
			break;
			// If difference is between 1 hour and 24 hours
			// hours is a good interval
		case(strtotime('-1 day', $dateto) < $datefrom):
			$datediff = floor($difference / 60 / 60);
			$res = ($datediff==1) ? $datediff.'h' : $datediff.'h';
			break;
			// If difference is between 1 day and 7 days
			// days is a good interval
		case(strtotime('-1 week', $dateto) < $datefrom):
			$day_difference = 1;
			while (strtotime('-'.$day_difference.' day', $dateto) >= $datefrom) {
				$day_difference++;
			}

			$datediff = $day_difference;
			$res = ($datediff==1) ? 'yesterday' : $datediff.' days ago';
			break;
			// If difference is between 1 week and 30 days
			// weeks is a good interval
		case(strtotime('-1 month', $dateto) < $datefrom):
			$week_difference = 1;
			while (strtotime('-'.$week_difference.' week', $dateto) >= $datefrom) {
				$week_difference++;
			}

			$datediff = $week_difference;
			$res = ($datediff==1) ? 'last week' : $datediff.' weeks ago';
			break;
			// If difference is between 30 days and 365 days
			// months is a good interval, again, the same thing
			// applies, if the 29th February happens to exist
			// between your 2 dates, the function will return
			// the 'incorrect' value for a day
		case(strtotime('-1 year', $dateto) < $datefrom):
			$months_difference = 1;
			while (strtotime('-'.$months_difference.' month', $dateto) >= $datefrom) {
				$months_difference++;
			}

			$datediff = $months_difference;
			$res = ($datediff==1) ? $datediff.' month ago' : $datediff.' months ago';

			break;
			// If difference is greater than or equal to 365
			// days, return year. This will be incorrect if
			// for example, you call the function on the 28th April
			// 2008 passing in 29th April 2007. It will return
			// 1 year ago when in actual fact (yawn!) not quite
			// a year has gone by
		case(strtotime('-1 year', $dateto) >= $datefrom):
			$year_difference = 1;
			while (strtotime('-'.$year_difference.' year', $dateto) >= $datefrom) {
				$year_difference++;
			}

			$datediff = $year_difference;
			$res = ($datediff==1) ? $datediff.' year ago' : $datediff.' years ago';
			break;

		}
		return $res;
	}


	function stream($subpage, $postpage, $postid) {
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

		$stuff = $postpage;

		if ($subpage) {
			$posts = StatusQuery::create()
			->filterByPostid($subpage)
			->findOne();

			$text = $posts->getStatus();
			$text = $this->auto_link_text($text);
			$url = $this->link_parse($text);
			$text = preg_replace( '/(?!<\S)~(\w+\w)(?!\S)/i', '<a href="/profile/$1" target="_blank">~$1</a>', $text );
			$text = preg_replace("/^\n+|^[\t\s]*\n+/m", "", $text);
			$text = nl2br($text);
			$datefrom = $posts->getDate();
			$date = $this->ago($datefrom);

			$parsedPost = array(
				'user' => UserQuery::create()->findPK($posts->getUserid()),
				'date' => $date,
				'pid' => $posts->getPostid(),
				'bucket' => $posts->getBucketid(),
				'text' => $text,
				'uid' => $posts->getUserid(),
				'url' => $url,
			);

		} else {

			if ($postid) {
				$posts = StatusQuery::create()
				->filterByUserid($aFriends)
				->filterByBucketid($aBucket)
				->orderByPostid('desc')
				->filterByPostid($postid, \Criteria::GREATER_THAN)
				->find();

			} else {
				$posts = StatusQuery::create()
				->filterByUserid($aFriends)
				->filterByBucketid($aBucket)
				->orderByDate('desc')
				->paginate($stuff, $rowsPerPage = 50);
			}


			foreach ($posts as $p) {
				$text = $p->getStatus();
				$text = strip_tags($text);
				$text = $this->auto_link_text($text);
				$url = $this->link_parse($text);
				$text = preg_replace( '/(?!<\S)~(\w+\w)(?!\S)/i', '<a href="/profile/$1" target="_blank">~$1</a>', $text );
				$text = preg_replace("/^\n+|^[\t\s]*\n+/m", "", $text);
				$text = nl2br($text);



				$datefrom = $p->getDate();
				$date = $this->ago($datefrom);
				$commentquery = CommentsQuery::create()->filterByPostID($p->getPostid())->find();

				foreach ($commentquery as $comment) {
					$comdatefrom = $comment->getDate();
					$comdate = $this->ago($comdatefrom);
					$comments[] = array(
						'user' => UserQuery::create()->findPK($comment->getUserid()),
						'date' => $comdate,
						'content' => $comment->getContent(),
						'tier' => $comment->getTier(),
					);
				}

				$parsedPost[] = array(
					'user' => UserQuery::create()->findPK($p->getUserid()),
					'date' => $date,
					'pid' => $p->getPostid(),
					'bucket' => $p->getBucketid(),
					'text' => $text,
					'uid' => $p->getUserid(),
					'url' => $url,
					'comments' => $comments,
				);

				unset($comments);
			}
		}
		return $parsedPost;
	}


	function post($contents) {
		$contents = strip_tags($contents);
		if ($contents) {
			$post = new Status();
			$post->setUserid($_SESSION['uid']);
			$post->setBucketid('0');
			$post->setStatus(strip_tags($contents));
			$post->setDate(date("r"));
			$post->save();
		}
	}


	function updates($lastpost) {
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
		->filterByPostid($lastpost, \Criteria::GREATER_THAN)
		->count();

		echo $posts;
	}


	function comment($commentcon) {
		$commentcon['comment'] = strip_tags($commentcon['comment']);
		if ($commentcon['comment']) {
			$comment = new Comments();
			$comment->setPostID($commentcon['post']);
			$comment->setUserID($_SESSION['uid']);
			$comment->setTier('0');
			$comment->setContent($commentcon['comment']);
			$comment->setDate(date("r"));
			$comment->save();
		}

		echo "saved!";
	}


	function geturl($url) {
		switch ($url['host']) {
		case 'imgur.com':
			$image = explode('/', $url['path']);
			$newPost .= "<img width='520' src='http://i.imgur.com/" . $image[2] . ".png' />";
			break;
		case 'trikl.com':
			$image = explode('/', $url['path']);
			$newPost .= "<img width='520' src='/public/photos/" . $image[2] . "' />";
			break;
		default:
			header('X-Frame-Options: GOFORIT');
			require_once 'OpenGraph.php';
			$graph = OpenGraph::fetch($_POST['URL']);
			foreach ($graph as $key => $value) {
				$data[$key] = $value;
			}
			switch ($data['type']) {
			case  'video':
				$video = parse_url($data['url']);
				switch ($video['host']) {
				case 'www.youtube.com':
					parse_str($video['query'], $string);
					$newPost .= "<iframe width='520' height='315' src='http://www.youtube.com/embed/" . $string[v] . "' frameborder='0' allowfullscreen></iframe>";
					break;
				case 'vimeo.com':
					$newPost .= "<iframe src='http://player.vimeo.com/video" . $video['path'] . "?badge=0&amp;color=ffffff' width='520' height='315' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
				}
				break;
				break;
			default:
				if ($data['image']) {
					$newPost .= "<div class='tags'>";
					$newPost .= "<a href='" . $data['url'] . "'>";
					$newPost .= "<img class='card_img' src='" . $data['image'] . "'/>";
					$newPost .= "<h4>" . $data['title'] . "</h4>";
					$newPost .= "<p>" . $data['description'] . "</p>";
					$newPost .= "<br />";
					$newPost .= "</a>";
					$newPost .= "</div>";
				}
			}

		}
		echo json_encode($newPost, JSON_FORCE_OBJECT);
	}


}