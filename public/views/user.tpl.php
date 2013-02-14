				<?php $user = UserQuery::create()->findPK($_SESSION['uid']); ?>
						<!-- I really fucking hate the user banner idea, it takes away from clean simplicity, so ill leave this here for now: 
						<div class="header" style="background:url('/public/photos/<?php echo $user->getBannerFilename(); ?>');"> -->
						<div class="header" style="height:34px;">
						<div id="omnibox">
							<?php include 'views/menu.tpl.php'; ?>

							<div id="omnitext">
								<form id="makePost" action="/stream" method="post">
									<textarea id="makePostTextbox" placeholder="Whats Trikling Through Your Mind?"  class="posttextarea" name="post"></textarea>

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

										<br />
										<div id="notification">
											<ul id="options">
												<li id="subpost"> Post </li>
												<li id="subimage"> Upload Picture</li>
												<li> Search [incomplete] </li>
											</ul>
											<div id="friendreq"></div>
											<div id="newmessages"></div>
											
										</div>
										
																				<div id="newposts"></div>

							</div>
							

						
						<script>
								    
								    // make the whole bar clickable
								    $('#omnibox').toggle(function() {
								        $("#friendreq").show();
								    }, function() {
								        $("#friendreq").hide();
								    });

								    
								    

	
									   		
 
					    </script>
						
												</div>


				<div class="contents">
						<div id="hey" title="Settings">
					    </div>