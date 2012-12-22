<?php
$url = parse_url($_POST['URL']);

switch($url['host']) {
case 'imgur.com':
	$image = explode('/', $url['path']);
	$newPost .= "<img width='520' src='http://i.imgur.com/" . $image[2] . ".png' />";
	break;
case 'trikl.com':
	$image = explode('/', $url['path']);
	$newPost .= "<img width='520' src='/public/photos/" . $image[2] . "' />";
	break;
default:
	header('X-Frame-Options: GOFORIT');
	require_once('OpenGraph.php');
	$graph = OpenGraph::fetch($_POST['URL']);
	foreach ($graph as $key => $value) {
		$data[$key] = $value;
	}
	switch($data['type']) {
	case  'video':
		$video = parse_url($data['url']);
		switch($video['host']) {
		case 'www.youtube.com':
			parse_str($video['query'], $string);
			$newPost .= "<iframe width='520' height='315' src='http://www.youtube.com/embed/" . $string[v] . "' frameborder='0' allowfullscreen></iframe>";
			break;
		case 'vimeo.com':
			$newPost .= "<iframe src='http://player.vimeo.com/video" . $video['path'] . "?badge=0&amp;color=ffffff' width='520' height='315' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";
		}
		break;
		break;
	default:
		if ($data['image']) {
			$newPost .= "<div class='tags'>";
			$newPost .= "<a href='" . $data['url'] . "'>";
			$newPost .= "<img class='card_img' src='" . $data['image'] . "'/>";
			$newPost .= "<h4>" . $data['title'] . "</h4>";
			$newPost .= "<p>" . $data['description'] . "</p>";
			$newPost .= "<br />";
			$newPost .= "</a>";
			$newPost .= "</div>";
		}
	}

}



echo json_encode($newPost,JSON_FORCE_OBJECT);
