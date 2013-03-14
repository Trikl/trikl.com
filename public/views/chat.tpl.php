<?php
$chat = $data['chat'];
?>
 
 <div class="singlechat">
 	<img class="chatimage" width=30 height=30 src="public/photos/<?php echo $chat['from']->getAvatarFilename(); ?>" />
 	<div class="chatcontents">
 	<span><?php echo $chat['from']->getFirstName() . ' ' . $chat['from']->getLastName(); ?></span>
 	<p><?php echo $chat['message']; ?></p>
 	</div>
 </div>