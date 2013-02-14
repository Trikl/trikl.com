				<?php $user = UserQuery::create()->findPK($_SESSION['uid']); ?>
						<!-- I really fucking hate the user banner idea, it takes away from clean simplicity, so ill leave this here for now: 
						<div class="header" style="background:url('/public/photos/<?php echo $user->getBannerFilename(); ?>');"> -->
						<div class="header" style="height:34px;">
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
							    <div id="blog" style="display:none;" title="Update Status">
								<form id="makeBlog" action="/stream" method="post">
									<textarea id="makeBlogtextbox" placeholder="Whats Trikling Through Your Mind?"  class="posttextarea" name="post"></textarea>
									<div id="fullsizeopt">
										<li id="blogimage"> Upload Picture</li>
										<li id="blogpost"> Post </li>
										<li> Search [incomplete] </li>
									</div>
								</form>							    </div>

							</div>
										<div id="newposts"></div>

										<br />
										<div style="background:#444;display:hidden !important;margin-top:24px;border-top:1px solid #3584D8;" id="notifications"></div>
							</div>
							

						
						<script>
						    		// make the ! alert clickable
						    		$('.notif').toggle(function() {
								        $("#notifications").show();
								    }, function() {
								        $("#notifications").hide();
								    });
								    
								    // make the whole bar clickable
								    $('#omnibox').toggle(function() {
								        $("#notifications").show();
								    }, function() {
								        $("#notifications").hide();
								    });

								    
								    

	
									   		
 
					    </script>
						
												</div>


				<div class="contents">
						<div id="hey" title="Settings">
					    </div>