<h2>Profile Settings:</h2>
<?php $settings = $data['settings'];?>

<?php if ($settings['user']->getAvatarFilename()) { ?>
<img style="width:128px" src="/public/avatars/<?php echo $settings['user']->getAvatarFilename(); ?>">
<?php } ?>

<form method="post" enctype="multipart/form-data">
	<input type="file" name="photo"> <input type="submit" name="upload" value="upload avatar">
</form>
<?php if (!$settings['profile']) { ?>
	<form method='post'>
		<textarea placeholder="Tell Us About Yourself...." name='bio' maxlength="100" cols="50" rows="4"></textarea><br>
		<textarea placeholder="Website" style="resize:none;margin:0px;" name='website' maxlength="100" cols="23" rows="1"></textarea>
		<textarea placeholder="Phone #" style="resize:none;margin:0px;" name='mynumber' maxlength="100" cols="23" rows="1"></textarea><br>
		<input type='submit' value='Submit' name='profile'>
	</form>
<?php } else { ?>
	<form method='post'>
		<textarea placeholder="Tell Us About Yourself...." style="resize:none;" name='bio' maxlength="100" cols="50" rows="4"><?php echo $settings['profile']->getBio(); ?></textarea><br>
		<textarea placeholder="Website" style="resize:none;margin:0px;" name='website' maxlength="100" cols="23" rows="1"><?php echo $settings['profile']->getWebsite(); ?></textarea> 
		<textarea placeholder="Phone #" style="resize:none;margin:0px;" name='mynumber' maxlength="100" cols="23" rows="1"><?php echo $settings['profile']->getPhone(); ?></textarea><br>
		<input type='submit' value='Submit' name='profile'>
	</form>
<?php } ?>
