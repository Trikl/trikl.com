<h2>Profile Settings:</h2>
<?php $settings = $data['settings'];?>


<?php if (!$settings['profile']) { ?>
	<form method='post' style="text-align:center;">
		<textarea placeholder="Tell Us About Yourself...." name='bio' maxlength="100" cols="50" rows="4"></textarea><br>
		<textarea placeholder="Website" style="resize:none;margin:0px;" name='website' maxlength="100" cols="23" rows="1"></textarea>
		<textarea placeholder="Phone #" style="resize:none;margin:0px;" name='mynumber' maxlength="100" cols="23" rows="1"></textarea><br>
		<input type='submit' value='Submit' name='profile'>
	</form>
<?php } else { ?>
	<form method='post' style="text-align:center;">
		<textarea placeholder="Tell Us About Yourself...." style="resize:none;" name='bio' maxlength="100" cols="50" rows="4"><?php echo $settings['profile']->getBio(); ?></textarea><br>
		<textarea placeholder="Website" style="resize:none;margin:0px;" name='website' maxlength="100" cols="23" rows="1"><?php echo $settings['profile']->getWebsite(); ?></textarea> 
		<textarea placeholder="Phone #" style="resize:none;margin:0px;" name='mynumber' maxlength="100" cols="23" rows="1"><?php echo $settings['profile']->getPhone(); ?></textarea><br>
		<input type='submit' value='Submit' name='profile'>
	</form>
<?php } ?>

<?php if ($settings['user']->getAvatarFilename()) { ?>
<img style="width:60px;height:60px;float:left;" src="/public/avatars/<?php echo $settings['user']->getAvatarFilename(); ?>">

<?php } ?>


    <script type="text/javascript">
        $(document).ready(function() {
        	var bar = $('.bar');
			var percent = $('.percent');
			var status = $('#status');
        
            var options = {
            target: '#message', 
            data: { image: 'avatar' },
            url:'/public/ajax/upload.php', 
		    beforeSend: function() {
		        status.empty();
		        var percentVal = '0%';
		        bar.width(percentVal)
		        percent.html(percentVal);
		    },
		    uploadProgress: function(event, position, total, percentComplete) {
		        var percentVal = percentComplete + '%';
		        bar.width(percentVal)
		        percent.html(percentVal);
		    },
            success:  function() {
                $('#uploader').html('');

            }
            };

            $('#upload').submit(function() {
                $(this).ajaxSubmit(options);
                return false;
            });
        }); 
    </script>

    <div id="message"></div>
    <form name="upload" id="usrimgform" method="POST" enctype="multipart/form-data">
                <input type="file" name="files[]" id="fileToUpload">
                <input type="submit" id="uploadFile" value="Upload Avatar">
    </form>
        <div id="uploader"></div>


<!---
<form method="post" id="usrimgform" enctype="multipart/form-data">
	<input type="file" name="photo" id="usrimg">
	<input type="submit" name="upload" value="upload avatar">
</form>



 <form method="post" enctype="multipart/form-data">
	<input type="file" name="photo"> <input type="submit" name="banner" value="upload Banner">
</form> --->


