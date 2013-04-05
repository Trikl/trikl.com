					<?php foreach ($post['comments'] as $comments) { ?>
								<div class="commentcontents" id="<?php echo $comments['id']; ?>">
									<img class="usr_img" style="width:60px;height:60px;" src="public/photos/<?php echo $comments['user']->getAvatarFilename(); ?>" />
									<div class="titlebar">
										<a href="profile/<?php echo $comments['user']->getUsername(); ?>"><?php echo $comments['user']->getFirstName()." ".$comments['user']->getLastName(); ?></a>
										<span class='date'> <?php echo $comments['date']; ?> </span>
									</div>
									<p class="comment more"><?php echo $comments['content']; ?></p>
								</div>
					<?php } ?>	