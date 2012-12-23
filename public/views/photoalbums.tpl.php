<div style="width:740px;height:100%;margin: 0 auto;">
		<h2> Albums </h2>
	<?php foreach ($data['galleries'] as $galleries) { ?>
		 		<div id='DROPABLE'>

 		<a href="/photo/<?php echo $galleries->getGalleryName();	?>">
	 		<img width='200' src='/public/photos/'/>
 		</a>
		 		</div>
 		<script>
 		        $(document).ready(function() {


 			 $('#DROPABLE').droppable( {
	 			 drop: function(event, ui) {
	 			   var draggable = ui.draggable;

		 			  		$.ajax({  
							    type: "POST",  
							    url: "/photo",
							    data : { "imageid" : draggable.attr('id'), "action" : "changealbum" },
							    success: function(response) {
								    alert("saved! "+response);
							    }
							});
	 			 }
    		});
          }); 

    	</script>
 	<?php } ?>	


		<h2> Album-less Photos </h2>
 	<?php foreach ($data['photos'] as $photos) { ?>
 		<div id='<?php echo $photos->getPhotoID();?>' class='photo'>
 		<a href="/photo/<?php echo $photos->getPhotoName();	?>">
	 		<img width='200' src='/public/photos/<?php echo $photos->getPhotoName();	?>'/>

 		</a>
 		</div>
 		
 			 <script>
	 		 $(document).ready(function() {
		 		 $('#<?php echo $photos->getPhotoID();	?>.photo').draggable();
		 		 });
	 		</script>
 	<?php } ?>
 
    <script type="text/javascript">
        $(document).ready(function() {

            

          }); 
    </script>
    
    
    		<h2> Upload Photos </h2>

    <div id="photomessage"></div>
    <form name="photoupload" id="photoupload" method="POST" enctype="multipart/form-data">
                <input type="file" name="files[]" id="fileToUpload" multiple>
                <input type="submit" id="uploadFile" value="Upload File">
    </form>
    <div id="uploader"></div>
    
    
    <div class="photoprogress">
        <div class="photobar"></div >
        <div class="photopercent">0%</div >
    </div>
    <br />
        <br />
    <br />

 		</div>

