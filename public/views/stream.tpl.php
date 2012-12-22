<div class="stream" id="streamlist">
	<?php 
	
	foreach ($data['status'] as $post) {
		include 'views/post.tpl';
	} ?>
</div>
			<script>
				$("#<?php echo $post['pid']; ?>.post").click(function(){
					var info = $(".post").attr('id');
					$('#<?php echo $post['pid']; ?>.comments').show();

					var options = {
						resetForm: true,
						clearForm: true,
						data: { post: '<?php echo $post['pid']; ?>', },
						success: function(response) {
							alert(response);
							},
						};
						$('.makeComment').ajaxForm(options);
						$('.makeCommentTextbox').autosize();
						
						});
			</script>


<div id="page" class='more'> more </div>

<script>

	

		var intval = setInterval(function() {streamUpdates()}, 15000);
	function getResponse(response) {
		var b = 0;
		if (response > b) {
			$("#newposts").show();
			$("#newposts").html(response + ' new update')
		}
	};
	function streamUpdates(last) {
		var a = $(".post").attr('id');
		if (last != 'undefined' && last) {
			$.ajax({
				type: "POST",
				url: "/public/ajax/updates.php",
				data: {
					"PID": last
				},
				success:  getResponse
			})
		}
		if (a) {
			$.ajax({
				type: "POST",
				url: "/public/ajax/updates.php",
				data: {
					"PID": a
				},
				success:  getResponse
			})
		}
	};
	$("#newposts").click(function(){
		var a = $(".post").attr('id');
       	$.ajax({  
		    type: "POST",  
		    url: "/public/ajax/addpost.php",
		    data : { "PID" : a},
		    dataType: "json",
		    success: function(response) {
		    	var first = response.first;
		    	last = response.last;
			    $(first).prependTo("#streamlist"),
			    clearInterval(intval),
			    $("#newposts").hide()
			    var intval=setInterval(function(){streamUpdates(last)},15000);
		    }
		})
	});
</script>