<div id="left_mouseline">
	<div id="stuff">
		<div id="sidebar_left">
				<?php $user = UserQuery::create()->findPK($_SESSION['uid']); ?>
			<a href="profile/<?php echo $user->getUsername(); ?>"><img class="usr_img" style="margin-left:8px;float:none;" src="public/avatars/<?php echo $user->getAvatarFilename(); ?>" /></a>

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
				<a href="friends">
					<div class="menu_item" id="photos">
						<span class="item"><img class="menu_icon" src="public/images/icons/home.png" /> Friends</span>
					</div>
				</a>
				<a href="messages">
					<div class="menu_item" id="photos">
						<span class="item"><img class="menu_icon" src="public/images/icons/home.png" /> Messages</span>
					</div>
				</a>
				<a href="events">
					<div class="menu_item" id="stream">
						<span class="item"><img class="menu_icon" src="public/images/icons/home.png" /> Events</span>
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
