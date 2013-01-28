
		<div class="post" id="<?php echo $post['pid']; ?>">
			<div class="postcontents" id="<?php echo $post['pid']; ?>" url="<?php echo $post['url']; ?>">
				<img class="usr_img" src="public/avatars/<?php echo $post['user']->getAvatarFilename(); ?>" />
				<a href="profile/<?php echo $post['user']->getUsername(); ?>"><?php echo $post['user']->getFirstName()." ".$post['user']->getLastName(); ?></a>
				<span class='date'> <?php echo $post['date']; ?> </span>
				<p class="comment"><?php echo $post['text']; ?></p>
			</div>
				<div class="urldata" id="<?php echo $post['pid']; ?>" style="display:none"></div>

			<div class="comments" style="display:none;margin-left:20px;margin-right:20px;" id="<?php echo $post['pid']; ?>">

			<?php
				
				if(is_array($post['comments'])){
					foreach ($post['comments'] as $comments):
				
				?>
						<div class="commentcontents">
							<img class="usr_img" style="width:60px;height:60px;" src="public/avatars/<?php echo $comments['user']->getAvatarFilename(); ?>" />
							<a href="profile/<?php echo $post['user']->getUsername(); ?>"><?php echo $comments['user']->getFirstName()." ".$comments['user']->getLastName(); ?></a>
							<span class='date'> <?php echo $comments['date']; ?> </span>
							<p class="comment more"><?php echo $comments['content']; ?></p>
						</div>
					<?php
					
					endforeach;
				}
				
				?>
				<form class="makeComment" method="post">
					<textarea class="makeCommentTextbox" placeholder="Comment..." name="comment"></textarea>
					<input type=submit value="">
				</form>	
			</div>
			<div class="share" id="<?php echo $post['pid']; ?>"> 
				
				<a href="/post/<?php echo $post['pid']; ?>">Full Post</a>
				<span>Bucket: <?php echo $post['bucket']; ?></span>
				<?php if ($_SESSION['uid'] === $post['uid']) { ?>
				<span>Delete</span>
				<span>Edit</span>
				<?php } ?>
				
			 </div>
		</div>