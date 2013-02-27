<style>
.messagethread .title {
	float:left;
	display: inline-block;
	margin: 0 10px;

} 
.messagethread .date {
	float:right;
	margin-right: 15px !important;
}
.messagethread h2 {
	margin: 0;
}
.messagethread .threadinfo {
	line-height:65px;
}

.messagethread .post .postcontents {
	margin-left: 0px !important;
	width: 940px !important;
}
.messagethread .post {
	margin: 0;
	background: rgba(0,0,0,0.07);
}
</style>



<div class="messagethread">
<div class="threadinfo">
<h2 class="title"> <?php echo $data['title']->getSubject(); ?> </h2>
<h2 class="date"> <?php echo $data['title']->getDate(); ?> </h2>
</div>
<?php foreach ($data['contents'] as $message) { ?>
		<div class="post">
			<div class="postcontents">
				<img class="usr_img" src="public/photos/<?php echo $message['usrinfo']->getAvatarFilename(); ?>" />
				<a href="profile/<?php echo $message['usrinfo']->getUsername(); ?>"><?php echo $message['usrinfo']->getFirstName(). " " .$message['usrinfo']->getLastName(); ?></a>
				<span class='date'> <?php echo $message['msgcontents']->getDate(); ?> </span>
				<p class="comment"><?php echo $message['msgcontents']->getContent(); ?></p>
			</div>
		</div>
<?php } ?>
</div>