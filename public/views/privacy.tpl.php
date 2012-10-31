<h2>Privacy Settings:</h2>
	<form method='post'>
		<span>Hide my Public Stream from:</span>
		<select name="hidestream">
			<option value="0" <?php if($settings['user']->getHideStream() === 0) { ?> selected="true" <?php } ?>>Nobody</option>
			<option value="1" <?php if($settings['user']->getHideStream() === 1) { ?> selected="true" <?php } ?>>Everyone except my friends</option>
			<option value="2" <?php if($settings['user']->getHideStream() === 2) { ?> selected="true" <?php } ?>>Just unregistered users</option>
		</select>
		<br />
		<span>Make me invisible to the world, except friends:</span>
		<select name="invisible">
			<option value="0" <?php if( $settings['user']->getInvisible() === 0) { ?> selected="true" <?php } ?>>No</option>
			<option value="1" <?php if( $settings['user']->getInvisible() === 1) { ?> selected="true" <?php } ?>>Yes</option>
		</select><br />
		<input type='submit' value="Submit Privacy Settings" name='submit_privacy'>
	</form>


