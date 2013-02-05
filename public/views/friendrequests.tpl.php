<?php foreach($data['userpanel'] as $request) {
	    	$me = $request->getFriendid();
	    	$requestid = $request->getRequestid();
	    	$friendid = $request->getUserid();
	    	$user = UserQuery::create()->findPK($friendid);
	    	
	    	echo "<div class='notification'>";
	    	echo "<img width=80 height=80 src='/public/avatars/" . $user->getAvatarFileName() . "' />";
	    	?>
	    	<div class='notification_action'>
	    	<h3 style='margin:0;'><?php echo $user->getFirstName() . $user->getLastName(); ?></h3>

	    	<form method="post" action="">
		    	<input type="Submit" name="submit" value="Friend Me!">
		    	<input type="hidden" name="request" value="<?php echo $requestid; ?>">
		    	<input style="display:inline-block;float:right;" type="hidden" name="friendid" value="<?php echo $friendid; ?>">
		    </form>
		    </div>
	    			    </div>
<?php } ?>

<script>
	$('.notification').hover(function() {
		$('.notification_action').show()
	}, function() {
		$('.notification_action').hide();
	});
</script>
