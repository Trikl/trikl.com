<?php 
	if(is_array($data['status'])){
		foreach ($data['status'] as $post) {
			include 'views/post.tpl';
		} 
	}else{
		echo "You don't have anything in your fucking stream!";
	}
?>