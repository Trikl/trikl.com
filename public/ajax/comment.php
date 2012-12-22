<?php
	include 'include.php';

    
    $UID = $_SESSION['uid'];
    	
		$comment = new Comments();
		$comment->setPostID($_POST['post']);
		$comment->setUserID($UID);
		$comment->setTier('0');
		$comment->setContent($_POST['comment']);
		$comment->setDate(date("r"));
		$comment->save();
?>