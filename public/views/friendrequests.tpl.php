<?php foreach($data['userpanel'] as $request) {
	    	$me = $request->getFriendid();
	    	$requestid = $request->getRequestid();
	    	$friendid = $request->getUserid();
	    	$user = UserQuery::create()->findPK($friendid);

	    	echo "<div class='notification'>";
	    	echo "<img width=50 height=50 src='/public/avatars/" . $user->getAvatarFileName() . "' />";
	    	?>
	    	<div class='notification_action'>
	    	<h3><?php echo $user->getFirstName() . ' ' .  $user->getLastName(); ?></h3>
		    	<input style="display:inline-block;margin: 0;vertical-align: middle;height: 30px;margin-top: -40px;" type="Submit" name="submit" value="Friend Me!">
		    	<input type="hidden" name="request" value="<?php echo $requestid; ?>">
		    	<input style="display:inline-block;float:right;" type="hidden" name="friendid" value="<?php echo $friendid; ?>">
		    </div>
	    			    </div>
		<hr />	    			    
	    			    <?php
	    	echo "<div class='notification'>";
	    	echo "<img width=50 height=50 src='/public/avatars/" . $user->getAvatarFileName() . "' />";
	    	?>
	    	<div class='notification_action'>
	    	<h3><?php echo $user->getFirstName() . ' ' .  $user->getLastName(); ?></h3>

		    	<input style="display:inline-block;margin: 0;vertical-align: middle;height: 30px;margin-top: -40px;" type="Submit" name="submit" value="Friend Me!">
		    	<input type="hidden" name="request" value="<?php echo $requestid; ?>">
		    	<input style="display:inline-block;" type="hidden" name="friendid" value="<?php echo $friendid; ?>">
		    </div>
	    			    </div>
	    			    
<?php } ?>
