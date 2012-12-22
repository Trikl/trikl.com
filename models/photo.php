<?php
class Photo_Model
{
	function wildphotos() {
		$photos = PhotosQuery::create()
			->filterByUserID($_SESSION['uid'])
			->filterByGalleryID('0')
			->find();
		
		
		return $photos;
	}
	
	function galleries() {
		$galleries = GalleriesQuery::create()->findByUserID($_SESSION['uid']);
		
		return $galleries;
	}
}