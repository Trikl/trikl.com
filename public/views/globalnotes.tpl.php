<?php foreach ($data['global'] as $global) { ?>
	<div class="notification contractednotif" style="margin-bottom:5px;line-height:45px;margin-top:5px;" <?php echo "id=" . $global['notifications']->getRefid();   ?>>
		<img class="tinyava" style="float:left;margin-right:5px;" height="40" width="40" src="/public/avatars/<?php echo $global['user']->getAvatarFilename(); ?>">
		<h3><?php echo $global['user']->getFirstName() . " " . $global['user']->getLastName(); ?></h3>
		<p style="display:inline-block;margin:0;">
		<?php 
			switch($global['notifications']->getType()) {
			case 'comment':
				echo "commented ";
				break;
			case 'mention':
				echo "mentioned you: ";
				break;
			default:
				echo $global['notifications']->getType();
				break;
			}
		
		 ?>
		<?php echo $global['notifications']->getContent();
			if (strlen($global['notifications']->getContent()) == '50') {
				echo "...";
			}
		 ?>
		</p>
		
		<form class="clearform replyform">
			<input class="buttonclear buttonleft" type="submit" <?php if($global['notifications']->getType() == 'comment') echo "id='" . $global['notifications']->getNotificationid();?>' value="Clear" />
		</form>
	</div>
<?php } ?>