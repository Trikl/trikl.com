where all messages will go...this is gonna be messy till i get to it.
	<?php 
		$firstmessage = $data['list'];
			foreach ($firstmessage as $message) {
				$contents = $message['contents'];
				$thread = $message['thread'];
				$users = $message['users'];
				$senderid = $contents->getUserID();
				echo "<div class='message'>";
					foreach ($users as $user) {
						if ($senderid === $user->getID()) { 
							$senderid = NULL;
							$firstname = $user->getFirstName();
							$lastname = $user->getLastName();
							$username = $user->getUsername();
							echo "<img class='usr_img' src='/public/avatars/" . $user->getAvatarFilename() . "'/ >";
						}
					}
					echo "<p class='subject'><a href='/profile/" . $username . "'>" . $firstname . " " . $lastname . "</a> - " . $thread->getSubject() . "</p>";
					echo "<p class='date'>" . $contents->getDate() . "</p>";
					echo "<p class='content'>" . $contents->getContent() . "</p>";
					echo "<div class='recipients'>";
						foreach ($users as $user) {
							echo "<img height=40 width=40 src='/public/avatars/" . $user->getAvatarFilename() . "'/ >";
						}
	?>
						<form class="replyform">
							<input id="<?php echo $thread->getMessageId(); ?>"  class="buttonleft replybutton" type="submit" value="Reply" />
							<input class="buttonleft" type="submit" value="Add Recipient" />
							<input id="<?php echo $thread->getMessageId(); ?>" class="buttonleft archive" type="submit" value="Archive" />
							<input class="buttonright" type="submit" value="Delete" />
						</form>
					</div>
					<form id="<?php echo $thread->getMessageId(); ?>" class="replymessage" method="post">
						<textarea id="messagecontents" class="posttextarea" name="content"></textarea>
						<input type="hidden" name="messageid" value="<?php echo $thread->getMessageId(); ?>" />
						<input type="submit" value="Send" />
					</form>
				</div>
			<?php } ?>
