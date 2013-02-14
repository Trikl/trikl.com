
		</div>
				<?php if ($_SESSION['uid']) { ?>
	
 
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
					$("#notifications").html(response).hide();
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
