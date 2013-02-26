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
								$('#editpost').toggle();
							}
						};
						$('#saveEdit').ajaxForm(editoptions);
						$('.cancel').click(function(e) {
							$('#editpost').toggle();
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
			$(".share,a").click(function(e) {
				e.stopPropagation();
			})
			$(thispost).click(function() {
				var commentoptions = {
					resetForm: true,
					clearForm: true,
					data: {
						post: thispostid,
						"action": "comment",
					}
				};
				if (!$.trim($(urldata).html()).length) {
					$.ajax({
						type: "POST",
						url: "/stream",
						data: {
							"URL": $(this).attr('url'),
							"action": "geturl",
						},
						success: function(response) {
							$(urldata).html(response).toggle();
						}
					})
				} else {
					$(urldata).toggle();
				}
				$(comments).toggle();
				$('.makeComment').ajaxForm(commentoptions);
				$(thispost).toggleClass('postcontentsactive');
				$(thispostpost).toggleClass('postactive');
			});
		});
	};

	function omnibar() {
		var commentoptions = {
			resetForm: true,
			clearForm: true,
			data: {
				"action": "createpost",
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
				$("#upload").toggle();
			}
		};
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
		$('#settings').click(function() {
			$.ajax({
				type: "POST",
				url: "/settings",
				success: function(response) {
					$("#friendreq,#newmessages").hide();
					$('#hey').html(response).toggle()
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
		});
		$('#makePost,#makeBlog').ajaxForm(commentoptions);
		$(posttext).on("keyup", function() {
			var postdata = $(posttext).val().length;
			if ($(posttext)[0].scrollHeight > 42) {
				$("#makeBlogtextbox").html($(posttext).val()).focus();
				$('.submitbar,#blog').toggle();
				$(posttext).val('');
			} else {
				if (postdata > 0) {
					$('.submitbar').show();
					$('#options').css('display', 'inline-block');
				} else {
					$('#options,.submitbar,#upload').hide();
				}
			}
		});
		$('#subpost').click(function() {
			$('#makePost').submit();
		});
		$('#blogpost').click(function() {
			$('#makeBlog').submit();
		});
		$('#subimage').click(function() {
			$("#upload").show().submit(function() {
				$(this).ajaxSubmit(streamphoto);
				return false;
			});
		});
		$("#makePostTextbox,#hey,#editpost,#options,#blog").click(function(e) {
			e.stopPropagation();
			e.preventDefault();
		})
		$('#omnibox').click(function() {
			$("#settings,#newmessages,#friendreq,a,.replyform").click(function(e) {
				e.stopPropagation();
			})
			$('#friendreq,#newmessages').toggle();
			$("#newmessages #expandedmessage,#hey").hide();
			$('#supercompose').click(function(e) {
				e.preventDefault();
				var newmessage = {
					resetForm: true,
					clearForm: true,
					url: "/global",
					data: {
						"action": "createmessage",
					},
					success: function(response) {
						$('#sendmessage').toggle()
					}
				};
				$('#sendmessage').ajaxForm(newmessage).toggle().click(function(e) {
					e.stopPropagation();
				})
			});
			$("#friendreq").click(function() {
				$("#friendreq .expandnotif").toggle();
				$('#friendreq .toggledown').toggleClass('toggleup')
				$("form,.expandnotif").click(function(e) {
					e.stopPropagation();
				});
			});
			$('body').click(function(event) {
				if (!$(event.target).is('#omnibox')) {
					$("#friendreq,#newmessages,#hey").hide();
				}
			});
			$("#newmessages").click(function() {
				$("#newmessages #expandedmessage").toggle();
				$('#newmessages .toggledown').toggleClass('toggleup')
				$("#expandedmessage").click(function(e) {
					e.stopPropagation();
				});
				$('.archive').click(function(event) {
					event.preventDefault();
					var id = $(this).attr('id');
					$.ajax({
						type: "POST",
						url: "/global",
						data: {
							"messageid": id,
							"action": "archivemessage",
						}
					})
				})
			});
		})
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

	function frontpage() {
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
	};

	function photoupload() {
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
	};

	$(document).ready(function() {
		jQuery.fx.off = true;
		omnibar();
		postView();
		morePosts();
		newPosts();
		frontpage();
		photoupload();
	});