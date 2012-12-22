<?php
	include 'include.php';


		foreach ($_FILES as $file) {
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
			$target = SERVER_ROOT . "/public/photos/" . $name; 
			imagejpeg($image, $target);
			imagedestroy($image);
			break;
		case 'image/png':
			$image = @imagecreatefrompng($photo['tmp']);
			$name = $newname . ".png";
			$target = SERVER_ROOT . "/public/photos/" . $name; 
			imagepng($image, $target);
			imagedestroy($image);
			break;
		case 'image/gif':
			$image = @imagecreatefromgif($photo['tmp']);
			$name = $newname . ".gif";
			$target = SERVER_ROOT . "/public/photos/" . $name; 
			imagegif($image, $target);
			imagedestroy($image);
			break;
	endswitch;
	
		echo $name;

		$photo = new Photos();
		$photo->setUserID($_SESSION['uid']);
		$photo->setGalleryID('0');
		$photo->setPhotoName($name);
		$photo->setDate(date("r"));
		$photo->save();

}


		
