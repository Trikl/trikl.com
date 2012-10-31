Friend Request's<br /><br />
<?php foreach($data['userpanel'] as $request) {
	    	$me = $request->getFriendid();
	    	$requestid = $request->getRequestid();
	    	$friendid = $request->getUserid();
	    	$user = UserQuery::create()->findPK($friendid);

	    	echo $user->getUsername(); ?>
	    	<form method="post" action="">
		    	<input type="Submit" name="submit" value="Friend Me!">
		    	<input type="hidden" name="request" value="<?php echo $requestid; ?>">
		    	<input type="hidden" name="friendid" value="<?php echo $friendid; ?>">
		    </form>
		    <br />

<?php } ?>


