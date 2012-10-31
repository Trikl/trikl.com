		<img style="width:149px;height:100px;float:left;border-radius:5px" src="public/avatars/<?php echo $user->getAvatarFilename(); ?>" />
		<div class="post">
			<a href="profile/<?php echo $user->getUsername(); ?>"><?php echo $user->getFirstName()." ".$user->getLastName(); ?></a>
			<p><?php echo $text; ?></p>
			<span>insert date here</span>
			<br />
		</div>
		
