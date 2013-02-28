<?php 
$userinfos = $data['userinfos'];
$notfound = $userinfos['notfound'];
if ($notfound !== NULL) {
	$user = $userinfos['user'];
	$profile = $userinfos['profile'];
	$friendList = $userinfos['friendlist'];
	$showfriend = $userinfos['showfriend'];
	$title = $user->getFirstName() . ' ' . $user->getLastName();
?>
<div class="profile" style="background:url('/public/photos/<?php echo $user->getBannerFilename(); ?>')">
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
	       Friends
	    </li>
	    <?php if (!$showfriend) { ?>
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
	$('.profilefriends').hide();
	$('.profile_bio').show();
});
$('#userposts').click(function() {
	$('.profile_bio').hide();
	$('.profilefriends').hide();
	$('.stream').show();

});
$('#userfriends').click(function() {
	$('.profile_bio').hide();
	$('.stream').hide();
	$('.profilefriends').show();
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

<div class="profilefriends"> 
<?php include 'views/friends.tpl.php'; ?>
</div>

<?php } else { ?>
	<h1>User Not Found: </h1>
	<br />

	This user does not exist, or has fallen down the rabbit hole.

	<br />
	<br />
	
<?php  } ?>
