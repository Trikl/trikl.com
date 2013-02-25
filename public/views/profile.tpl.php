<?php 
$userinfos = $data['userinfos'];
$user = $userinfos['user'];
$profile = $userinfos['profile'];
$friendList = $userinfos['friendlist'];
$showfriend = $userinfos['showfriend'];
$notfound = $userinfos['notfound'];
$title = $user->getFirstName() . ' ' . $user->getLastName();
 ?>
 
<style>
 .profile {
 	margin:auto;
	 height: 150px;
	 padding:10px 0 0 10px;
	 border: 1px solid rgba(0, 0, 0, 0.0980392);
 }
 .profile li {
	 display:block;
 }
 .profile_bio {
	float:right;
	text-shadow:
		-1px -1px 0 #000,  
	    1px -1px 0 #000,
	    -1px 1px 0 #000,
	    1px 1px 0 #000;
	color: white;
	letter-spacing: 1px;
	background: rgba(0, 0, 0, 0.5);
	padding: 19px;
	display:none;
 }
 
 .profile_bio ul {
	  -webkit-padding-start: 0px;
    margin: 0;
 }
 
 .profile_img {
 	float:left;
	 width:80px;
	 height:80px;
	 border-radius: 5px;
}
.profile_un {
	margin-top:0px;
	margin-left:85px;

}
.profile_friends {
	float:left;
}

.profile .profile_un {
	text-shadow:
		-1px -1px 0 #000,  
	    1px -1px 0 #000,
	    -1px 1px 0 #000,
	    1px 1px 0 #000;
	letter-spacing: 2px;
	color: #FFF;
}

#friendme {
	float:right;
}
 </style>
 
<div class="profile" style="background:url('/public/photos/<?php echo $user->getBannerFilename(); ?>')">
<?php if (!$notfound) { ?>
	<img class="profile_img" src="public/avatars/<?php echo $user->getAvatarFilename(); ?>" />
	<h1 class="profile_un"><?php echo $title; ?></h1>
</div>
<div id="profilebox">
	<ul id="profilelinks">
    <li id='userposts'>
        Posts
    </li>
    <li id="userphotos">
        <a href="photo">Photos</a>
    </li>
    <li id="userbio">
        Bio
    </li>
    <li id="userevents">
        <a href="profile">Events</a>
    </li>
    <li id="userfriends">
        <a href="profile">Friends</a>
    </li>
    <?php if ($showfriend) { ?>
		<li id="friendme">
			<form method="post" action="">
				<input type="Submit" name="submit" value="Friend Me!">
			</form>
		</li>
	<?php } ?>

</ul>
</div>

<script>
$('#userbio').click(function() {
	$('.stream').hide();
	$('.profile_bio').show();

});
$('#userposts').click(function() {
	$('.profile_bio').hide();
	$('.stream').show();

});
</script>



	<?php if ($profile) {  ?>
		<div class="profile_bio">
			<ul>
				<?php if($profile->getBio()) { ?>
				<li>
					Bio: <?php echo $profile->getBio(); ?>
				</li>
				<?php } if($profile->getPhone()) { ?>
				<li>
					Phone: <?php echo $profile->getPhone(); ?>
				</li>
				<?php } if($profile->getWebsite()) { ?>
				<li>
					Website: <?php echo $profile->getWebsite(); ?>
				</li>
				<?php } ?>
			</ul>
		</div>
	<?php } ?>

<div class="stream" id="streamlist">

<?php include 'views/postpage.tpl.php'; ?>
</div>


<?php } else { ?>
	<h1>User Not Found: </h1>
	<br />

	This user does not exist, or has fallen down the rabbit hole.

	<br />
	<br />
	
<?php  } ?>
