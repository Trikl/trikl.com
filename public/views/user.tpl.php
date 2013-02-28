<div class="header">
    <div id="omnibox">
        <?php include 'views/menu.tpl.php'; ?>
        <div id="omnitext">
            <form id="makePost" action="/stream" method="post">
                <textarea id="makePostTextbox" placeholder="Whats Trikling Through Your Mind?" class="posttextarea" name="post"></textarea>
            </form>
        </div>
        <div id="notification">
        	<div class="submitbar">
	            <form id="options">
	                <input id="subpost" type="submit" value="Post" />
	                <input id="subimage" type="submit" value="Upload Image" />
	                <input value="Search [incomplete]" type="submit" />
	            </form>
	            <form id="upload" action="#" method="post" enctype="multipart/form-data">
		           <input type="file" name="files[]" id="fileToUpload" multiple> <input type="submit" id="uploadFile" value="Upload File">
		           <div class="progress">
			           <div class="percent">0%</div>
		           </div>
		        </form>
	        </div>
	        <div id="blog" style="display:none;" title="Update Status">
                <form id="makeBlog" action="/stream" method="post">
                    <textarea id="makeBlogtextbox" placeholder="Whats Trikling Through Your Mind?" class="posttextarea" name="post" ></textarea>
                    <div id="fullsizeopt">
		                <form id="options">
			                <input id="blogpost" type="submit" value="Post" />
			                <input id="blogimage" type="submit" value="Upload Image" />
			            </form>
			            <form id="upload" action="#" method="post" enctype="multipart/form-data">
				           <input type="file" name="files[]" id="fileToUpload" multiple> <input type="submit" id="uploadFile" value="Upload File">
				           <div class="progress">
					           <div class="percent">0%</div>
				           </div>
				        </form>
                    </div>
                </form>
            </div>
            <div id="friendreq"></div>
            <div id="newmessages"></div>
            <div id="hey" style="display:none;"></div>
            <div id="newposts"></div>
            <div id="editpost"></div>
            <div id="general"></div>
        </div>
    </div>
</div>

<div class="contents">
