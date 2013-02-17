<!DOCTYPE HTML>
<html>
	  	<head >
			  	<title><?php if(isset($page_title)) echo $page_title; else echo "Trikl"; ?></title>
				<base href="<?PHP echo SITE_ROOT; ?>">
				<script type="text/javascript" src="<?php echo 'public/js/jquery-1.8.3.min.js'?>"></script>
				<script type="text/javascript" src="<?php echo 'public/js/jquery-ui-1.9.2.custom.min.js'?>"></script>
				<script type="text/javascript" src="<?php echo 'public/js/jquery.autosize-min.js'?>"></script>
				<script type="text/javascript" src="<?php echo 'public/js/trikl.js'?>"></script>
				<script type="text/javascript" src="<?php echo 'public/js/jquery.form.js'?>"></script>
				<?php if ($_SESSION['uid']) { ?>
						<link rel="stylesheet" type="text/css" href="public/css/loggedin.css" />
				<?php } else { ?>
						<link rel="stylesheet" type="text/css" href="public/css/style.css" />
				<?php } ?>
				<head profile="http://www.w3.org/2005/10/profile">
				<link rel="icon" type="image/png" href="http://trikl.com/public/favicon.ico">
				<meta charset="UTF-8">
		</head>
		<body>
			<?php if ($_SESSION['uid']) { ?>
					<div id="blackout"> </div>
					<?php include 'views/user.tpl.php'; ?>
			<?php } else { ?>
					<?php include 'views/frontmenu.tpl.php'; ?>
			<?php } ?>
