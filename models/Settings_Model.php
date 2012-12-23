<?php
class Settings_Model
{
	// Get general settings info and return to page
	function settings() {
		$user = UserQuery::create()->findPK($_SESSION['uid']);
		$profile = ProfileQuery::create()->findPK($_SESSION['uid']);
		$friends = FriendQuery::create()->findByUserid($_SESSION['uid']);
		$friendgroups = FriendQuery::create()->findOneByFriendid($_SESSION['uid']);
		$buckets = BucketQuery::create()->findByUserid($_SESSION['uid']);
		$hasbuckets = BucketQuery::create()->findOneByUserid($_SESSION['uid']);
		$nbFriends = FriendQuery::create()->filterByUserid($_SESSION['uid'])->count($con);
		
		$info = array (
			"user" => $user,
			"profile" => $profile,
			"friends" => $friends,
			"friendgroups" => $friendgroups,
			"buckets" => $buckets,
			"hasbuckets" => $hasbuckets,
			"nbFriends" => $nbFriends,
		);
		
		return $info;
	}
	
	// Save Profile
	function saveProfile() {
		$profile = ProfileQuery::create()->findPK($_SESSION['uid']);
		$profile->setPhone($_POST['mynumber']);
		$profile->setBio($_POST['bio']);
		$profile->setWebsite($_POST['website']);
		$profile->save();
		echo "Updated Profile Info";
		header("Location: /settings");
	}
	
	//create Profile
	function createProfile() {
		$profile = new Profile();
		$profile->setUserid($_SESSION['uid']);
		$profile->setPhone($_POST['mynumber']);
		$profile->setBio($_POST['bio']);
		$profile->setWebsite($_POST['website']);
		$profile->save();
		echo "Created Profile Info";
		header("Location: /settings");
	}
	
	// upload avatar
	function avatar() {
		$target = SERVER_ROOT . "/public/avatars";  // Saved image location
		$allowedExts = array("jpg", "jpeg", "png"); // allowed extensions
		$temp_filename = pathinfo($_FILES["photo"]["name"]);
		$filename = $_SESSION['uid'].".".$temp_filename['extension'];
		$file_target = $target."/".$filename;
		move_uploaded_file($_FILES["photo"]["tmp_name"], $file_target);
		$user = UserQuery::create()->findPK($_SESSION['uid']);
			$user->setAvatarFilename($filename);
			$user->save();

	}
	
	// upload banner
	function banner() {
		$target = SERVER_ROOT . "/public/banner";  // Saved image location
		$allowedExts = array("jpg", "jpeg", "png"); // allowed extensions
		$temp_filename = pathinfo($_FILES["photo"]["name"]);
		$filename = $_SESSION['uid'].".".$temp_filename['extension'];
		$file_target = $target."/".$filename;
		move_uploaded_file($_FILES["photo"]["tmp_name"], $file_target);
		$user = UserQuery::create()->findPK($_SESSION['uid']);
			$user->setBannerFilename($filename);
			$user->save();

	}
	
	// create bucket
	function createBucket() {
		$bucket = new Bucket();
		$bucket->setUserid($_SESSION['uid']);
		$bucket->setBucketName($_POST['bucket_name']);
		$bucket->save();
	}
	
	// delete bucket
	function deleteBucket() {
		$bucket = BucketQuery::create()->findOneByBucketid($_POST['bucketid']);
		$bucket->delete();
		$bucketfriend = FriendQuery::create()
		->filterbyBucketid($_POST['bucketid'])
		->update(array('bucketid' => '0'));
	}
	
	// assign bucket -> friend
	function assignBucket() {
		echo $_POST['friend'];
		echo $_POST['bucket'];
		$bucketfriend = new FriendBucket();
		$bucketfriend->setUserid($_POST['friend']);
		$bucketfriend->setBucketid($_POST['bucket']);
		$bucketfriend->save();
	}
	
	// privacy settings
	function privacy() {
		$user = UserQuery::create()->findPK($_SESSION['uid']);
		$user->setInvisible($_POST['invisible']);
		$user->setHideStream($_POST['hidestream']);
		$user->save();
	}
}