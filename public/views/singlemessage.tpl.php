<?php foreach ($data['contents'] as $message) { ?>
		<div class="post">
			<div class="postcontents">
				<img class="usr_img" src="public/avatars/<?php echo $message['usrinfo']->getAvatarFilename(); ?>" />
				<a href="profile/<?php echo $message['usrinfo']->getUsername(); ?>"><?php echo $message['usrinfo']->getFirstName(). " " .$message['usrinfo']->getLastName(); ?></a>
				<span class='date'> <?php echo $message['msgcontents']->getDate(); ?> </span>
				<p class="comment"><?php echo $message['msgcontents']->getContent(); ?></p>
			</div>
		</div>
<?php } ?>
