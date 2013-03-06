<?php 
$friendList = $userinfos['friendlist'];
$title = $user->getFirstName() . ' ' . $user->getLastName();
?>

    <fieldset>
        <label for="friends">Which Friends To Display:</label><br>
            <br>
            <h5><span>Friends:</span></h5><br>
            <br>
            <?php foreach($friendList as $profriend) {
                            echo '<div class="profile_friends" id="allfriends" style=border:1px;solid;rgba(0,0,0,0.0980392);>';
                            echo '<a href="/profile/'.$profriend['username'].'">';
                            echo "<img class='usr_img' src='/public/photos/" . $profriend['avatar'] . "' />";
                            echo $profriend['firstname']." ".$profriend['lastname'];
                            echo '</a>';
                            echo '<br />';
                            echo '</div>';
                        } ?>

        </div>
    </fieldset>
