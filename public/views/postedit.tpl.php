<?php $post = $data['status'];
 ?>

<div id="editor-<?php echo $post['pid']; ?>" title="Edit Post">
	<form id="saveEdit" action="/stream" method="post" post="<?php echo $post['pid']; ?>">
		<textarea id="editPostBox" name="edit"><?php $result = preg_replace('#(<a[^>]*>).*?(</a>)#', '$1$2', $post['text']); $result .= " " . $post['url']; echo strip_tags($result); ?></textarea>
		<input type="submit" value="Save Edit" />
	</form>
</div>