<?php
$buckets = BucketQuery::create()->findByUserid($userid);

include 'views/post.tpl.php';

// on submit, insert post into database.
if ($_POST['post']) {
	$post = new Status();
	$post->setUserid($_SESSION['uid']);
	$post->setBucketid($_POST['bucketid']);
	$post->setStatus($_POST['post']);
	$post->save();
}
?>
	        			