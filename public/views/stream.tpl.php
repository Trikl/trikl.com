<div class="stream_cont">
		<?php
			$posts = $data['status'];
				foreach ($posts as $post) {
					$user = UserQuery::create()->findPK($post->getUserid());
					$text = $post->getStatus();
					$text = preg_replace('"\b(http://\S+)"', '<a href="$1">$1</a>', $text);
					$text = preg_replace( '/(?!<\S)~(\w+\w)(?!\S)/i', '<a href="http://trikl.com/profile/$1" target="_blank">~$1</a>', $text );
					include 'views/post.tpl';
			}
		?>
</div>
