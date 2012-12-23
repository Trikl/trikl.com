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
				<meta charset="UTF-8">
		</head>
			<?php if ($_SESSION['uid']) { ?>
					<?php include 'views/menu.tpl.php'; ?>
			<?php } else { ?>
					<div class="usr_bg" style="background:url('public/images/logo/Small.png') no-repeat center;"></div>
					<?php include 'views/frontmenu.tpl.php'; ?>

			<?php } ?>
			<div class="contents">
					<?php if ($_SESSION['uid']) { ?>
						<form id="makePost" action="/stream" method="post">
							<textarea id="makePostTextbox" placeholder="Whats Trikling Through Your Mind?"  class="posttextarea" name="post"></textarea>
							<div id="options">
								<li id="subimage"> Upload Picture</li>
								<li id="subpost"> Post </li>
								<li> Search [incomplete] </li>
							</div>
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
					<?php } ?>

