<?php

	include 'include.php';
	
	if ($_POST['post']) {
		$post = new Status();
		$post->setUserid($UID);
		$post->setBucketid('0');
		$post->setStatus($_POST['post']);
		$post->setDate(date("r"));
		$post->save();
	}
?>