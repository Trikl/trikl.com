<?php $info = $data['userpanel']; 
	if ($info['count'] > 0) {
	
	
?>
		            	<div class="tinyavatars">


<?php 
	foreach($info['requests'] as $request) {
		$me = $request->getFriendid();
		$requestid = $request->getRequestid();
		$friendid = $request->getUserid();
		$user = UserQuery::create()->findPK($friendid);
?>

			            	<img class="tinyava" height="40" width="40" src="/public/photos/<?php echo $user->getAvatarFilename(); ?>">
   
	    			    
<?php } ?>

    	
		            	</div>

            				            	<h3 class="toggledown"></h3>

		            	<h3 class="friendrequests"><?php echo $info['count']; ?> Friend Requests </h3>
            		</div>
            		<div class="expandnotif">

<?php 
	foreach($info['requests'] as $request) {
		$me = $request->getFriendid();
		$requestid = $request->getRequestid();
		$friendid = $request->getUserid();
		$user = UserQuery::create()->findPK($friendid);
		$profile = ProfileQuery::create()->findPK($friendid);
?>

            			<div class="friendrequest">
			            	<img class="usr_img" src="public/photos/<?php echo $user->getAvatarFilename(); ?>">
			            	<div class="titlebar">
							<a href="profile/<?php echo $user->getUsername(); ?>"><?php echo $user->getFirstName() . ' ' .  $user->getLastName(); ?></a>
							<p class='date'> Today </p>
			            	</div>
							<div class="requestinfo">
							<?php if ($profile && $profile->getBio()) { ?>
							<p>Bio: <?php echo $profile->getBio(); ?></p>
							<?php } ?>
							<p>Message: Sup baby gurl, You want the D?</p>
							</div>
								<form id="acceptfriend" action="/stream" method="post" class="requestform">
									<input type="hidden" name="request" value="<?php echo $requestid; ?>">
									<input type="hidden" name="friendid" value="<?php echo $friendid; ?>">
									<input id="accept" class="buttonleft" type="submit" value="" />
									<input id="info" class="buttonleft" type="submit" value="" />
									<input id="similaruser" class="buttonright" type="submit" value="" />
								</form>
							        <div style="clear: both;"></div>

            			</div>
   
	    			    
<?php } 
	
	
	}
?>            		
             		
             		<script>
           var friendaccept = {
		url: "/global",
		data: {
			"action": "acceptfriend",
		},
		success: function(response) {
			alert(response);
		}
	};
	$('.requestform').ajaxForm(friendaccept);
	</script>