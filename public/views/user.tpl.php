	<div id="container">


        <div id="log"></div>
        
        		<input id="action" placeholder="optional" type="hidden" value="<?php echo $_SESSION['uid'] ?>" />
		<input id="to" placeholder="to" type="text" />
        <input id="data" placeholder="data" type="text" />
        <button id="send">Send Text</button>
    </div>

    <div id="omnibox">
    	<input id='action' type='hidden' value='<?php echo $_SESSION['uid']; ?>'>
        <?php include 'views/menu.tpl.php'; ?>
        <div id="omnitext">
            <form id="makePost" action="/stream" method="post">
                <textarea id="makePostTextbox" placeholder="Whats Trikling Through Your Mind?" class="posttextarea" name="post"></textarea>
                    <div class="submitbar">
			            <form id="options">
			            	<input id="subpost" type="submit" value="" />
			                <input id="subimage" type="submit" value="" />
			                <input id="subsearch" value="" type="submit" />

			            </form>
			        </div>
            </form>
        </div>
        <div id="notification">
            <div id="streamorder"></div>
            <div id="friendreq"></div>
            <div id="newmessages"></div>
            <div id="settingstoggle" style="display:none;"></div>
            <div id="newposts"></div>
            <div id="general"></div>
        </div>
    </div>

<div class="contents">
