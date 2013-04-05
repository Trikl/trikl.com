
   	<div id="omnitext">
            <form id="makePost" action="/stream" method="post">
                <textarea id="makePostTextbox" placeholder="what's trikling" class="posttextarea" name="post"></textarea>
                    <div class="submitbar">
			            <form id="options">
			            	<input id="subpost" type="submit" value="post" />
			                <input id="subimage" type="submit" value="attach image" />
			                <input id="subsearch" value="search" type="submit" />

			            </form>
			        </div>
            </form>
        </div>

<div class="stream" id="streamlist">
<div class="postcontainer">
<?php include 'views/postpage.tpl.php'; ?>
</div>

</div>



<!-- <div id="page" class='more'> more </div> -->