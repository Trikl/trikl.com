				$(function() {
					var current_content = $(".LoginButn").html();
					$(".register").live('click', function(e) {
						e.preventDefault();
						$.ajax({
							url: 'public/views/register.tpl.php',
							success: function(data) {
								$(".LoginButn").hide().html(data).fadeIn();
							}
						});
					});
					$(".back").live('click', function(e) {
						e.preventDefault();
						$(".LoginButn").hide().html(current_content).fadeIn();
					});
				});
				$(function() {
					$("#showHideTopContent").click(toggleTopContent);
				});

				function toggleTopContent() {
					var topContent = $("#topContent");
					var bottomContent = $("#bottomContent");
					if (!topContent.is(":hidden")) {
						topContent.hide('slow');
						bottomContent.slideUp('slow');
					} else {
						$("#topContent").slideDown('slow');
					}
				}