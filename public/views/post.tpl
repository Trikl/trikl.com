<?php
	unset($urlinfo);
if(is_array($post['url'])) { foreach ($post['url'] as $url) { $urlinfo .= $url . "-"; } }
 ?>
		<div class="post" id="<?php echo $post['pid']; ?>">
			<div class="postvotes">
				<div class="upvote" id="upvote-<?php echo $post['pid']; ?>"></div>
								<div class="votes"><?php if ($post['votetally']) { echo $post['votetally']; } else { echo '0'; } ?></div>

				<div class="downvote" id="downvote-<?php echo $post['pid']; ?>"></div>
			</div>
		
			<div class="postcontents" id="<?php echo $post['pid']; ?>" url="<?php echo $urlinfo ?>">
				<img class="usr_img" src="public/photos/<?php echo $post['user']->getAvatarFilename(); ?>" />
				<div class="titlebar">
				<a href="profile/<?php echo $post['user']->getUsername(); ?>"><?php echo $post['user']->getFirstName()." ".$post['user']->getLastName();  ?></a> <?php if ($post['parentid'] != 0) { echo "- reply"; } ?>
				<span class='date'> <?php echo $post['date']; ?> </span>
				</div>
				<p class="comment"><?php echo $post['text']; ?></p>
				
				<div class="share" id="<?php echo $post['pid']; ?>"> 
					<form>
						<input type="submit" value="" class="fullpost" />
						<input class="pin" id="<?php echo $post['pid']; ?>" type="submit" value="" />
						<?php if ($_SESSION['uid'] === $post['user']->getId()) { ?>
							<input id="<?php echo $post['pid']; ?>" class="delete" type="submit" value="Delete" />
							<input id="editpost-<?php echo $post['pid']; ?>" type="submit" value="Edit" />
						<?php } ?>
					</form>								 
				</div>
			</div>
			<div class="urldata" id="<?php echo $post['pid']; ?>" style="display:none"></div>
			<div class="comments" id="<?php echo $post['pid']; ?>">
				<div class="commentlist">
					<?php include('views/allcomments.tpl.php'); ?>
				</div>
				<form class="makeComment" method="post">
					<textarea class="makeCommentTextbox" placeholder="Comment..." name="post"></textarea><br />
					<input type='submit' id="commentsubmit" value="">
				</form>	
											        <div style="clear: both;"></div>

			</div>
		</div>
