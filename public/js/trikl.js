$(document).ready(function() {
	$(function() {
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
	});
	var last = 0;
	var showChar = 300;
	var ellipsestext = "...";
	var moretext = "Read More ->";
	var lesstext = "<- Read Less";
	$('.more').each(function() {
		var content = $(this).html();
		if (content.length > showChar) {
			var c = content.substr(0, showChar);
			var h = content.substr(showChar - 1, content.length - showChar);
			var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
			$(this).html(html);
		}
	});
	$(".morelink").click(function() {
		if ($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
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
	var options = {
		resetForm: true,
		clearForm: true
	};
	$('#makePost').ajaxForm(options);
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
			url: "/public/ajax/morepost.php",
			data: {
				"page": c
			},
			dataType: "json",
			success: function(response) {
				$(response).appendTo("#streamlist");
			}
		})
	});
	var bar = $('.bar');
	var percent = $('.percent');
	var status = $('#status');
	var options = {
		url: '/public/ajax/upload.php',
		beforeSend: function() {
			status.empty();
			var percentVal = '0%';
			bar.width(percentVal)
			percent.html(percentVal);
		},
		uploadProgress: function(event, position, total, percentComplete) {
			var percentVal = percentComplete + '%';
			bar.width(percentVal)
			percent.html(percentVal);
		},
		success: function(response) {
			$('#makePostTextbox').val($('#makePostTextbox').val() + ' http://trikl.com/photo/' + response);
			$("#dialog").dialog('close');
		}
	};
	$('#upload').submit(function() {
		$(this).ajaxSubmit(options);
		return false;
	});
	$('#subimage').click(function() {
		$("#dialog").dialog(function() {});
	});
});