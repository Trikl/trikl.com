$(document).ready(function() {
	function postView() {
		$(".postcontents").each(function() {
			var thispost = '#' + $(this).attr('id') + '.postcontents';
			var thispostid = $(this).attr('id');
			var thispostpost = '#' + $(this).attr('id') + '.post';
			var thispostedit = '#editpost-' + $(this).attr('id');
			var posteditor = '#editor-' + thispostid;
			var thispostdownvote = '#downvote-' + $(this).attr('id');
			var thispostupvote = '#upvote-' + $(this).attr('id');
			var share = '#' + $(this).attr('id') + '.share';
			var comments = '#' + thispostid + '.comments';
			var urldata = '#' + thispostid + '.urldata';

			$(thispostedit).click(function(e) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"action": "loadedit",
						"id": thispostid,
					},
					success: function(response) {
						$('#editpost').html(response).show();
						var editoptions = {
							url: "/stream",
							data: {
								"action": "editpost",
								"id": $('#saveEdit').attr('post'),
							},
							success: function(response) {
								$('#editpost').hide();
							}
						};
						$('#saveEdit').ajaxForm(editoptions);		
						$('.cancel').click(function(e) {
							$('#editpost').hide();
						})
					}
				})
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
			$(".share").click(function(e) {
				e.stopPropagation();
			})
			$(thispost).toggle(function() {
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
				$(thispost).css("background", "rgba(0,0,0,0.10)");
				if ( !$.trim( $(urldata).html() ).length ) {
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"URL": $(this).attr('url'),
						"action": "geturl",
					},
					success: function(response) {
						$(urldata).html(response).show();
					}
				})
				} else {
					$(urldata).show();
				}
				$(comments).show();
				$(thispostpost).css("border-bottom", "1px solid #3584D8");
				$('.makeComment').ajaxForm(commentoptions);
				//$('.makeCommentTextbox').autosize();
				
			}, function() {
				$(urldata).hide();
				$(comments).hide();
				$(thispostpost).css("border-bottom", "1px solid rgba(0,0,0,0.0980392)");
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
				$("#upload").hide();
			}
		};
		$('#makePost').ajaxForm(commentoptions);
		$('#makeBlog').ajaxForm(commentoptions);
		
	
			

		$(posttext).on("keyup", function() {
			var postdata = $(posttext).val().length;
			if ($(posttext)[0].scrollHeight > 42) {
				$("#makeBlogtextbox").html($(posttext).val());
				$("#blog").show();
				$("#makeBlogtextbox").focus();
				$('.submitbar').hide();
				$(posttext).val('');
			} else { 
				if (postdata > 0) {
					$('.submitbar').show();
					$('#options').css('display', 'inline-block');
				} else {
					$('#options').hide();
					$('.submitbar').hide();
					$('#upload').hide();
				}
			}
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
		$("#upload").click(function(e) {
			e.stopPropagation();
		})
		$('#subimage').click(function() {
			$("#upload").show();
				$('#upload').submit(function() {
					$(this).ajaxSubmit(streamphoto);
					return false;
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

	function friendUpdates() {
		$.ajax({
			type: "POST",
			url: "/global",
			data: {
				"action": "getNotifications",
			},
			success: function(response) {
				$("#friendreq").html(response).hide();
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
			success: function(response) {
				$("#newmessages").html(response).hide();
			}
		})
	};
	friendUpdates();
	messageUpdates();
	$('#settings').toggle(function() {
		$.ajax({
			type: "POST",
			url: "/settings",
			data: {
				"URL": $(this).attr('url'),
				"action": "geturl",
			},
			success: function(response) {
				$("#friendreq").hide();
				$("#newmessages").hide();
				$('#hey').html(response).show()
				var createsettings = {
					url: "/settings",
					data: {
						"action": "createsettings",
					}
				};
				$('#createsettings').ajaxForm(createsettings);
				var changeprivacy = {
					url: "/settings",
					data: {
						"action": "changeprivacy",
					}
				};
				$('#changeprivacy').ajaxForm(changeprivacy);
				var updatesettings = {
					url: "/settings",
					data: {
						"action": "updatesettings",
					}
				};
				$('#updatesettings').ajaxForm(updatesettings);
			}
		})
	}, function() {
		$('#hey').hide()
	});
	$("#makePostTextbox").click(function(e) {
		e.stopPropagation();
	})
	$("#hey").click(function(e) {
		e.stopPropagation();
	})
	$("#editpost").click(function(e) {
			e.stopPropagation();
	})
	$("#options").click(function(e) {
		e.stopPropagation();
		e.preventDefault();
	})
	$("#blog").click(function(e) {
			e.stopPropagation();
	})
	$('#omnibox').toggle(function() {
		$(".settings").click(function(e) {
			e.stopPropagation();
		})
		$('#hey').hide();
		$("#friendreq").show();
		$("#newmessages").show();
		$("a").click(function(e) {
			e.stopPropagation();
		})

		$(".replyform").click(function(e) {
			e.stopPropagation();
		})
		$('#supercompose').toggle(function() {
			event.preventDefault();
			var newmessage = {
				resetForm: true,
				clearForm: true,
				url: "/global",
				data: {
					"action": "createmessage",
				},
				success: function(response) {
					alert(response);
				}
			};
			$('#sendmessage').ajaxForm(newmessage);
			$('#sendmessage').show()
			$("#sendmessage").click(function(e) {
				e.stopPropagation();
			})
		}, function() {
			$('#sendmessage').hide();
		});
		$("#friendreq").toggle(function() {
			$("#friendreq .expandnotif").show();
			$('#friendreq .toggledown').toggleClass('toggleup')
			$('#friendreq .toggledown').toggleClass('toggledown', false)
			$("form").click(function(e) {
				e.stopPropagation();
			});
		}, function() {
			$("#friendreq .expandnotif").hide();
			$('#friendreq .toggleup').toggleClass('toggledown')
			$('#friendreq .toggleup').toggleClass('toggleup', false)
		});
		$("#newmessages").toggle(function() {
			$("#newmessages #expandedmessage").show();
			$('#newmessages .toggledown').toggleClass('toggleup')
			$('#newmessages .toggledown').toggleClass('toggledown', false)
			$("#expandedmessage").click(function(e) {
				e.stopPropagation();
			})
			$('.archive').click(function(event) {
				event.preventDefault();
				var id = $(this).attr('id');
				$.ajax({
					type: "POST",
					url: "/global",
					data: {
						"messageid": id,
						"action": "archivemessage",
					},
					success: function(response) {
						alert(response);
					}
				})
			})
		}, function() {
			$("#newmessages #expandedmessage").hide();
			$('#newmessages .toggleup').toggleClass('toggledown')
			$('#newmessages .toggleup').toggleClass('toggleup', false)
		});
	}, function() {
		$("#friendreq").hide();
		$("#newmessages").hide();
		$("#newmessages #expandedmessage").hide();
		$("#friendreq .expandnotif").hide();
	});
	$('body').click(function(event) {
		if (!$(event.target).is('#omnibox')) {
			$("#friendreq").hide();
			$("#newmessages").hide();
			$("#hey").hide();
			$("#newmessages #expandedmessage").hide();
			$("#friendreq .expandnotif").hide();
		}
	});
});