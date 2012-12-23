$(document).ready(function() {
	var current_content = $(".LoginButn").html();
	$("#register").click(function(e) {
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
	$('#left_mouseline').hover(function() {
		$('#sidebar_left').stop(true, true).show("slide", {
			direction: "left"
		}, 500);
	}, function() {
		$('#sidebar_left').stop(true, true).hide("slide", {
			direction: "left"
		}, 500);
	});
	$('#right_mouseline').hover(function() {
		$('#sidebar_right').stop(true, true).show("slide", {
			direction: "right"
		}, 500);
	}, function() {
		$('#sidebar_right').stop(true, true).hide("slide", {
			direction: "right"
		}, 500);
	});
	var uewptens = {
		resetForm: true,
		clearForm: true,
		data: {
			"action": "createpost",
		}
	};
	$('#makePost').ajaxForm(uewptens);
	$('#makePostTextbox').autosize();
	$('#makePostTextbox').keypress(function() {
		var omni = $('#makePostTextbox').val().length;
		if (omni > 0) {
			$('#options').stop(true, true).show("slide", {
				direction: "up"
			}, 700);
		}
		$('#makePostTextbox').focus(function() {
			var omni = $('#makePostTextbox').val().length;
			if (omni > 0) {
				$('#options').show("slide", {
					direction: "up"
				}, 700);
			}
		});
	});
	$('#subpost').click(function() {
		$('#makePost').submit();
		$('#makePostTextbox').css('height', '36px');
		$('#options').stop(true, true).hide("slide", {
			direction: "up"
		}, 700);
	});
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
			}
		})
	});
	var bar = $('.bar');
	var percent = $('.percent');
	var status = $('#status');
	var lulzoptions = {
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
			alert(response);
			$('#makePostTextbox').val($('#makePostTextbox').val() + ' http://trikl.com/photo/' + response);
			$("#dialog").dialog('close');
		}
	};
	$('#upload').submit(function() {
		$(this).ajaxSubmit(lulzoptions);
		return false;
	});
	$('#subimage').click(function() {
		$("#dialog").dialog(function() {});
	});
	var info = $(".post").attr('id');
	var data = '#' + info + '.post';
	$(data).click(function() {
		var info = $(".post").attr('id');
		$(data).show();
		var options = {
			resetForm: true,
			clearForm: true,
			url: "/stream",
			data: {
				post: info,
				"action": "comment",
			},
			success: function(response) {
				alert(response);
			},
		};
		$('.makeComment').ajaxForm(options);
		$('.makeCommentTextbox').autosize();
	});
	var sharediv = $(".post").each(function () {
		var share = '#' + $(this).attr('id') + '.share';
		var thispost = '#' + $(this).attr('id') + '.post';
		$(thispost).mouseover(function() {
			$(share).hide();
			$(share).show();
		});
		$('.post').mouseleave(function() {
			$(share).hide();
		})
	});
	var intval = setInterval(function() {
		streamUpdates()
	}, 3000);

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
				url: "/stream",
				data: {
					"PID": last,
					"action": "updates",
				},
				success: getResponse
			})
		}
		if (a) {
			$.ajax({
				type: "POST",
				url: "/stream",
				data: {
					"PID": a,
					"action": "updates",
				},
				success: getResponse
			})
		}
	};
	$("#newposts").click(function() {
		var a = $(".post").attr('id');
		$.ajax({
			type: "POST",
			url: "/stream",
			data: {
				"PID": a,
				"action": "new",
			},
			success: function(response) {
				$(response).prependTo("#streamlist"), clearInterval(intval), $("#newposts").hide()
				var intval = setInterval(function() {
					streamUpdates(last)
				}, 15000);
			}
		})
	});
	$(".postcontents").each(function() {
		var share = '#' + $(this).attr('id') + '.share';
		var thispost = '#' + $(this).attr('id') + '.postcontents';
		$(thispost).toggle(function() {
			$(this).css("background", "rgba(0,0,0,0.10)");
			$.ajax({
				type: "POST",
				url: "/stream",
				data: {
					"URL": $(this).attr('url'),
					"action": "geturl",
				},
				dataType: "json",
				success: function(response) {
					$(thispost).each(function() {
						var fuck = '#' + $(thispost).attr('id') + '.urldata';
						$(fuck).html(response);
						$(fuck).show();
					})
				}
			})
			var info = $(this).attr('id');
			var comments = '#' + $(this).attr('id') + '.comments';
			$(comments).show();
			var options = {
				resetForm: true,
				clearForm: true,
				data: {
					post: info,
				},
				success: function(response) {
					alert(response);
				},
			};
			$('.makeComment').ajaxForm(options);
			$('.makeCommentTextbox').autosize();
		}, function() {
			$(thispost).each(function() {
				var fuck = '#' + $(thispost).attr('id') + '.urldata';
				var comments = '#' + $(this).attr('id') + '.comments';
				$(fuck).hide();
				$(comments).hide();
				$(thispost).css("background", "rgba(0,0,0,0.00)");
			})
		});
	});
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

