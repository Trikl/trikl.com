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
    </div>
    
        <div id="notification">
            <div id="streamorder"></div>
            <div id="friendreq"></div>
            <div id="newmessages"></div>
            <div id="settingstoggle" style="display:none;"></div>
            <div id="newposts"></div>
            <div id="general"></div>
        </div>
        <div id="altcontents"></div>

<div class="contents">
