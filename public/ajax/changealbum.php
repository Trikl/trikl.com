<?php 
		include 'include.php';

		$photos = PhotosQuery::create()->findOneByPhotoID($_POST['imageid']);
		$photos->setGalleryID('1');
		$photos->save();

