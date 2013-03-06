    <div id="omnibox">
        <?php include 'views/menu.tpl.php'; ?>
        <div id="omnitext">
            <form id="makePost" action="/stream" method="post">
                <textarea id="makePostTextbox" placeholder="Whats Trikling Through Your Mind?" class="posttextarea" name="post"></textarea>
                    <div class="submitbar">
			            <form id="options">
			            			                <input id="subpost" type="submit" value="" />

			                <input id="subimage" type="submit" value="" />
			                <div style='display:none'><input type='file' name='ufile' id='ufile'/></div>
			                			                <input id="subsearch" value="" type="submit" />

			            </form>
			        </div>
            </form>
        </div>
        <div id="notification">
            <div id="streamorder"></div>
            <div id="friendreq"></div>
            <div id="newmessages"></div>
            <div id="hey" style="display:none;"></div>
            <div id="newposts"></div>
            <div id="editpost"></div>
            <div id="general"></div>
        </div>
    </div>

<div class="contents">
