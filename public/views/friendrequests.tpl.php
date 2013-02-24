<?php $info = $data['userpanel']; 
	if ($info['count']; > 0) {
	
	
?>

            		<div class="contractednotif">
            				            	<h3 class="toggledown"></h3>

		            	<h3 class="friendrequests"><?php echo $info['count']; ?> Friend Requests </h3>
		            	<div class="tinyavatars">


<?php 
	foreach($info['requests'] as $request) {
		$me = $request->getFriendid();
		$requestid = $request->getRequestid();
		$friendid = $request->getUserid();
		$user = UserQuery::create()->findPK($friendid);
?>

			            	<img class="tinyava" height="40" width="40" src="/public/avatars/<?php echo $user->getAvatarFilename(); ?>">
   
	    			    
<?php } ?>

    	
		            	</div>
            		</div>
            		<div class="expandnotif">

<?php 
	foreach($info['requests'] as $request) {
		$me = $request->getFriendid();
		$requestid = $request->getRequestid();
		$friendid = $request->getUserid();
		$user = UserQuery::create()->findPK($friendid);
?>

            			<div class="friendrequest">
			            <div class="requestcontents">
			            	<img class="usr_img" src="public/avatars/<?php echo $user->getAvatarFilename(); ?>">
							<a href="profile/<?php echo $user->getUsername(); ?>"><?php echo $user->getFirstName() . ' ' .  $user->getLastName(); ?></a>
							<span class='date'> Today </span>
							<div class="requestinfo">
							<p>Bio: Y'all know me, same ole G but a bit low key.</p>
							<p>Message: Sup baby gurl, You want the D?</p>
							</div>
								<form id="acceptfriend" action="/stream" method="post" class="requestform">
									<input type="hidden" name="request" value="<?php echo $requestid; ?>">
									<input type="hidden" name="friendid" value="<?php echo $friendid; ?>">
									<input class="buttonleft" type="submit" value="Accept" />
									<input class="buttonleft" type="submit" value="Inquire" />
									<input class="buttonright" type="submit" value="Similar Friends" />
								</form>
						</div>
            			</div>
   
	    			    
<?php } 
	
	
	}
?>            		
             		</div>
             		
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
