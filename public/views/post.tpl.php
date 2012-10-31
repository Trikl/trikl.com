

<div id="container">
	<div id="topContent" style="display:none;">
		<div class="inputpost">
			 <form method="post">
				 <textarea class="textarea" name="post" id="post" maxlength="500" cols="50" rows="2"></textarea>
				 <select name="bucketid">
					 <option name="bucket_id" value="NULL">NULL</option>
					 <?php foreach($buckets as $bucket) { ?>
					 	<option value="<?php echo $bucket->getBucketid(); ?>"><?php echo $bucket->getBucketName(); ?></option>
					 <?php } ?>
				</select>
				<input type="hidden" name="postchck" value="<?php echo $_SESSION['verify']; ?>">
				<input type="submit" class="submit_trikl" id="mlist_submit" name="mlist_submit" value="Trikl!"/>
			</form>
		</div>
		<hr />
	</div>
	<div id="bottomContent">
	</div>

	<a id="showHideTopContent">Post</a>
</div>





