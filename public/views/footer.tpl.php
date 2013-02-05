
		</div>
				<?php if ($_SESSION['uid']) { ?>
	
		 <div id="right_mouseline">
	<div id="sidebar_right">
		<div id="notifications"></div>
		Messages <hr /> 
		<div id="messages">
		messages here 
		</div>
		Who's Online <hr />
		Trick <br /><br />
	</div>
 </div>
 
 <script>
 	var intval = setInterval(function() {
		notificationUpdates()
	}, 300000);
	notificationUpdates()

	function notificationUpdates() {
			$.ajax({
				type: "POST",
				url: "/global",
				data: {
					"action": "getNotifications",
				},
				success: function(response){
					$("#notifications").html(response)
				}
			})
	};
	function messageUpdates() {
			$.ajax({
				type: "POST",
				url: "/global",
				data: {
					"action": "getMessages",
				},
				success: function(response){
					$("#messages").html(response)
				}
			})
	};
</script>
 
 <?php } ?>
	</body>
</html>
