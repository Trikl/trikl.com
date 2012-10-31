<!DOCTYPE HTML>
<html>
	  	<head>
			  	<title><?php if(isset($page_title)) echo $page_title; else echo "trikl"; ?></title>
				<base href="http://bitpul.se/">
				<?php if ($_SESSION['uid']) { ?>
						<link rel="stylesheet" type="text/css" href="public/css/loggedin.css" />
				<?php } else { ?>
						<link rel="stylesheet" type="text/css" href="public/css/style.css" />
				<?php } ?>
				<script language="javascript" type="text/javascript" src="<?php echo 'public/js/jquery-1.8.2.min.js'?>"></script>
				<script language="javascript" type="text/javascript" src="<?php echo 'public/js/trikl.js'?>"></script>
		</head>
		<body>
			<?php if ($_SESSION['uid']) { include SERVER_ROOT . '/lib/global_post.php';?>
			 	<div class="wrapper">
				  	<div class="sidebar">
					   	<div class="logo">
					   		<a href="/" alt="Click Here!" border="0"><img src="public/images/logo/smlogo.png" alt="logo"></a>
					   	</div>
					   	<?php include 'views/menu.tpl.php'; ?>
					   </div>
			<?php } else { ?>
				<div class="wrapper">
					<div class="logo">
						<a href="/" alt="Click Here!" border="0"><img src="public/images/logo/logo.png" alt="logo"></a>
					</div>
			<?php } ?>
			<div class="contents">

