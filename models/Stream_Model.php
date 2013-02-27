<?php
class Stream_Model {


	function link_parse($text) {
		preg_match_all('#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#', $text, $link);
		if ($link[0]) {
			return $link[0];
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

	function stream($subpage = false, $postpage = false, $postid = false, $singleuser = false) {
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
				'url' => $this->get_url($posts->getPostid()),
			);

		} else {
			if ($_POST['PID']) {
				$posts = StatusQuery::create()
				->filterByUserid($aFriends)
				->filterByBucketid($aBucket)
				->orderByPostid('desc')
				->filterByPostid($_POST['PID'], \Criteria::GREATER_THAN)
				->find();

			} else {
				if ($singleuser) {
					$posts = StatusQuery::create()
					->filterByUserid($singleuser)
					->filterByBucketid($aBucket)
					->filterByParentid('0')
					->orderByDate('desc')
					->paginate($stuff, $rowsPerPage = 50);
				} else {
					$posts = StatusQuery::create()
					->filterByUserid($aFriends)
					->filterByBucketid($aBucket)
					->filterByParentid('0')
					->orderByDate('desc')
					->paginate($stuff, $rowsPerPage = 50);
				}
			}


			foreach ($posts as $p) {
				$text = $p->getStatus();
				$text = strip_tags($text);
				//$text = $this->auto_link_text($text);
				$url = $this->link_parse($text);
				$text = preg_replace( '/(?!<\S)~(\w+\w)(?!\S)/i', '<a href="/profile/$1" target="_blank">~$1</a>', $text );
				$text = preg_replace("/^\n+|^[\t\s]*\n+/m", "", $text);
				$textinfo = nl2br($text);

				$datefrom = $p->getDate();
				$date = $this->ago($datefrom);


				$commentquery = StatusQuery::create()->filterByParentid($p->getPostid())->find();

				foreach ($commentquery as $comment) {
					$comdatefrom = $comment->getDate();
					$comdate = $this->ago($comdatefrom);
					$comments[] = array(
						'user' => UserQuery::create()->findPK($comment->getUserid()),
						'date' => $comdate,
						'content' => $comment->getStatus(),
					);
				}


				$votesquery = VotesQuery::create()->filterByPostID($p->getPostid())->find();
				foreach ($votesquery as $vote) {
					$votetally = $votetally+$vote->getValue();
					if (is_int($votetally)) {
						//kk
					} else {
						$votetally = 0;
					}
				}

				$parsedPost[] = array(
					'user' => UserQuery::create()->findPK($p->getUserid()),
					'date' => $date,
					'pid' => $p->getPostid(),
					'bucket' => $p->getBucketid(),
					'text' => $textinfo,
					'uid' => $p->getUserid(),
					'url' => $this->get_url($p->getPostid()),
					'parentid' => $p->getParentid(),
					'comments' => $comments,
					'votetally' => $votetally,
				);
				unset($votetally);
				unset($comments);
			}
		}
		return $parsedPost;
	}

	function post($contents) {
		$contents = strip_tags($contents);

		$urls = $this->link_parse($contents);
		if ($contents) {
			$post = new Status();
			$post->setUserid($_SESSION['uid']);
			$post->setBucketid('0');
			$post->setStatus($contents);
			$post->setDate(date("r"));
			if ($_POST['parentid']) {


				$post->setParentid($_POST['parentid']);
			} else {
				$post->setParentid('0');
			}
			$post->save();

			if ($_POST['parentid']) {
				$noti = new Notification();
				$noti->setUserid($post->getUserid());
				$noti->setTriggerid($_SESSION['uid']);
				$noti->setType('comment');
				$noti->setContent($contents);
				$noti->setRefid($post->getPostid());
				$noti->save();
			}

			if (is_array($urls)) {
				foreach ($urls as $url) {
					$urlid = $this->write_url($url);

					$post_url = new PostUrl();
					$post_url->setUrlid($urlid);
					$post_url->setPostid($post->getPostid());
					$post_url->save();
				}
			}

			preg_match_all("/(?!<\S)~(\w+\w)(?!\S)/i",  $contents, $usernames);
			foreach ($usernames[0] as $user) {
				$un = explode("~", $user);
				$poster = UserQuery::create()->filterByUsername($un[1])->findOne();
				if ($poster) {
					$noti = new Notification();
					$noti->setUserid($poster->getId());
					$noti->setTriggerid($_SESSION['uid']);
					$noti->setType('mention');
					$noti->setContent($contents);
					$noti->setRefid($post->getPostid());
					$noti->save();
				}

			}

		}


	}

	function write_url($url) {
		$url = parse_url($url);

		if ($url['query']) {
			$query = $url['query'];
		} else {
			$query = ' ';
		}

		$urlquery = UrlQuery::create()
		->filterByUrlhost($url['host'])
		->filterByUrlpath($url['path'])
		->filterByUrlquery($query)
		->findOne();

		$urldata = $this->urldata($url);

		// if ($urlquery) {
		//  return $urlquery->getUrlid();
		// } else {
		$urldb = new Url();
		$urldb->setUrlhost($url['host']);
		$urldb->setUrlpath($url['path']);
		$urldb->setUrlquery($url['query']);
		$urldb->setContenttype($urldata['type']);
		$urldb->setTitle($urldata['title']);
		//  $urldb->setContent($urldata['desc']);
		//  $urldb->setContentimg($urldata['image']);
		$urldb->save();

		return $urldb->getUrlid();
		//}

	}

	function get_url($postid) {
		$urlquery = PostUrlQuery::create()->findByPostid($postid);
		unset($urldata);
		foreach ($urlquery as $url) {
			$urldata[] = $url->getUrlid();
		}
		return $urldata;
	}

	function urldata($url) {
		$fullurl = "http://" . $url['host'] . $url['path'] . $url['query'];
		header('X-Frame-Options: GOFORIT');
		require_once 'OpenGraph.php';
		$graph = OpenGraph::fetch($fullurl);
		foreach ($graph as $key => $value) {
			$data[$key] = $value;
		}
		if ($data['title']) {
			$title = $data['title'];
			$type = $data['type'];
		} else {
			$twitter = get_meta_tags('http://imgur.com/gallery/mkt7y');
			var_dump($twitter);
			$title = $twitter['twitter:title'];
			$type = $twitter['twitter:card'];
		}

		$urldata = array(
			"title" => $title,
			"image" => $data['image'],
			"desc" => $data['description'],
			"type" => $type,
		);
		return $urldata;
	}

	function edit_post() {
		if ($_POST['edit']) {
			$post = StatusQuery::create()
			->filterByPostid($_POST['id'])
			->findOne();
			$post->setStatus($_POST['edit']);
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
		->filterByParentid('0')
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

			$originalpost = StatusQuery::create()->filterByPostid($commentcon['post'])->findOne();
			//$poster = UserQuery::create()->findPK();

		}
	}

	function upvote($data) {
		// First check to see if a user has voted on this particular post before
		$vote = VotesQuery::create()
		->filterByPostid($data['id'])
		->filterByUserid($_SESSION['uid'])
		->findOne();
		// if user has
		if ($vote) {
			echo "user has voted";
			// check to see if that vote was NOT an upvote, and if it wasn't, then reverse the vote.
			if ($vote->getValue() == -1) {
				$vote->setValue('1');
				$vote->save();
			}
		} else {
			echo "user has NOT voted";
			// make their vote count.
			$newvote = new Votes();
			$newvote->setPostid($data['id']);
			$newvote->setUserid($_SESSION['uid']);
			$newvote->setValue('1');
			$newvote->save();
		}
	}

	function downvote($data) {
		// First check to see if a user has voted on this particular post before
		$vote = VotesQuery::create()
		->filterByPostid($data['id'])
		->filterByUserid($_SESSION['uid'])
		->findOne();
		// if user has
		if ($vote) {
			echo "user has voted";
			// check to see if that vote was NOT a downvote, and if it wasn't, then reverse the vote.
			if ($vote->getValue() == 1) {
				$vote->setValue('-1');
				$vote->save();
			}
		} else {
			echo "user has NOT voted";
			// make their vote count.
			$newvote = new Votes();
			$newvote->setPostid($data['id']);
			$newvote->setUserid($_SESSION['uid']);
			$newvote->setValue('-1');
			$newvote->save();
		}
	}

	function urlinfo() {
		$url = $_POST['URL'];
		$urls = explode('-', $url);
		foreach ($urls as $urlid) {
			if ($urlid !== '') {
				$urldata = UrlQuery::create()->findOneByUrlid($urlid);
				$urlhost = $urldata->getUrlhost();
				$urlpath = $urldata->getUrlpath();
				$urlquery = $urldata->getUrlquery();
				$type = $urldata->getContenttype();
				$title = $urldata->getTitle();
				$content = $urldata->getContent();
				$img = $urldata->getContentimg();
				$fullurl = "http://" . $urlhost . $urlpath;
				switch ($urlhost) {
				case 'i.imgur.com':
					$image = explode('/', $urlpath);
					$newPost = "<img src='http://i.imgur.com/" . $image[1] . "' />";
					break;
				case 'imgur.com':
					$image = explode('/', $urlpath);
					$newPost = "<img src='http://i.imgur.com/" . $image[2] . ".png' />";
					break;
				case 'trikl.com':
					$image = explode('/', $urlpath);
					$newPost = "<img src='/public/photos/" . $image[2] . "' />";
					break;
				case 'www.youtube.com':
					$image = explode('=', $urlquery);
					$newPost .= "<iframe width='940' height='705' src='http://www.youtube.com/embed/" . $image['1'] . "' frameborder='0' allowfullscreen></iframe>";
					break;
				case 'vimeo.com':
					$newPost .= "<iframe src='http://player.vimeo.com/video" . $video['path'] . "?badge=0&amp;color=ffffff' width='520' height='315' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
				default:
					if ($img) {
						$newPost .= "<div class='tags'>";
						$newPost .= "<a href='" . $fullurl . "'>";
						$newPost .= "<img class='card_img' src='" . $img . "'/>";
						$newPost .= "<h4>" . $title . "</h4>";
						$newPost .= "<p>" . $content . "</p>";
						$newPost .= "<br />";
						$newPost .= "</a>";
						$newPost .= "</div>";
					}
				}

			}
			echo $newPost;
			unset($newPost);

		}

	}

	function auto_link_text($text) {
		$pattern  = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#';
		$callback = create_function('$matches', '$url = array_shift($matches); return $url;');
		$url = preg_replace_callback($pattern, $callback, $text);

		$urlinfo = parse_url($url);

		if ($urlinfo ['query']) {
			$query = $url['query'];
		} else {
			$query = ' ';
		}

		$urlquery = UrlQuery::create()
		->filterByUrlhost($urlinfo ['host'])
		->filterByUrlpath($urlinfo ['path'])
		->filterByUrlquery($query)
		->find();

		foreach ($urlquery as $urltitle) {
			$title = $urltitle->getTitle();
			return "<a target='_blank' href='" . $url . "'>" . $title . "</a>";

		}


	}
}
