<?php 
	if(is_array($data['status'])){
		foreach ($data['status'] as $post) {
			include 'views/post.tpl';
		} 
	}
?>