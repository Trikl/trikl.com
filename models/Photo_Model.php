<?php
class Photo_Model {
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


	function upload($selectfiles) {

		$target = SERVER_ROOT . "/public/avatars";

		foreach ($selectfiles as $file) {
			foreach ($file['name'] as $key => $name) {
				$files[$key] = array(
					"name" => $name,
					"type" => $file['type'][$key],
					"size" => $file['size'][$key],
					"tmp" => $file['tmp_name'][$key],
					"error" => $file['error'][$key],

				);
			}
		}

		foreach ($files as $photo) {
			$newname = substr(uniqid(), 0 , 15);

			switch ($photo['type']):
			case 'image/jpeg':
				$image = @imagecreatefromjpeg($photo['tmp']);
			$name = $newname . ".jpg";
			if ($_POST['action'] === "uploadavatar") {
				$target = SERVER_ROOT . "/public/avatars/" . $name;
			} else {
				$target = SERVER_ROOT . "/public/photos/" . $name;
			}
			imagejpeg($image, $target);
			imagedestroy($image);
			break;
		case 'image/png':
			$image = @imagecreatefrompng($photo['tmp']);
			$name = $newname . ".png";
			if ($_POST['action'] === "uploadavatar") {
				$target = SERVER_ROOT . "/public/avatars/" . $name;
			} else {
				$target = SERVER_ROOT . "/public/photos/" . $name;
			}
			imagepng($image, $target);
			imagedestroy($image);
			break;
		case 'image/gif':
			$image = @imagecreatefromgif($photo['tmp']);
			$name = $newname . ".gif";
			if ($_POST['action'] === "uploadavatar") {
				$target = SERVER_ROOT . "/public/avatars/" . $name;
			} else {
				$target = SERVER_ROOT . "/public/photos/" . $name;
			}
			imagegif($image, $target);
			imagedestroy($image);
			break;
			endswitch;

			echo $name;

			switch ($_POST['action']):
			case 'uploadavatar':
				$user = UserQuery::create()->findPK($_SESSION['uid']);
				$user->setAvatarFilename($name);
				$user->save();
				break;
			case 'uploadbanner':
				$user = UserQuery::create()->findPK($_SESSION['uid']);
				$user->setBannerFilename($name);
				$user->save();
				break;
			default:
				$photo = new Photos();
				$photo->setUserID($_SESSION['uid']);
				$photo->setGalleryID('0');
				$photo->setPhotoName($name);
				$photo->setDate(date("r"));
				$photo->save();
				break;
			endswitch;


		}
	}


	function changealbum($imageid) {
		$photos = PhotosQuery::create()->findOneByPhotoID($imageid);
		$photos->setGalleryID('1');
		$photos->save();
	}


}