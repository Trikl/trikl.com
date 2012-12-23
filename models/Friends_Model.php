<?php
class Friends_Model
{
        // Get general friends info and return to page
        function friends() {
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

                        if ($userid != $user->getId() && $userid && $user->getId()) {
                                $friends = FriendQuery::create()
                                ->filterByUserid($_SESSION['uid'])
                                ->filterByFriendid($user->getId())
                                ->findOne();
                
                                if ($friends) {
                                $bucket = FriendBucketQuery::create()
                                ->filterByUserid($friends->getUserid())
                                ->findOne();
                                }
                        }
                        if ($nbFriends > 0) {
                                $friendslist = FriendQuery::create()
                                        ->filterByUserid($user->getId())
                                        ->find();
                                                        
                                // Load friends Userid's into array.
                                foreach ($friendslist as $friendlist) {
                                        $friendid = $friendlist->getFriendid();
                                        $groupid = $friendlist->getGroupid();
                                        $aFriends[$groupid] = $friendid;
                                }
                                
                                foreach ($aFriends as $aFriend) {
                                        $myfriend = UserQuery::create()
                                                ->findPK($aFriend);
                                                                                
                                                $friendList[] = array (
                                                        "username" => $myfriend->getUsername(),
                                                        "firstname" => $myfriend->getFirstname(),
                                                        "lastname" => $myfriend->getLastname(),
                                                );
                               }
                        }                 
                return $friendsList;  
        }
}
?>