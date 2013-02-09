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

<script type="text/javascript">
$(document).ready(function(){
    $('#tabs div').hide();
    $('#tabs div:first').show();
    $('#tabs ul li:first').addClass('active');
    $('#tabs ul li a').click(function(){
    $('#tabs ul li').removeClass('active');
    $(this).parent().addClass('active');
    var currentTab = $(this).attr('href');
    $('#tabs div').hide();
    $(currentTab).show();
    return false;
    });
    });
    </script>
    <style type="text/css">
* {
    margin: 0;
    padding: 0;
    }
    #tabs {
    font-size: 90%;
    margin: 20px 0;
    }
    #tabs ul {
    float: left;
    background: rgba(0,0,0,0.42);
    width: 500px;
    padding-top: 4px;
    }
    #tabs li {
    margin-left: 8px;
    list-style: none;
    }
    * html #tabs li {
    display: inline;
    }
    #tabs li, #tabs li a {
    float: left;
    }
    #tabs ul li.active {
    border-top:1px solid rgba(0,0,0,0.0980392);
    background: rgba(0,0,0,0.07);
    }
    #tabs ul li.active a {
    color: #333333;
    }
    #tabs div {
    clear: both;
    padding: 15px;
    min-height: 200px;
    }
    #tabs div h3 {
    margin-bottom: 12px;
    }
    #tabs div p {
    line-height: 150%;
    }
    #tabs ul li a {
    text-decoration: none;
    padding: 8px;
    color: #000;
    font-weight: bold;
    }
    .thumbs {
    float:left;
    border:#000 solid 1px;
    margin-bottom:20px;
    margin-right:20px;
    }
    </style>

    <title><?php echo $title?></title>

    <h2 align="center"><?php echo $title?></h2>

    <fieldset>
        <label for="friends">Which Friends To Display:</label>
        <br />

        <div class="friends_display" id="tabs">
            <ul>
                <li><a href="#tab-1">All Friends</a></li>
                <li><a href="#tab-2">Buckets</a></li>
                <li><a href="#tab-3">Groups</a></li>
            </ul>
            <br />
            <br />
            <br />

            <h5><span>Friends:</span></h5><br>
            <br />
            <?php foreach($friendList as $profriend) {
                echo '<div class="profile_friends" id="tab-1" style=border:1px;solid;rgba(0,0,0,0.0980392);>';
                echo '<a href="http://trikl.com/profile/'.$profriend['username'].'">';
                echo "<img width=80 height=80 style=float:left;margin:5px; src='/public/avatars/" . $profriend['avatar'] . "' />";
                echo $profriend['firstname']." ".$profriend['lastname'];
                echo '</a>';
                echo '<br />';
                echo '</div>';
            } ?>

            <div class="buckets" id="tab-2">
                <h5><span>Buckets:</span></h5><br>
                <br />
                <p>buckets go here</p>
            </div>

            <div class="groups" id="tab-3">
                <h5><span>Groups:</span></h5><br>
                <br />
                <p>Groups here</p>
            </div>
        </div>
        <?php if (!$showfriend) { ?>
        <form method="post" action="">
            <input type="submit" name="submit" value="Friend Me!">
        </form><?php } ?><br>
    </fieldset>
