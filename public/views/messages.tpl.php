	<h3 class="toggledown"></h3>
	<h3 class="messagecenter">Message Center</h3>
	<form class="replyform">
		<input class="buttonleft" type="submit" id="supercompose" value="" />
		<input class="buttonleft" id="readmore" onclick="window.location='/messages';" type='button' value="" />
	</form>
</div>
<form id="sendmessage" method="post">
	<input type=text name="to" placeholder="To [USER ID]"/><br />
	<input type=text name="subject" placeholder="Subject"/><br />
	<textarea id="messagecontents" class="posttextarea" name="content"></textarea>
	<input class="messagesubmit" type="submit" />
</form>

<div id="expandedmessage">
	<?php 
		$firstmessage = $data['list'];
			if (is_array($firstmessage)) {
			foreach ($firstmessage as $message) {
				$contents = $message['contents'];
				$thread = $message['thread'];
				$users = $message['users'];
				$senderid = $contents->getUserID();
				echo "<div id='" . $thread->getMessageId() . "' class='message'>";
					foreach ($users as $user) {
						if ($senderid === $user->getID()) { 
							$senderid = NULL;
							$firstname = $user->getFirstName();
							$lastname = $user->getLastName();
							$username = $user->getUsername();
							echo "<img class='usr_img' src='/public/photos/" . $user->getAvatarFilename() . "'/ >";
						}
					}
					echo "<div class='titlebar'>";
					echo "<p class='subject'><a href='/profile/" . $username . "'>" . $firstname . " " . $lastname . "</a> - " . $thread->getSubject() . "</p>";
					echo "<p class='date'>" . $contents->getDate() . "</p>";
					echo "</div>";
					echo "<p class='content'>" . $contents->getContent() . "</p>";
	?>
						<form class="replyform">
							<input id="<?php echo $thread->getMessageId(); ?>"  class="buttonleft replybutton" type="submit" value="" />
							<!-- <input class="buttonright" type="submit" value="Delete" /> -->
							<input class="buttonright msgfullview" type="submit" value="" />
							<input id="<?php echo $thread->getMessageId(); ?>" class="buttonleft archive" type="submit" value="" />
						</form>
					<form id="<?php echo $thread->getMessageId(); ?>" class="replymessage" method="post">
						<textarea id="messagecontents" class="posttextarea" name="content"></textarea>
						<input type="hidden" name="messageid" value="<?php echo $thread->getMessageId(); ?>" />
						<input type="submit" value="Send" />
					</form>
												        <div style="clear: both;"></div>

				</div>
				<script>
					$(".msgfullview").click(function(e) {
						e.preventDefault();
						window.location = '/messages/<?php echo $thread->getMessageID(); ?>';
					});
				</script>
			<?php } }?>

<script>
	$(".replybutton").click(function(e) {
		e.preventDefault();
		var id = "#" + $(this).attr('id') + ".replymessage";
		$(id).toggle();
		var reply = {
			resetForm: true,
			clearForm: true,
			url: "/global",
			data: {
				"action": "replymessage",
			},
			success: function(response) {
				$(id).toggle();
			}
		};
		$('.replymessage').ajaxForm(reply);
		})
</script>