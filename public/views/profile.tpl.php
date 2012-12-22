<?php 

$userinfos = $data['userinfos'];
$user = $userinfos['user'];
$profile = $userinfos['profile'];
$friendList = $userinfos['friendlist'];
$showfriend = $userinfos['showfriend'];
$notfound = $userinfos['notfound'];
$title = $user->getFirstName() . ' ' . $user->getLastName();
 ?>
 
<div class="profile">
<?php if (!$notfound) { ?>
	<img class="profile_img" src="public/avatars/<?php echo $user->getAvatarFilename(); ?>" />
	<h1 class="profile_un"><?=$title?></h1>
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
	<?php } if (!$showfriend) { ?>
		<form method="post" action="">
			<input type="Submit" name="submit" value="Friend Me!">
		</form>
	<?php } ?>
	<br />
	<div class="profile_friends">
	<span> Friends: </span> <br />
	<?php foreach($friendList as $profriend) {
		echo '<a href="/profile/'.$profriend['username'].'">';
		echo $profriend['firstname']." ".$profriend['lastname'];
		echo '</a>';
		echo '<br />';
	} ?>
	</div>
<?php } else { ?>
	<h1>User Not Found: </h1>
	<br />

	This user does not exist, or has fallen down the rabbit hole.

	<br />
	<br />
	
<?php  } ?>

</div>