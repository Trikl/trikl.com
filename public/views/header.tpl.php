<!DOCTYPE HTML>
<html>
	  	<head >
			  	<title><?php if(isset($page_title)) echo $page_title; else echo "trikl"; ?></title>
				<base href="<?PHP echo SITE_ROOT; ?>">
				<?php if ($_SESSION['uid']) { ?>
						<link rel="stylesheet" type="text/css" href="public/css/loggedin.css" />
				<?php } else { ?>
						<link rel="stylesheet" type="text/css" href="public/css/style.css" />
				<?php } ?>
				<script type="text/javascript" src="<?php echo 'public/js/jquery-1.8.3.min.js'?>"></script>
				<script type="text/javascript" src="<?php echo 'public/js/jquery-ui-1.9.2.custom.min.js'?>"></script>
				<script type="text/javascript" src="<?php echo 'public/js/jquery.autosize-min.js'?>"></script>
				<script type="text/javascript" src="<?php echo 'public/js/trikl.js'?>"></script>
				<script type="text/javascript" src="<?php echo 'public/js/jquery.form.js'?>"></script>
				<head profile="http://www.w3.org/2005/10/profile">
				<link rel="icon" type="image/png" href="http://trikl.com/public/favicon.ico">
				<meta charset="UTF-8">
		</head>
		<body>
		<div style="height:100%;width:100%;background:black;position: fixed;top: 0;z-index: 1000;margin-left: -8px;opacity: .7;display:none;" id="blackout"> </div>
			<?php if ($_SESSION['uid']) { ?>
					<?php include 'views/menu.tpl.php'; ?>
			<?php } else { ?>
					<div class="usr_bg" style="background:url('public/images/logo/Small.png') no-repeat center;"></div>
					<?php include 'views/frontmenu.tpl.php'; ?>

			<?php } ?>
			<div class="contents">
					<?php if ($_SESSION['uid']) { ?>
						<div class="header" style="background:url('/public/photos/<?php echo $user->getBannerFilename(); ?>');">
							<form id="makePost" action="/stream" method="post">
								<textarea id="makePostTextbox" placeholder="Whats Trikling Through Your Mind?"  class="posttextarea" name="post"></textarea>
								<div id="options">
									<li id="subimage"> Upload Picture</li>
									<li id="subpost"> Post </li>
									<li> Search [incomplete] </li>
								</div>
									<img class="notif" src="http://trikl.com/public/images/icons/home.png" />
									<br />
									<div style="background:#CCC;display:hidden !important" id="notifications"></div>

							</form>
							<div id="newposts"></div>
							
							<div id="dialog" style="display:none;" title="Upload Image">
							    <div id="message"></div>
							    <form name="upload" id="upload" action="#" method="POST" enctype="multipart/form-data">
							                <input type="file" name="files[]" id="fileToUpload" multiple>
							                <input type="submit" id="uploadFile" value="Upload File">
							    </form>
							    <div id="uploader"></div>
							    
							    <div class="progress">
							        <div class="bar"></div >
							        <div class="percent">0%</div>
							    </div>						
						    </div>
						</div>
						
						
						<script>
							$(document).scroll(function(){
							    if ($(this).scrollTop()>0){
							        $('.header').stop().animate({ 'height': 45 },1);
							        $('.contents').css("margin-top", "45px");
							        $("#notifications").hide();
							    } else {
							        $('.header').stop().animate({ 'height': 120 },0);
							        $('.contents').css("margin-top", "120px");
							    }
						    }); 
						    
						    		$('.notif').toggle(function() {
								        $("#notifications").show();
								    }, function() {
								        $("#notifications").hide();
								    });
								    
								    

									   
									   $('#settings').click(function() {	
										$.ajax({
											type: "POST",
											url: "/settings",
											data: {
												"URL": $(this).attr('url'),
												"action": "geturl",
											},
											success: function(response) {
												//alert(response);
												$('#hey').html(response).hide().dialog(function() {});
												$('#blackout').show();
												$('.header').stop().animate({ 'height': 45 },1);
												$('.contents').css("margin-top", "45px");
												$('body').css("overflow", "hidden");
											}
										})
										$('div#hey').bind('dialogclose', function(event) {
												$('#blackout').hide();
												$('body').css("overflow", "scroll");
										});
										});

									   		
 
					    </script>
						
						
						<div id="hey" title="Settings">
					    </div>
						
					<?php } ?>

