
		<div class="post" id="<?php echo $post['pid']; ?>">
			<div class="postcontents" id="<?php echo $post['pid']; ?>">
				<img class="usr_img" src="public/avatars/<?php echo $post['user']->getAvatarFilename(); ?>" />
				<a href="profile/<?php echo $post['user']->getUsername(); ?>"><?php echo $post['user']->getFirstName()." ".$post['user']->getLastName(); ?></a>
				<span class='date'> <?php echo $post['date']; ?> </span>
				<p class="comment more"><?php echo $post['text']; ?></p>

			</div>

			<div class="comments" style="display:none;margin-left:20px;margin-right:20px;" id="<?php echo $post['pid']; ?>">

							<?php foreach ($post['comments'] as $comments) { ?>
										<div class="commentcontents">
											<img class="usr_img" style="width:60px;height:60px;" src="public/avatars/<?php echo $comments['user']->getAvatarFilename(); ?>" />
											<a href="profile/<?php echo $post['user']->getUsername(); ?>"><?php echo $comments['user']->getFirstName()." ".$comments['user']->getLastName(); ?></a>
											<span class='date'> <?php echo $comments['date']; ?> </span>
											<p class="comment more"><?php echo $comments['content']; ?></p>
										</div>
							<?php } ?>
						<form class="makeComment" action="/public/ajax/comment.php" method="post">
							<textarea class="makeCommentTextbox" placeholder="Whats Trikling Through Your Mind?" name="comment"></textarea>
							<input type=submit value="submit">
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
			<script>
				$("#<?php echo $post['pid']; ?>.post").click(function(){
					var info = $(".post").attr('id');
					$('#<?php echo $post['pid']; ?>.comments').show();

					var options = {
						resetForm: true,
						clearForm: true,
						data: { post: '<?php echo $post['pid']; ?>', },
						success: function(response) {
							alert(response);
							},
						};
						$('.makeComment').ajaxForm(options);
						$('.makeCommentTextbox').autosize();
						
						});
			</script>

		</div>

				
				

				<script type="text/javascript">
				
				
				
				
				$('#<?php echo $post['pid']; ?>').mouseover(function(){
					$('#<?php echo $post['pid']; ?>.share').hide();
					$('#<?php echo $post['pid']; ?>.share').show();
				});
				$('.post').mouseleave(function(){
					$('#<?php echo $post['pid']; ?>.share').hide();
				})
				
				
	$("#<?php echo $post['pid']; ?>.postcontents").click(function(){
				    	$(this).css("background","rgba(0,0,0,0.10)");

       	$.ajax({  
		    type: "POST",  
		    url: "/public/ajax/geturl.php",
		    data : { "URL" : '<?php echo $post['url']; ?>'},
		    dataType: "json",
		    success: function(response) {
			    $(response).slideDown('slow', function() {
			    	alert(response);
			    	$(this).appendTo("#<?php echo $post['pid']; ?>.postcontents");
			    });
			}
		    
		})
	});	
</script>