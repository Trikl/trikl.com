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
			var commentslast = '#' + thispostid + '.comments:last-child';
			var urldata = '#' + thispostid + '.urldata';
			$(thispost).hover(

			function() {
				$(share).show();
				$(thispostpost).css('border-color', '#b2b2b2');
			}, function() {
				$(share).hide();
				$(thispostpost).css('border-color', '#dadada');
			});
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
			$(".share,a,.pin").click(function(e) {
				e.stopPropagation();
			})
			$(".pin").click(function(e) {
				e.preventDefault();
			})
			var pins = "#" + thispostid + ".pin";
			$(pins).click(function() {
				$.ajax({
					type: "POST",
					url: "/global",
					data: {
						"id": thispostid,
						"action": "pinpost",
					},
					success: function(response) {
						alert(response);
					}
				})
			})
			$(thispost).click(function() {
				var commentoptions = {
					resetForm: true,
					clearForm: true,
					url: "/stream",
					data: {
						"parentid": thispostid,
						"action": "createpost",
					},
					success: function(response) {
						$.ajax({
							type: "POST",
							url: "/stream",
							data: {
								"PID": $(".commentcontents.last-child").attr('id'),
								"action": "newcomment",
							},
							success: function(response) {
								$('.commentlist').append(response);
							}
						})
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
				$('.commentlist :last-child').addClass("last-child");
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
			},
			success: function(response) {
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"PID": response,
						"action": "new",
					},
					success: function(insert) {
						$('#streamlist.stream').prepend(insert);
						streamUpdates();
					}
				})
			}
		};
		var posttext = '#makePostTextbox';

		function streamInt() {
			streamUpdates();
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
					console.log('streamupdater: ' + response);
					if (response > 0) {
						$("#newposts").html(response + ' new update').show();
					}
				},
			});
			$.ajax({
				type: "POST",
				url: "/global",
				data: {
					"action": "getNotifications",
				},
				success: function(response) {
					$("#friendreq").html(response);
				}
			})
			$.ajax({
				type: "POST",
				url: "/global",
				data: {
					"action": "generalNotifications",
				},
				success: function(response) {
					$("#general").html(response);
				}
			})
			$.ajax({
				type: "POST",
				url: "/global",
				data: {
					"action": "getMessages",
				},
				success: function(response) {
					$("#newmessages").html(response);
				}
			})
		};
		streamInt();
		$("#newposts").click(function() {
			$.ajax({
				type: "POST",
				url: "/stream",
				data: {
					"PID": $(".post").attr('id'),
					"action": "new",
				},
				success: function(response) {
					$('#streamlist.stream').prepend(response), $("#newposts").hide()
					clearInterval(intval);
					streamInt();
					postView();
				}
			})
		});
		$('#settings').click(function() {
			$.ajax({
				type: "POST",
				url: "/settings",
				success: function(response) {
					$("#friendreq,#newmessages").hide();
					$('#settingstoggle').html(response).toggle()
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
		$(posttext).on("keyup", function() {
			var postdata = $(posttext).val().length;
			if (postdata > 0) {
				$('.submitbar').show();
				$(posttext).addClass('activated');
				$('#options').css('display', 'inline-block');
			} else {
				$(posttext).removeClass('activated');
				$('#options,.submitbar,#upload').hide();
			}
		});
		$('#subpost').click(function() {
			$('#makePost').ajaxForm(commentoptions);
			$('#options,.submitbar,#upload').hide();
		});
		var streamupload = $('#subimage').upload({
			action: '/photo',
			params: {
				"action": "upload"
			},
			onComplete: function(response) {
				$(posttext).val($(posttext).val() + ' http://trikl.com/photo/' + response);
			}
		});
		$("#makePostTextbox,#settingstoggle,#editpost").click(function(e) {
			e.stopPropagation();
			e.preventDefault();
		})
		$("#settings,#newmessages,#friendreq,a,.replyform,#general,#subpost,#subimage,.submitbar").click(function(e) {
			e.stopPropagation();
		})
		$('#omnibox').click(function() {
			$('#friendreq,#newmessages,#general').toggle();
			$("#newmessages #expandedmessage,#settingstoggle").hide();
			$('.notification').click(function(e) {
				window.location.href = '/post/' + $(this).attr('id');
			});
			$('.buttonclear').click(function(e) {
				e.preventDefault();
				var id = $(this).attr('id');
				$.ajax({
					type: "POST",
					url: "/global",
					data: {
						"messageid": id,
						"action": "clearnotification",
					},
					success: function() {
						var notificationclear = "#" + $('.notification').attr('id') + ".notification.contractednotif";
						$(notificationclear).remove();
					}
				})
			});
			$('#supercompose').click(function(e) {
				e.preventDefault();
				var newmessage = {
					resetForm: true,
					clearForm: true,
					url: "/global",
					data: {
						"action": "createmessage",
					},
					success: function() {
						$('#sendmessage').toggle()
					}
				};
				$('#sendmessage').ajaxForm(newmessage).toggle().click(function(e) {
					e.stopPropagation();
				})
			});
			$("#friendreq").click(function() {
				$("#friendreq .expandnotif").toggle(function() {
					$('#friendreq').toggleClass('expandborder');
				});
				$('#friendreq .toggledown').toggleClass('toggleup')
				$("form,.expandnotif").click(function(e) {
					e.stopPropagation();
				});
				$('.friendrequest:last').addClass("last-notification");
			});
			$("#newmessages").click(function() {
				$("#newmessages #expandedmessage").toggle(function() {
					$('#newmessages').toggleClass('expandborder');
				});
				$('#newmessages .toggledown').toggleClass('toggleup')
				$("#expandedmessage").click(function(e) {
					e.stopPropagation();
				});
				$('.message:last').addClass("last-notification");
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
		var pathname = window.location.pathname;
		switch (pathname) {
		case '/':
			frontpage();
			break;
		case '/login':
			frontpage();
			break;
		case '/photo':
			photoupload();
			omnibar();
			postView();
			morePosts();
			break;
		case '/stream':
			omnibar();
			postView();
			morePosts();
			break;
		default:
			omnibar();
			postView();
			break;
		}
	});