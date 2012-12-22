<?php 
$params = explode( "/", $_GET['p'] );
$page = $params['0'];
$subpage = $params['1'];

if ($subpage) {
	include 'views/individphoto.tpl.php';
} else {
	include 'views/photoalbums.tpl.php';
}

?>


