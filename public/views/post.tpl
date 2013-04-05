<?php
	unset($urlinfo);
	if(is_array($post['url'])) { foreach ($post['url'] as $url) { $urlinfo .= $url . "-"; } }
?>
		<div class="post">
			<div class="begincomments" id="<?php echo $post['pid']; ?>"></div>

			<!-- <div class="postvotes">
				<div class="upvote" id="upvote-<?php echo $post['pid']; ?>"></div>
				<div class="votes"><?php if ($post['votetally']) { echo $post['votetally']; } else { echo '0'; } ?></div>

				<div class="downvote" id="downvote-<?php echo $post['pid']; ?>"></div>
			</div> -->
		
			<div class="postcontents" id="<?php echo $post['pid']; ?>" url="<?php echo $urlinfo ?>" parent="<?php echo $post['parentnumb']; ?>">
				<img class="usr_img" src="public/photos/<?php echo $post['user']->getAvatarFilename(); ?>" />
				<div class="titlebar">
				<a href="profile/<?php echo $post['user']->getUsername(); ?>"><?php echo $post['user']->getFirstName()." ".$post['user']->getLastName();  ?></a>
				 <?php 
				 	if (is_array($post['parentid'])) {
						foreach ($post['parentid'] as $parentid) {
							echo 'to <a href="profile/' . $parentid['user']->getUsername() . '">' . $parentid['user']->getFirstName() . ' ' . $parentid['user']->getLastName() . '</a>';
						}
					}
				 ?>
				<span class='date'> <?php echo $post['date']; ?> </span>
				</div>
				<p class="comment"><?php echo $post['text']; ?></p>
				<div class="editor" title="Edit Post">
					<form id="saveEdit" action="/stream" method="post">
						<input class="save" type="submit" value="Save Edit" />
						<input type="button" class="cancel" value="Cancel" />
					</form>
				</div>
				<div class="share" id="<?php echo $post['pid']; ?>"> 
					<form>
						<input type="submit" value="" class="fullpost" />
						<input class="pin" id="<?php echo $post['pid']; ?>" type="submit" value="" />
						<?php if ($_SESSION['uid'] === $post['user']->getId()) { ?>
							<input type="submit" id="<?php echo $post['pid']; ?>" class="delete" value="" />
							<input class="edit" id="editpost-<?php echo $post['pid']; ?>" type="submit" value="" />
						<?php } ?>
					</form>								 
				</div>
				<div class="urldata" id="<?php echo $post['pid']; ?>" style="display:none"></div>
			</div>
		</div>
