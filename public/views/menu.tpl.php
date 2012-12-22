<div id="left_mouseline">
	<div id="stuff">
		<div id="sidebar_left">
			<div style="width:60px;height:60px;background:black;color:white;float:left;">
				<?php $user = UserQuery::create()->findPK($_SESSION['uid']); ?>
				<img class="usr_img" style="width:60px;height:60px;" src="public/avatars/<?php echo $user->getAvatarFilename(); ?>" />
			</div>
			<div style="float:right;width: 140px;height:60px;"> 
	 			<a href="profile/<?php echo $user->getUsername(); ?>"><?php echo $user->getFirstName()." ".$user->getLastName(); ?></a><br />
	 				stuff here <br />
	 				and here  <br />
 			</div>
 			<br />
 			<br />
 			<br />
 			<br />
 			<hr />
			<div class="menu">
				<a href="stream">
					<div class="menu_item" id="stream">
						<span class="item"><img class="menu_icon" src="public/images/icons/home.png" /> Home</span>
					</div>
				</a>
				<a href="photo">
					<div class="menu_item" id="photos">
						<span class="item"><img class="menu_icon" src="public/images/icons/home.png" /> Photo</span>
					</div>
				</a>
				<a href="userpanel">
					<div class="menu_item" id="userpanel">
					    <span class="item"><img class="menu_icon" src="public/images/icons/notif.png"/> Notifications</span>
					</div>
				</a>
				<a href="profile<?php echo $myusername; ?>">
					<div class="menu_item" id="profile">
					    <span class="item"><img alt="profile" class="menu_icon" src="public/images/icons/profile.png"/> Profile</span>
					</div>
				</a>
				<a href="settings">
					<div class="menu_item" id="settings">
					    <span class="item"><img class="menu_icon" src="public/images/icons/settings_icon.png" /> Settings</span>
					</div>
				</a>
				<a href="logout">
					<div class="menu_item">
					    <span class="item"><img class="menu_icon" src="public/images/icons/logout_icon.png" /> Logout</span>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
