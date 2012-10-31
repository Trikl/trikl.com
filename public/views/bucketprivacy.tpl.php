<h2>Bucket Settings:</h2>
	<h3>Create Buckets</h3>
		<p>Create buckets to place your friends into.</p>
		<form method='post'>
			<textarea placeholder="Bucket Name" style="resize:none;" name='bucket_name' maxlength="100" cols="40" rows="1"></textarea>
			<input type='submit' value='Submit' name='create_bucket' />
		</form>
		<?php if ($settings['hasbuckets']) { ?>
	<h3>Delete Buckets</h3>
		<p>Friends who are in deleted buckets will be moved to the public group. Posts that are part of deleted buckets will only be viewable by you </p>
		<form method='post'>
			<select name="bucketid">
				<option name="bucket_id" value="0">Public</option>
				<?php foreach($settings['buckets'] as $bucket) { ?><option value="<?php echo $bucket->getBucketid(); ?>"><?php echo $bucket->getBucketName(); ?></option><?php } ?>
			</select>
			<input type='submit' value="Delete" name='delete_bucket'>
		</form>
	<h3>Assign Buckets</h3>
		<p>Put your friends in your buckets.</p>
			<?php if ($settings['nbFriends'] != '0') { ?>
				<form method='post'>
					<select name="friend">
						<?php foreach($settings['friends'] as $friend){$friendname = UserQuery::create()->findPK($friend->getFriendid()); ?>
							<option value="<?php echo $settings['friendgroups']->getUserid(); ?>"><?php echo $friendname->getUsername(); ?></option><?php } ?>
					</select> 
					<select name="bucket">
						<option name="bucket_id" value="Public">Public</option>
						<?php foreach($settings['buckets'] as $bucket) { ?><option value="<?php echo $bucket->getBucketid(); ?>"><?php echo $bucket->getBucketName(); ?></option><?php } ?>
					</select>
					<input type='submit' value="submit" name='assign_bucket'>
				</form>
			<?php } else { ?>
				<p>You need friends to place them into buckets.</p>
			<?php } ?>
	<h3>Bucket Privacy</h3>
		<p>NOTE: Public peoples (both registered and unregistered) can view your profile, but cannot view sensitive info such as phone# and address.<br>TODO</p>
		<?php } ?>