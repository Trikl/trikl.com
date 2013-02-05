<?php 

$userinfos = $data['userinfos'];
$user = $userinfos['user'];
$profile = $userinfos['profile'];
$friendList = $userinfos['friendlist'];
$showfriend = $userinfos['showfriend'];
$notfound = $userinfos['notfound'];
$title = $user->getFirstName() . ' ' . $user->getLastName();

 ?>

        <h1 align="center"><?=$title?></h1>
<div class="friends_display" align="center">
	<span>Which Friends To Display:</span>
	<select name="friends">
	    <option value="1">All Friends</option>
	    <option value="2">Buckets</option>
	</select>
	<br />
</div>


	<?php if (!$showfriend) { ?>
		<form method="post" action="">
			<input type="Submit" name="submit" value="Friend Me!">
		</form>
	<?php } ?>
	<br />
	<div class="profile_friends">
	<span> Friends: </span> <br />
	<?php foreach($friendList as $profriend) {
		echo '<a href="http://trikl.com/profile/'.$profriend['username'].'">';
		echo $profriend['firstname']." ".$profriend['lastname'];
		echo '</a>';
		echo '<br />';
	} ?>
	</div>
