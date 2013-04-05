	function postView() {
		$(".postcontents").each(function() {
			var thispost = '#' + $(this).attr('id') + '.postcontents';
			var thispostreply = '#' + $(this).attr('id') + '.postcontents .reply';
			var thispostcomment = '#' + $(this).attr('id') + '.postcontents .comment';
			var thispostid = $(this).attr('id');
			var thispostparent = $(this).attr('parent');
			var thispostpost = '#' + $(this).attr('id') + '.post';
			var thispostedit = '#editpost-' + $(this).attr('id');
			var posteditor = '#' + $(this).attr('id') + '.postcontents .editor';
			var posteditorcancel = '#' + $(this).attr('id') + '.postcontents .editor .cancel';
			var posteditorsave = '#' + $(this).attr('id') + '.postcontents .editor .save';
			var thispostdownvote = '#downvote-' + $(this).attr('id');
			var thispostupvote = '#upvote-' + $(this).attr('id');
			var share = '#' + $(this).attr('id') + '.share';
			var endcomments = '#' + thispostid + '.endcomments';
			var begincomments = '#' + thispostid + '.begincomments';
			var commentslast = '#' + thispostid + '.comments:last-child';
			var urldata = '#' + thispostid + '.urldata';
			var pins = "#" + thispostid + ".pin";
			
			$('#' + thispostid + '.delete').click(function(e) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					data: {
						"action": "deletepost",
						"post": thispostid,
					},
					success: function(response) {
						alert(response)
					}
				});
			});
			$(thispost).hover(

			function() {
				$(share).show();
				$(thispostpost).css('border-color', '#b2b2b2');
			}, function() {
				$(share).hide();
				$(thispostpost).css('border-color', '#dadada');
			});
			$('#' + thispostid + '.delete').click(function(e) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					data: {
						"action": "deletepost",
						"post": thispostid,
					},
					success: function() {
						$(thispostpost).remove();
					}
				});
			});
			$(thispostedit).click(function(e) {
				e.preventDefault();
				$(thispostcomment).replaceWith("<textarea class='comment'>" + $(thispostcomment).text() + "</textarea>");
				$(posteditor).toggle();
				$(posteditorsave).click(function(e) {
					var editsaving = $(thispostcomment).val();
					var editoptions = {
						url: "/stream",
						data: {
							"action": "editpost",
							"id": thispostid,
							"text": editsaving,
						},
						success: function(response) {
							$(posteditor).toggle();
							$(thispostcomment).replaceWith("<p class='comment'>" + $(thispostcomment).val() + "</p>");
						}
					};
					$('#saveEdit').ajaxForm(editoptions);
				})
				$(posteditorcancel).click(function(e) {
					e.stopPropagation();
					$(posteditor).toggle();
					$(thispostcomment).replaceWith("<p class='comment'>" + $(thispostcomment).text() + "</p>");
				})
			});
			$(thispostupvote).click(function(e) {
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"action": "upvote",
						"id": thispostid,
					},
					success: function(response) {
						alert(response);
					}
				})
			});
			$(thispostdownvote).click(function(e) {
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"action": "downvote",
						"id": thispostid,
					},
					success: function(response) {
						alert(response);
					}
				})
			});
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
			$(".share,a,.pin").click(function(e) {
				e.stopPropagation();
			})
			$(".pin").click(function(e) {
				e.preventDefault();
			})
			$(thispost).click(function() {
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"id": thispostid,
						"action": "endresponses",
					},
					success: function(response) {
						$('.rightpanel').html(response);
					}
				})
				$.ajax({
					type: "POST",
					url: "/stream",
					data: {
						"id": thispostparent,
						"action": "beginresponses",
					},
					success: function(response) {
						$(begincomments).html(response);
					}
				})
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
						});
					}
				}
				$(thispostreply).toggle();
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
				$(endcomments).toggle();
				$(begincomments).toggle();
				$('.makeComment').ajaxForm(commentoptions);
				$(thispost).toggleClass('postcontentsactive');
				$(thispostpost).toggleClass('postactive');
			});
		});
		$("a").click(function(event) {
				event.preventDefault();
				$.ajax({
					url: $(this).attr('href'),
					type: "POST",
					success: function(response) {
						$('#altcontents').html(response);
						$('#altcontents').show().animate({width: '500px'},300);
						$('.contents').animate({marginLeft: '0px'}, 300);
						$('#close').click(function() {
							$('.contents').animate({marginLeft: '210px'}, 300);
							$("#altcontents").hide();
						});
					}
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
					"PID": $(".postcontents").attr('id'),
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
					$("#expandedmessage").hide();
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
		$(posttext).keydown(function(e) {
			if (e.keyCode == 13 && e.shiftKey) {
				$('#subpost').click();
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
		$("#makePostTextbox,#settingstoggle").click(function(e) {
			e.stopPropagation();
			e.preventDefault();
		})
		$("#settings,#newmessages,#friendreq,a,.replyform,#general,#subpost,#subimage,.submitbar").click(function(e) {
			e.stopPropagation();
		})
		$('#omnibox').click(function() {
			var contentsmargin = $('.contents').css('margin-left')
			if (contentsmargin === "210px") {
			$('.contents').animate({marginLeft: '25px'}, 300);
			$('#altcontents').animate({marginLeft: '25px'}, 300);
			} else {
						$('#altcontents').animate({marginLeft: '25px'}, 300);

			$('.contents').animate({marginLeft: '0px'}, 300);
			}
			$('#friendreq,#newmessages,#general,#notification').toggle(
			function()
			{
				$(this).animate();
			}
			);
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
		$("#register").click(function() {
			$.ajax({
				url: 'public/views/register.tpl.php',
				success: function(data) {
					$('#register-band').html(data);
				}
			});
			var registerWidth = $("#register-band").outerWidth(true);
			if (!$("#register-container").is(':animated')) {
				if ($("#login-container").width() != 0) {
					$("#login-container").animate({
						"width": "0"
					}, {
						complete: function() {
							$("#register-container").animate({
								"width": registerWidth
							});
						}
					});
				} else {
					$("#register-container").animate({
						"width": registerWidth
					});
				}
			}
		});
		
		$("#login").click(function() {
			$.ajax({
				url: 'public/views/loginview.tpl.php',
				success: function(data) {
					$('#login-band').html(data);
				}
			});
			var loginWidth = $("#login-band").outerWidth(true);
			if (!$("#login-container").is(':animated')) {
				if ($("#register-container").width() != 0) {
					$("#register-container").animate({
						"width": "0"
					}, {
						complete: function() {
							$("#login-container").animate({
								"width": loginWidth
							});
						}
					});
				} else {
					$("#login-container").animate({
						"width": loginWidth
					});
				}
			}
		});
	};

	function thingsandstuff(info) {
		if (info > 0) {
			$(".submit").addClass("activated");
		} else {
			$(".submit").removeClass("activated");
		}
	}

	function formvalidation() {
		var taken;
		jQuery.validator.setDefaults({
			success: "valid",
			errorPlacement: function(error, element) {
				if (error) {
					error.appendTo('#errorcontainer-' + element.attr('id'));
					$('#errorcontainer-' + element.attr('id')).slideDown(300);
				}
			}
		});
		jQuery.extend(jQuery.validator.messages, {
			required: "required",
			email: "not a valid email address",
			maxlength: jQuery.validator.format("enter no more than {0} characters"),
			minlength: jQuery.validator.format("enter at least {0} characters"),
			rangelength: jQuery.validator.format("enter between {0} and {1} characters"),
			range: jQuery.validator.format("enter a value between {0} and {1}"),
			max: jQuery.validator.format("enter a value less than or equal to {0}."),
			min: jQuery.validator.format("enter a value greater than or equal to {0}.")
		});
		$.validator.addMethod('passreq', function(value, element) {
			return this.optional(element) || (value.match(/[a-zA-Z]/) && value.match(/[0-9]/));
		}, 'Must have a number and letter');
		$("#registeruser").validate({
			rules: {
				username: {
					required: true,
					rangelength: [3, 15],
					remote: {
						async: false,
						url: "/login",
						type: "POST",
						dataType: "json",
						data: {
							action: "usernamecheck",
							check: function() {
								return $("#username").val();
							}
						},
						complete: function() {}
					},
					success: function(data) {
						$("#errorcontainer-username").slideUp(300);
					}
				},
				email: {
					required: true,
					email: true,
					remote: {
						async: false,
						url: "/login",
						type: "POST",
						data: {
							action: "emailcheck",
							check: function() {
								return $("#email").val();
							}
						},
						complete: function() {
							alert($("#email").val())
						}
					},
					success: function(data) {
						$("#email").addClass('approvedfield');
					}
				},
				email_conf: {
					required: true,
					equalTo: "#email",
					email: true,
					success: function(data) {
						$("#email_conf").addClass('approvedfield');
					}
				},
				password: {
					required: true,
					passreq: true,
					rangelength: [7, 15],
					success: function(data) {
						$("#password").addClass('approvedfield');
					}
				},
				password_conf: {
					required: true,
					equalTo: "#password",
					success: function(data) {
						$("#password_conf").addClass('approvedfield');
					}
				},
				firstname: {
					required: true,
					success: function(data) {
						$("#firstname").addClass('approvedfield');
					}
				},
				lastname: {
					required: true,
					success: function(data) {
						$("#username").addClass('approvedfield');
					}
				}
			},
			submitHandler: function(form) {
				$(".submit").addClass("activated");
				form.submit();
				return false;
			},
			messages: {
				username: {
					remote: jQuery.format("{0} is already in use")
				},
				email: {
					remote: ("Email is already in use")
				}
			}
		});
		onkeyup: false;
		onblur: true;
	}

	function timeOutCheck() {
		$('.leftnotstream').animate({
			width: 'auto'
		}, {
			step: function(now, fx) {
				$('.content').hide();
			}
		});
	}

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
		jQuery.fn.animateAuto = function(prop, speed, callback) {
			var elem, height, width;
			return this.each(function(i, el) {
				el = jQuery(el), elem = el.clone().css({
					"height": "auto",
					"width": "auto"
				}).appendTo("body");
				height = elem.css("height"), width = elem.css("width"), elem.remove();
				if (prop === "height") el.animate({
					"height": height
				}, speed, callback);
				else if (prop === "width") el.animate({
					"width": width
				}, speed, callback);
				else if (prop === "both") el.animate({
					"width": width,
					"height": height
				}, speed, callback);
			});
		}
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