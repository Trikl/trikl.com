$(document).ready(function() {
	function postView() {
		$(".postcontents").each(function() {
			var thispost = '#' + $(this).attr('id') + '.postcontents';
			var thispostid = $(this).attr('id');
			var thispostedit = '#editpost-' + $(this).attr('id');
			var posteditor = '#editor-' + thispostid;
			var thispostdownvote = '#downvote-' + $(this).attr('id');
			var thispostupvote = '#upvote-' + $(this).attr('id');
			var share = '#' + $(this).attr('id') + '.share';
			var comments = '#' + thispostid + '.comments';
			var urldata = '#' + thispostid + '.urldata';
			var editoptions = {
				resetForm: true,
				clearForm: true,
				data: {
					"action": "editpost",
					"id": $('#editPost').attr('post'),
				},
				success: function() {
					$(posteditor).dialog('close');
				}
			};
			var commentoptions = {
				resetForm: true,
				clearForm: true,
				data: {
					post: thispostid,
					"action": "comment",
				},
				success: function(response) {
					alert(response);
				},
			};
			$(thispostedit).click(function() {
				$('#editPost').ajaxForm(editoptions);
				$(posteditor).dialog(function() {});
			});
			$(thispostupvote).click(function() {
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"action": "upvote",
						"id": thispostid,
					}
				})
			});
			$(thispostdownvote).click(function() {
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"action": "downvote",
						"id": thispostid,
					}
				})
			});
			$(thispost).mouseover(function() {
				$(share).hide().show();
			});
			$('.post').mouseleave(function() {
				$(share).hide();
			})
			$(thispost).toggle(function() {
				$(thispost).css("background", "rgba(0,0,0,0.10)");
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"URL": $(this).attr('url'),
						"action": "geturl",
					},
					success: function(response) {
						//alert(response);
						$(urldata).html(response).show();
					}
				})
				$(comments).show();
				$('.makeComment').ajaxForm(commentoptions);
				$('.makeCommentTextbox').autosize();
			}, function() {
				$(urldata).hide();
				$(comments).hide();
				$(thispost).css("background", "rgba(0,0,0,0.00)");
			});
			$("a").click(function(e) {
				e.stopPropagation();
			})
		});
	};
	function omnibar() {
		var commentoptions = {
			resetForm: true,
			clearForm: true,
			data: {
				"action": "createpost",
			},
			success: function(response) {
				alert(response);
			}
		};
		var bar = $('.bar');
		var percent = $('.percent');
		var status = $('#status');
		var posttext = '#makePostTextbox';
		var streamphoto = {
			url: '/photo',
			beforeSend: function() {
				status.empty();
				var percentVal = '0%';
				bar.width(percentVal)
				percent.html(percentVal);
			},
			data: {
				"action": "upload",
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal)
				percent.html(percentVal);
			},
			success: function(response) {
				$(posttext).val($(posttext).val() + ' http://trikl.com/photo/' + response);
				$("#dialog").dialog('close');
			}
		};
		$('#makePost').ajaxForm(commentoptions);
		$('#makeBlog').ajaxForm(commentoptions);
		$(posttext).autosize().on("keyup", function() {
			var postdata = $(posttext).val().length;
			if (postdata > 0) {
				$('#options').show();
			} else {
				$('#options').hide();
			}
			if ($(posttext).css('height') > '39px') {
				$("#makeBlogtextbox").html($(posttext).val());
				$(posttext).val('');
				$(posttext).css('height', '38px');
				$('#options').stop(true, true).hide("slide", {
					direction: "up"
				}, 700);
				$('#blog').dialog();
			}
					$("a").click(function(e) {
				e.stopPropagation();
			})
		});
		$('#subpost').click(function() {
			$('#makePost').submit();
			$(posttext).css('height', '38px');
			$('#options').stop(true, true).hide("slide", {
				direction: "up"
			}, 700);
		});
		
		$('#blogpost').click(function() {
			$('#makeBlog').submit();

		});
		$('#subimage').click(function() {
			$("#dialog").dialog(function() {
				$('#upload').submit(function() {
					$(this).ajaxSubmit(streamphoto);
					return false;
				});
			});
		});
	};
	function morePosts() {
		var c = 1;
		$("#page").click(function() {
			c++;
			$.ajax({
				type: "POST",
				url: "/stream",
				data: {
					"page": c,
					"action": "more",
				},
				success: function(response) {
					$(response).appendTo("#streamlist");
					postView();
				}
			})
		});
	};
	function newPosts() {
		function streamInt() {
			var intval = setInterval(function() {
				streamUpdates()
			}, 15000);
		};
		function streamUpdates() {
			$.ajax({
				type: "POST",
				url: "/stream",
				data: {
					"PID": $(".post").attr('id'),
					"action": "updates",
				},
				success: function(response) {
					if (response > 0) {
						$("#newposts").html(response + ' new update').show();
					}
				},
			});
		};
		$("#newposts").click(function() {
			$.ajax({
				type: "POST",
				url: "/stream",
				data: {
					"PID": $(".post").attr('id'),
					"action": "new",
				},
				success: function(response) {
					$(response).prependTo("#streamlist"), clearInterval(intval), $("#newposts").hide()
					streamInt();
					postView();
				}
			})
		});
		streamInt();
	};
	
	omnibar();
	postView();
	morePosts();
	newPosts();
	
	var current_content = $(".LoginButn").html();
	$("#registerbtn").click(function(e) {
		e.preventDefault();
		$.ajax({
			url: 'public/views/register.tpl.php',
			success: function(data) {
				$(".LoginButn").html(data);
			}
		});
	});
	$("#login").click(function(e) {
		e.preventDefault();
		$.ajax({
			url: 'public/views/login.tpl.php',
			success: function(data) {
				$(".LoginButn").html(data);
			}
		});
	});
//	$('#left_mouseline').hover(function() {
//		$('#sidebar_left').stop(true, true).show("slide", {
//			direction: "left"
//		}, 500);
//	}, function() {
//		$('#sidebar_left').stop(true, true).hide("slide", {
//			direction: "left"
//		}, 500);
//	});
//	$('#right_mouseline').hover(function() {
//		$('#sidebar_right').stop(true, true).show("slide", {
//			direction: "right"
//		}, 500);
//	}, function() {
//		$('#sidebar_right').stop(true, true).hide("slide", {
//			direction: "right"
//		}, 500);
//	});
	var bar = $('.photobar');
	var percent = $('.photopercent');
	var status = $('#photostatus');
	var options = {
		target: '#photomessage',
		url: '/photo',
		beforeSend: function() {
			status.empty();
			var percentVal = '0%';
			bar.width(percentVal)
			percent.html(percentVal);
		},
		data: {
			"action": "upload",
		},
		uploadProgress: function(event, position, total, percentComplete) {
			var percentVal = percentComplete + '%';
			bar.width(percentVal)
			percent.html(percentVal);
		}
	};
	$('#photoupload').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
});