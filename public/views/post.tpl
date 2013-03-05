<?php
	unset($urlinfo);
if(is_array($post['url'])) { foreach ($post['url'] as $url) { $urlinfo .= $url . "-"; } }
 ?>
 
 <script type="text/javascript">
$(document).ready(function() {
$('#load').hide();
});

$(function() {
$('.delete').click(function() {
$('#load').fadeIn();
var commentContainer = $(this).parent();
var id = $(this).attr("id");
var string = 'id='+ id ;
	
$.ajax({
   type: "POST",
   data: string,
   cache: false,
   success: function(){
	commentContainer.slideUp('slow', function() {$(this).remove();});
	$('#load').fadeOut();
  }
   
 });

return false;
	});
});

</script>

		<div class="post" id="<?php echo $post['pid']; ?>">
			<div class="postvotes">
				<div class="upvote" id="upvote-<?php echo $post['pid']; ?>"></div>
								<div class="votes"><?php if ($post['votetally']) { echo $post['votetally']; } else { echo '0'; } ?></div>

				<div class="downvote" id="downvote-<?php echo $post['pid']; ?>"></div>
			</div>
		
			<div class="postcontents" id="<?php echo $post['pid']; ?>" url="<?php echo $urlinfo ?>">
				<img class="usr_img" src="public/photos/<?php echo $post['user']->getAvatarFilename(); ?>" />
				<a href="profile/<?php echo $post['user']->getUsername(); ?>"><?php echo $post['user']->getFirstName()." ".$post['user']->getLastName();  ?></a> <?php if ($post['parentid'] != 0) { echo "- reply"; } ?>
				<span class='date'> <?php echo $post['date']; ?> </span>
				<p class="comment"><?php echo $post['text']; ?></p>
				
				<div class="share" id="<?php echo $post['pid']; ?>"> 
					<form>
						<input type="submit" value="Full Post" />
						<input class="pin" id="<?php echo $post['pid']; ?>" type="submit" value="Pin" />
						<?php if ($_SESSION['uid'] === $post['user']->getId()) { ?>
							<input class="delete_post" type="submit" value="Delete" id="deletepost-<?php echo $post['pid'];?>" />
							<input id="editpost-<?php echo $post['pid']; ?>" type="submit" value="Edit" />
						<?php } ?>
					</form>								 
				</div>
			</div>
			<div class="urldata" id="<?php echo $post['pid']; ?>" style="display:none"></div>
			<div class="comments" id="<?php echo $post['pid']; ?>">
			<?php
				if (is_array($post['comments'])) {
					foreach ($post['comments'] as $comments) {
			?>
						<div class="commentcontents">
							<img class="usr_img" style="width:60px;height:60px;" src="public/photos/<?php echo $comments['user']->getAvatarFilename(); ?>" />
							<a href="profile/<?php echo $post['user']->getUsername(); ?>"><?php echo $comments['user']->getFirstName()." ".$comments['user']->getLastName(); ?></a>
							<span class='date'> <?php echo $comments['date']; ?> </span>
							<p class="comment more"><?php echo $comments['content']; ?></p>
						</div>
			<?php
					}
				}
				?>
				<form class="makeComment" method="post">
					<textarea class="makeCommentTextbox" placeholder="Comment..." name="post"></textarea><br />
					<input type='submit' value="Comment">
				</form>	
			</div>
		</div>