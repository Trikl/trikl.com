<?php 

$userinfos = $data['userinfos'];
$user = $userinfos['user'];
$profile = $userinfos['profile'];
$friendList = $userinfos['friendlist'];
$showfriend = $userinfos['showfriend'];
$notfound = $userinfos['notfound'];
$title = $user->getFirstName() . ' ' . $user->getLastName();

 ?>
<?php if (!$notfound) { ?>
	<h1><?=$title?></h1>
	<?php if ($profile) {  ?>
		<div style="background:white;">
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
	<span> Friends: <?php echo $nbFriends; ?> </span> <br />
	<?php foreach($friendList as $profriend) {
		echo '<a href="http://trikl.com/profile/'.$profriend['username'].'">';
		echo $profriend['firstname']." ".$profriend['lastname'];
		echo '</a>';
		echo '<br />';
	} ?>
<?php } else { ?>
	<h1>User Not Found: </h1>
	<br />

	This user does not exist, or has fallen down the rabbit hole.

	<br />
	<br />
	
<?php  } ?>