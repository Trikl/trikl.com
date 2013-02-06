
<style>

</style>



<div class="proset">
<?php $settings = $data['settings'];?>

<?php if ($settings['user']->getAvatarFilename()) { ?>
<h4> Change Avatar: </h4><img id="avatar" src="/public/avatars/<?php echo $settings['user']->getAvatarFilename(); ?>">

<?php } else { ?>
<h4> Change Avatar: </h4><img id="avatar" src="/public/avatars/">

<?php } ?>

<?php if ($settings['user']->getBannerFilename()) { ?>
<h4> Change Banner: </h4><img id="banner" src="/public/banner/<?php echo $settings['user']->getBannerFilename(); ?>">

<?php } else { ?>
<h4> Change Banner: </h4><img id="banner" src="/public/avatars/">

<?php } ?>


    <script type="text/javascript">
        $(document).ready(function() {
			var bar = $('.avabar');
			var percent = $('.avapercent');
			var status = $('#avastatus');
			var options = {
				target: '#avamessage',
				url: '/photo',
				beforeSend: function() {
					status.empty();
					var percentVal = '0%';
					bar.width(percentVal)
					percent.html(percentVal);
				},
				data: {
					"action": "uploadavatar",
				},
				uploadProgress: function(event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					bar.width(percentVal)
					percent.html(percentVal);
				}
			};			
			$('#avaupload').submit(function() {
				$(this).ajaxSubmit(options);
				return false;
			});
		$('#avatar').click(function() {
			$("#avatardialog").dialog(function() {});
		});
		            
		               	var bar = $('.bannbar');
			var percent = $('.bannpercent');
			var status = $('#bannstatus');
			var options = {
				target: '#bannmessage',
				url: '/photo',
				beforeSend: function() {
					status.empty();
					var percentVal = '0%';
					bar.width(percentVal)
					percent.html(percentVal);
				},
				data: {
					"action": "uploadbanner",
				},
				uploadProgress: function(event, position, total, percentComplete) {
					var percentVal = percentComplete + '%';
					bar.width(percentVal)
					percent.html(percentVal);
				}
			};			
			$('#bannupload').submit(function() {
				$(this).ajaxSubmit(options);
				return false;
			});
		$('#banner').click(function() {
			$("#bannerdialog").dialog(function() {});
		});
    
		            
 		        }); 
		        
		    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);

                }

                reader.readAsDataURL(input.files[0]);
                $('#imagepreview').show();
            }
            
            }


    </script>
<div id="avatardialog" style="display:none;" title="Upload Avatar">
		<div id="imagepreview">
		<h3>Avatar Preview</h3>
	        <img id="blah" src="#" alt="your image" />
		</div>

    <div id="avamessage"></div>
    <form name="avaupload" id="avaupload" method="POST" enctype="multipart/form-data">
                <input type="file" onchange="readURL(this);" name="files[]" id="fileToUpload" multiple>
                <input type="submit" id="uploadFile" value="Upload File">
    </form>
    <div id="uploader"></div>
    
    
    <div class="avaprogress">
        <div class="avabar"></div >
        <div class="avapercent">0%</div >
    </div>
</div>  

<div id="bannerdialog" style="display:none;" title="Upload Avatar">
		<div id=" imagepreview">
		<h3>Avatar Preview</h3>
	        <img id="bannerblah" src="#" alt="your image" />
		</div>

    <div id="bannmessage"></div>
    <form name="bannupload" id="bannupload" method="POST" enctype="multipart/form-data">
                <input type="file" onchange="readURL(this);" name="files[]" id="fileToUpload" multiple>
                <input type="submit" id="uploadFile" value="Upload File">
    </form>
    <div id="uploader"></div>
    
    
    <div class="avaprogress">
        <div class="bannbar"></div >
        <div class="bannpercent">0%</div >
    </div>
</div>   
        
       <?php if (!$settings['profile']) { ?>
	<form method='post' style="text-align:center;">
		<h4> Change Avatar: </h4><textarea placeholder="Tell Us About Yourself...." name='bio' maxlength="100" cols="50" rows="4"></textarea><br>
		<h4> Change Avatar: </h4><textarea placeholder="Website" style="resize:none;margin:0px;" name='website' maxlength="100" cols="23" rows="1"></textarea>
		<h4> Change Avatar: </h4><textarea placeholder="Phone #" style="resize:none;margin:0px;" name='mynumber' maxlength="100" cols="23" rows="1"></textarea><br>
		<input type='submit' value='Submit' name='profile'>
	</form>
<?php } else { ?>
	<form method='post' style="text-align:center;">
		<fieldset>
		<div class="input-field">
		<h5 class="bigtextlabel">Bio</h5><textarea class="bigtext" placeholder="Tell Us About Yourself...." style="resize:none;" name='bio' maxlength="100" cols="50" rows="4"><?php echo $settings['profile']->getBio(); ?></textarea>
		</div>
		<div class="small-input-field">

		<h5 class="smalltextlabel">Website</h5><textarea class="smalltext" placeholder="Website" style="resize:none;margin:0px;" name='website' maxlength="100" cols="23" rows="1"><?php echo $settings['profile']->getWebsite(); ?></textarea>
				</div>
		<div class="small-input-field">

		<h5 class="smalltextlabel">Phone</h5><textarea class="smalltext" placeholder="Phone #" style="resize:none;margin:0px;" name='mynumber' maxlength="100" cols="23" rows="1"><?php echo $settings['profile']->getPhone(); ?></textarea>
						</div>
		<input type='submit' value='Submit' name='profile'>
		</fieldset>
	</form>
<?php } ?> 

</div>

<!--
<form method="post" id="usrimgform" enctype="multipart/form-data">
	<input type="file" name="photo" id="usrimg">
	<input type="submit" name="upload" value="upload avatar">
</form>



 <form method="post" enctype="multipart/form-data">
	<input type="file" name="photo"> <input type="submit" name="banner" value="upload Banner">
</form> --->


