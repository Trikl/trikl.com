
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(15) NOT NULL,
    `password` VARCHAR(75) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `activate_code` VARCHAR(10) NOT NULL,
    `is_activated` INTEGER(1) DEFAULT 1 NOT NULL,
    `avatar_filename` VARCHAR(50) NOT NULL,
    `banner_filename` VARCHAR(50) NOT NULL,
    `hide_stream` INTEGER(1) DEFAULT 0 NOT NULL,
    `invisible` INTEGER(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- friends
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `friends`;

CREATE TABLE `friends`
(
    `groupid` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `userid` INTEGER(50) NOT NULL,
    `friendid` INTEGER(50) NOT NULL,
    PRIMARY KEY (`groupid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- friend_requests
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `friend_requests`;

CREATE TABLE `friend_requests`
(
    `requestid` INTEGER(255) NOT NULL AUTO_INCREMENT,
    `userid` INTEGER(255) NOT NULL,
    `friendid` INTEGER(255) NOT NULL,
    PRIMARY KEY (`requestid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status`
(
    `postid` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `userid` INTEGER(50) NOT NULL,
    `bucketid` INTEGER(50) NOT NULL,
    `date` DATETIME NOT NULL,
    `status` VARCHAR(500) NOT NULL,
    `drops` INTEGER(11) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`postid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- profile
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile`
(
    `userid` INTEGER(50) NOT NULL,
    `phone` VARCHAR(10) NOT NULL,
    `bio` VARCHAR(100) NOT NULL,
    `website` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`userid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user_buckets
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_buckets`;

CREATE TABLE `user_buckets`
(
    `bucketid` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `userid` INTEGER(50) NOT NULL,
    `bucket_name` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`bucketid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- user_bucket_friend
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user_bucket_friend`;

CREATE TABLE `user_bucket_friend`
(
    `bucketid` INTEGER(50) NOT NULL,
    `userid` INTEGER(50) NOT NULL,
    PRIMARY KEY (`bucketid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- galleries
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `galleries`;

CREATE TABLE `galleries`
(
    `GalleryID` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `UserID` INTEGER(50) NOT NULL,
    `GalleryName` VARCHAR(50) NOT NULL,
    `Date` DATETIME NOT NULL,
    PRIMARY KEY (`GalleryID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- photos
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `photos`;

CREATE TABLE `photos`
(
    `PhotoID` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `UserID` INTEGER(50) NOT NULL,
    `GalleryID` INTEGER(50) NOT NULL,
    `PhotoName` VARCHAR(50) NOT NULL,
    `Date` DATETIME NOT NULL,
    PRIMARY KEY (`PhotoID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- comments
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments`
(
    `PostID` INTEGER(50) NOT NULL,
    `CommentID` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `UserID` INTEGER(50) NOT NULL,
    `Date` DATETIME NOT NULL,
    `Content` VARCHAR(500) NOT NULL,
    `Tier` INTEGER(11) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`CommentID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- message_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `message_users`;

CREATE TABLE `message_users`
(
    `id` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `MessageID` INTEGER(50),
    `UserID` INTEGER(50),
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- message_contents
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `message_contents`;

CREATE TABLE `message_contents`
(
    `MessageID` INTEGER(50),
    `ThreadID` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `UserID` INTEGER(50),
    `Content` VARCHAR(500),
    `Date` DATETIME,
    PRIMARY KEY (`ThreadID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- messages
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages`
(
    `MessageID` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `Date` DATETIME NOT NULL,
    `Subject` VARCHAR(500) NOT NULL,
    PRIMARY KEY (`MessageID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- votes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `votes`;

CREATE TABLE `votes`
(
    `voteid` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `postid` INTEGER(50),
    `userid` INTEGER(50),
    `value` INTEGER(50),
    PRIMARY KEY (`voteid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- url
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `url`;

CREATE TABLE `url`
(
    `urlid` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `urlhost` VARCHAR(255) NOT NULL,
    `urlpath` VARCHAR(255) NOT NULL,
    `urlquery` VARCHAR(255) NOT NULL,
    `contenttype` VARCHAR(255) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `content` VARCHAR(255) NOT NULL,
    `contentimg` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`urlid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- post_url
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `post_url`;

CREATE TABLE `post_url`
(
    `posturlid` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `urlid` INTEGER(50),
    `postid` INTEGER(50),
    PRIMARY KEY (`posturlid`)
) ENGINE=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
