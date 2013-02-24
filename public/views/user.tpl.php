<div class="header">
    <div id="omnibox">
        <?php include 'views/menu.tpl.php'; ?>
        <div id="omnitext">
            <form id="makePost" action="/stream" method="post">
                <textarea id="makePostTextbox" placeholder="Whats Trikling Through Your Mind?" class="posttextarea" name="post"></textarea>
            </form>
            <div id="dialog" style="display:none;" title="Upload Image">
                <div id="message"></div>
                <form id="upload" action="#" method="post" enctype="multipart/form-data">
                    <input type="file" name="files[]" id="fileToUpload" multiple> <input type="submit" id="uploadFile" value="Upload File">
                </form>
                <div id="uploader"></div>
                <div class="progress">
                    <div class="bar"></div>
                    <div class="percent">0%</div>
                </div>
            </div>
            <div id="blog" style="display:none;" title="Update Status">
                <form id="makeBlog" action="/stream" method="post">
                    <textarea id="makeBlogtextbox" placeholder="Whats Trikling Through Your Mind?" class="posttextarea" name="post"></textarea>
                    <div id="fullsizeopt">
                        <ul>
                            <li id="blogimage">Upload Picture</li>
                            <li id="blogpost">Post</li>
                            <li>Search [incomplete]</li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
        <div id="notification">
            <ul id="options">
                <li id="subpost">Post</li>
                <li id="subimage">Upload Picture</li>
                <li>Search [incomplete]</li>
            </ul>
            <div id="friendreq"></div>
            <div id="newmessages"></div>
            <div id="hey" style="display:none;"></div>
        </div>
        <div id="newposts"></div>
    </div>
</div>

<div class="contents">
