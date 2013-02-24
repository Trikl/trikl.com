<div class="proset">
	<form method='post' id="changeprivacy">
		<fieldset class="privacyfields">
		<div class="small-input-field">

		<h5 class="longlable">Hide my Public Stream from</h5>
		<select name="hidestream">
			<option value="0" <?php if($settings['user']->getHideStream() === 0) { ?> selected="true" <?php } ?>>Nobody</option>
			<option value="1" <?php if($settings['user']->getHideStream() === 1) { ?> selected="true" <?php } ?>>Everyone but friends</option>
			<option value="2" <?php if($settings['user']->getHideStream() === 2) { ?> selected="true" <?php } ?>>Unregistered users</option>
		</select>
		</div>
		<div class="small-input-field">
		<h5 class="longlable">Enable Public Invisibility Cloak</h5>
		<select name="invisible">
			<option value="0" <?php if( $settings['user']->getInvisible() === 0) { ?> selected="true" <?php } ?>>No</option>
			<option value="1" <?php if( $settings['user']->getInvisible() === 1) { ?> selected="true" <?php } ?>>Yes</option>
		</select>
		</div>
				<input type='submit' value="Submit Privacy Settings" name='submit_privacy'>

		</fieldset>
		
	</form>
</div>


