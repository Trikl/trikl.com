				<?php $user = UserQuery::create()->findPK($_SESSION['uid']); ?>

						<div class="header" style="background:url('/public/photos/<?php echo $user->getBannerFilename(); ?>');">
						<div id="omnibox"> 
							<?php include 'views/menu.tpl.php'; ?>

							<div id="omnitext">
								<form id="makePost" action="/stream" method="post">
									<textarea id="makePostTextbox" placeholder="Whats Trikling Through Your Mind?"  class="posttextarea" name="post"></textarea>
									<div id="options">
										<li id="subimage"> Upload Picture</li>
										<li id="subpost"> Post </li>
										<li> Search [incomplete] </li>
									</div>
								</form>
								<div id="dialog" style="display:none;" title="Upload Image">
								    <div id="message"></div>
								    <form name="upload" id="upload" action="#" method="POST" enctype="multipart/form-data">
								                <input type="file" name="files[]" id="fileToUpload" multiple>
								                <input type="submit" id="uploadFile" value="Upload File">
								    </form>
								    <div id="uploader"></div>
								    
								    <div class="progress">
								        <div class="bar"></div >
								        <div class="percent">0%</div>
								    </div>						
							    </div>
							</div>
										<div id="newposts"></div>

										<div style="display:inline-block;color:red;font-size:45px;line-height:36px;" class="notif"> ! </div>
										<br />
										<div style="background:#CCC;display:hidden !important" id="notifications"></div>
							</div>
							

						
					<!--	<script>
						$(document).scroll(function(){
							    if ($(this).scrollTop()>0){
							        $('.header').stop().animate({ 'height': 45 },1);
							        $('.contents').css("margin-top", "45px");
							        $("#notifications").hide();
							    } else {
							        $('.header').stop().animate({ 'height': 120 },0);
							        $('.contents').css("margin-top", "120px");
							    }
						    }); 
						    
						    		$('.notif').toggle(function() {
								        $("#notifications").show();
								    }, function() {
								        $("#notifications").hide();
								    });
								    
								    

	
									   		
 
					    </script> --> 
						
												</div>


				<div class="contents">
						<div id="hey" title="Settings">
					    </div>