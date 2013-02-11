				<ul id="omnilinks">
<li id="trikl"><a  href="stream"> Trikl</a></li>
<li id="photos"><a  href="photo"> Photos</a></li>
<li id="events"><a  href="events"> Events</a></li>
<li id="profile"><a  href="profile"> Profile</a></li>
<li ><a id="settings"> Settings</a></li>
<li id="logout"><a  href="Logout"> Logout</a></li>
				</ul>


<script>
								   
									   $('#settings').click(function() {	
										$.ajax({
											type: "POST",
											url: "/settings",
											data: {
												"URL": $(this).attr('url'),
												"action": "geturl",
											},
											success: function(response) {
												//alert(response);
												$('#hey').html(response).hide().dialog(function() {});
												$('#blackout').show();
												$('.header').stop().animate({ 'height': 45 },1);
												$('.contents').css("margin-top", "45px");
												$('body').css("overflow", "hidden");
											}
										})
										$('div#hey').bind('dialogclose', function(event) {
												$('#blackout').hide();
												$('body').css("overflow", "scroll");
										});
										});
</script>