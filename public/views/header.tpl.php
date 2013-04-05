<!DOCTYPE HTML>
<html>
	  	<head>
			  	<title><?php if(isset($page_title)) echo $page_title; else echo "Trikl"; ?></title>
				<base href="<?PHP echo SITE_ROOT; ?>">
				<script src="public/js/jquery-1.9.1.min.js"></script>
				<script src="public/js/jquery-ui-1.10.1.custom.min.js"></script>
				<script src="public/js/jquery.form-3.27.0.js"></script>
				<script src="public/js/jquery.ocupload-min.js"></script>
				<script src="public/js/json2.js"></script>
				<script src="public/js/coffeescript/jsmaker.php?f=generalchat.coffee"></script>
				<script src="public/js/jquery.fileupload.js"></script>
				<script src="public/js/jquery.ezmark.min.js"></script>
				<script src="public/js/jquery.validate.min.js"></script>
				<!--[if lt IE 9]>
					<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
				<![endif]-->


				<script src="public/js/trikl-1.9.1.js"></script>
				<?php if ($_SESSION['uid']) { ?>
						<link rel="stylesheet" type="text/css" href="public/css/loggedin.css" />
				<?php } else { ?>
						<link rel="stylesheet" type="text/css" href="public/css/style.css" />
				<?php } ?>
				<head profile="http://www.w3.org/2005/10/profile">
				<link rel="icon" type="image/png" href="public/favicon-new.ico">
				<meta charset="UTF-8">
		</head>
		<body>
			<?php if ($_SESSION['uid']) { ?>
					<div class="head"> <a href="Logout">logout</a> </div>
					<div class="foot"><a href="about">about</a></div>
					

					<?php include 'views/user.tpl.php'; ?>

			<?php } else { ?>
					<?php include 'views/frontmenu.tpl.php'; ?>
			<?php } ?>
