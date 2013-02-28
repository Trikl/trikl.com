<?php 

$userinfos = $data['userinfos'];
$user = $userinfos['user'];
$profile = $userinfos['profile'];
$friendList = $userinfos['friendlist'];
$buckets = $userinfos['buckets'];
$nbFriends = $userinfos['nbFriends'];
$showfriend = $userinfos['showfriend'];
$notfound = $userinfos['notfound'];
$title = $user->getFirstName() . ' ' . $user->getLastName();
?>

<html>
    <title><?php echo $title?></title>

<body>
    <h2 align="center"><?php echo $title?></h2>

    <fieldset>
        <label for="friends">Which Friends To Display:</label><br>
            	    <?php if (!$showfriend) { ?>
			<li id="friendme">
				<form method="post" action="">
					<input type="Submit" name="submit" value="Friend Me!">
				</form>
			</li>
		<?php } ?>
            <br>
            <h5><span>Friends:</span></h5><br>
            <br>
            <?php foreach($friendList as $profriend) {
                            echo '<div class="profile_friends" id="allfriends" style=border:1px;solid;rgba(0,0,0,0.0980392);>';
                            echo '<a href="http://trikl.com/profile/'.$profriend['username'].'">';
                            echo "<img width=80 height=80 style=float:left;margin:5px; src='/public/avatars/" . $profriend['avatar'] . "' />";
                            echo $profriend['firstname']." ".$profriend['lastname'];
                            echo '</a>';
                            echo '<br />';
                            echo '</div>';
                        } ?>

        </div>
    </fieldset>
</body>
</html>
