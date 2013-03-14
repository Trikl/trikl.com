<div class="proset">
<?php $settings = $data['settings'];?>
<div class="customization">


<div onclick="$('#bannerupload').click()" class="changebanner" id='banner' style="background:url('/public/photos/<?php echo $settings['user']->getBannerFilename(); ?>')" ></div>
	<div onclick="$('#avatarupload').click()" class="changeavatar">
		<img class="usr_img" id="avatar" src="/public/photos/<?php echo $settings['user']->getAvatarFilename(); ?>">
	</div> 
	
<style>
#avatarupload, #bannerupload {
	display:none;
}
</style>

<div id="avatardialog">

           <form name="avaupload" id="avaupload" >
                <input type="file" name="files[]" id="avatarupload">
            </form>
            
           <form name="bannupload" id="bannupload" >
                <input type="file" name="files[]" id="bannerupload">
            </form>    
</div> 


    <script type="text/javascript">
        $(document).ready(function() {
        	$("#avatardialog").click(function(e) {
				e.stopPropagation();
			});
			$("#bannerdialog").click(function(e) {
				e.stopPropagation();
			});
			$("#updatesettings").click(function(e) {
				e.stopPropagation();
			});	
        
					var avatarupload = {
						url: "/photo",
						data: {
							"action": "uploadavatar",
						},
						success: function(response) {
						var infos = '/public/photos/' + response;
							$('#avatar').attr('src', infos);
						}
						
					};
					
					$('#avatarupload').change(function () {
						$('#avaupload').ajaxForm(avatarupload).submit();
					})
					
					var bannerupload = {
						url: "/photo",
						data: {
							"action": "uploadbanner",
						},
						success: function(response) {
						var infos = 'url(/public/photos/' + response + ')';
							$('#banner').css('background', infos);
						}
						}
						

					
					$('#bannerupload').change(function () {
						$('#bannupload').ajaxForm(bannerupload).submit();
					})
		});
    </script>
 

     <div class="personalinfo">
       <?php if (!$settings['profile']) { ?>
	<form id="createsettings" method='post' style="text-align:center;">
		<div class="item big"><h4> Bio </h4><textarea placeholder="Tell Us About Yourself...." name='bio'></textarea></div>
		<div class="item"><h4> Website </h4><textarea placeholder="Website" style="resize:none;margin:0px;" name='website'></textarea></div>
		<div class="item"><h4> Phone Number </h4><textarea placeholder="Phone #" style="resize:none;margin:0px;" name='mynumber'></textarea></div>
		<input type='submit' value='Submit' name='profile'>
	</form>
<?php } else { ?>
	<form id="updatesettings" method='post' style="text-align:center;">
		<fieldset>
			<div class="item big"><h4>Bio</h4><textarea class="bigtext" placeholder="Bio" name='bio'><?php echo $settings['profile']->getBio(); ?></textarea></div>
			<div class="item"><h4>Website</h4><textarea class="smalltext" placeholder="Website" name='website'><?php echo $settings['profile']->getWebsite(); ?></textarea></div>
			<div class="item"><h4>Phone</h4><textarea class="smalltext" placeholder="Phone #" name='mynumber'><?php echo $settings['profile']->getPhone(); ?></textarea></div>
			<input type='submit' value='Submit' name='profile'>
		</fieldset>
	</form>
<?php } ?> 
     </div>
</div>