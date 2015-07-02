-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 23 dec 2014 om 13:34
-- Serverversie: 5.5.27
-- PHP-versie: 5.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `mycommunity`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accountrights`
--

CREATE TABLE IF NOT EXISTS `accountrights` (
  `accountID` INT(11)     NOT NULL AUTO_INCREMENT,
  `rightType` VARCHAR(55) NOT NULL,
  PRIMARY KEY (`accountID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `accountsID` INT(11)      NOT NULL AUTO_INCREMENT,
  `username`   VARCHAR(255) NOT NULL,
  `password`   VARCHAR(255) NOT NULL,
  `email`      VARCHAR(255) NOT NULL,
  PRIMARY KEY (`accountsID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `addresses`
--

CREATE TABLE IF NOT EXISTS `addresses` (
  `addressID`   INT(11)      NOT NULL AUTO_INCREMENT,
  `province`    VARCHAR(255) NOT NULL,
  `city`        VARCHAR(255) NOT NULL,
  `street`      VARCHAR(500) NOT NULL,
  `houseNumber` VARCHAR(5)   NOT NULL,
  `zipCode`     VARCHAR(6)   NOT NULL,
  PRIMARY KEY (`addressID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `albumID`   INT(11)      NOT NULL AUTO_INCREMENT,
  `albumName` VARCHAR(255) NOT NULL,
  `albumDate` DATETIME     NOT NULL,
  `albumLink` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`albumID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `blogs`
--

CREATE TABLE IF NOT EXISTS `blogs` (
  `blogID`   INT(11)      NOT NULL AUTO_INCREMENT,
  `uploadID` INT(11)      NOT NULL,
  `title`    VARCHAR(255) NOT NULL,
  `content`  TEXT         NOT NULL,
  PRIMARY KEY (`blogID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `commentreactions`
--

CREATE TABLE IF NOT EXISTS `commentreactions` (
  `reactionID`      INT(11) NOT NULL AUTO_INCREMENT,
  `commentID`       INT(11) NOT NULL,
  `uploadID`        INT(11) NOT NULL,
  `reactionContent` TEXT    NOT NULL,
  PRIMARY KEY (`reactionID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentID`      INT(11) NOT NULL AUTO_INCREMENT,
  `uploadID`       INT(11) NOT NULL,
  `parentID`       INT(11) NOT NULL,
  `commentContent` TEXT    NOT NULL,
  PRIMARY KEY (`commentID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `departmentfunction`
--

CREATE TABLE IF NOT EXISTS `departmentfunction` (
  `departmentID`     INT(11) NOT NULL AUTO_INCREMENT,
  `departmentListID` INT(11) NOT NULL,
  PRIMARY KEY (`departmentID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `departmentfunctionlist`
--

CREATE TABLE IF NOT EXISTS `departmentfunctionlist` (
  `departmentListID` INT(11)      NOT NULL AUTO_INCREMENT,
  `dpFunction`       VARCHAR(155) NOT NULL,
  `department`       VARCHAR(255) NOT NULL,
  PRIMARY KEY (`departmentListID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `embeddedlinks`
--

CREATE TABLE IF NOT EXISTS `embeddedlinks` (
  `embedID`     INT(11)      NOT NULL AUTO_INCREMENT,
  `postID`      INT(11)      NOT NULL,
  `embedLink`   VARCHAR(255) NOT NULL,
  `embedHeader` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`embedID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `establishmentlist`
--

CREATE TABLE IF NOT EXISTS `establishmentlist` (
  `establishmentListID` INT(11)      NOT NULL AUTO_INCREMENT,
  `location`            VARCHAR(255) NOT NULL,
  PRIMARY KEY (`establishmentListID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `establishments`
--

CREATE TABLE IF NOT EXISTS `establishments` (
  `establishmentID`     INT(11)      NOT NULL AUTO_INCREMENT,
  `establishmentListID` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`establishmentID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `generalinformation`
--

CREATE TABLE IF NOT EXISTS `generalinformation` (
  `generalID`       INT(11) NOT NULL AUTO_INCREMENT,
  `accountID`       INT(11) NOT NULL,
  `personalID`      INT(11) NOT NULL,
  `establishmentID` INT(11) NOT NULL,
  `departmentID`    INT(11) NOT NULL,
  `profileID`       INT(11) NOT NULL,
  `telephoneID`     INT(11)          DEFAULT NULL,
  `addressID`       INT(11)          DEFAULT NULL,
  PRIMARY KEY (`generalID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groupfiles`
--

CREATE TABLE IF NOT EXISTS `groupfiles` (
  `groupFilesID`   INT(11)      NOT NULL AUTO_INCREMENT,
  `fileAuthor`     VARCHAR(255) NOT NULL,
  `fileType`       VARCHAR(10)  NOT NULL,
  `fileName`       VARCHAR(255) NOT NULL,
  `fileSize`       INT(11)      NOT NULL,
  `fileDate`       DATETIME     NOT NULL,
  `fileChangeDate` DATETIME     NOT NULL,
  PRIMARY KEY (`groupFilesID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `grouprights`
--

CREATE TABLE IF NOT EXISTS `grouprights` (
  `groupRightsID` INT(11)      NOT NULL AUTO_INCREMENT,
  `rights`        VARCHAR(255) NOT NULL,
  `givenDate`     DATE         NOT NULL,
  PRIMARY KEY (`groupRightsID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `groupID`   INT(11)      NOT NULL AUTO_INCREMENT,
  `groupName` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`groupID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groupsummary`
--

CREATE TABLE IF NOT EXISTS `groupsummary` (
  `groupSummaryID` INT(11) NOT NULL AUTO_INCREMENT,
  `groupsID`       INT(11) NOT NULL,
  `accountID`      INT(11) NOT NULL,
  `groupRightsID`  INT(11) NOT NULL,
  PRIMARY KEY (`groupSummaryID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `label`
--

CREATE TABLE IF NOT EXISTS `label` (
  `labelID`   INT(11)      NOT NULL AUTO_INCREMENT,
  `accountID` INT(11)      NOT NULL,
  `labelName` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`labelID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `labelusers`
--

CREATE TABLE IF NOT EXISTS `labelusers` (
  `labelUserID` INT(11) NOT NULL AUTO_INCREMENT,
  `labelID`     INT(11) NOT NULL,
  `accountID`   INT(11) NOT NULL
  COMMENT 'Heeft te maken met gebruikers/groepen',
  PRIMARY KEY (`labelUserID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `likeID`   INT(11) NOT NULL AUTO_INCREMENT,
  `uploadID` INT(11) NOT NULL,
  `amount`   INT(11) NOT NULL,
  PRIMARY KEY (`likeID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personalinformation`
--

CREATE TABLE IF NOT EXISTS `personalinformation` (
  `personalID` INT(11)      NOT NULL AUTO_INCREMENT,
  `firstName`  VARCHAR(255) NOT NULL,
  `lastName`   VARCHAR(255) NOT NULL,
  `prefix`     VARCHAR(255) NOT NULL,
  `sex`        TINYINT(1)   NOT NULL DEFAULT '0',
  `birthDate`  DATETIME     NOT NULL,
  PRIMARY KEY (`personalID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photoID`   INT(11)      NOT NULL AUTO_INCREMENT,
  `albumID`   INT(11)      NOT NULL,
  `uploadID`  INT(11)      NOT NULL,
  `photoName` VARCHAR(255) NOT NULL,
  `photoSize` INT(11)      NOT NULL,
  PRIMARY KEY (`photoID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `postID`   INT(11) NOT NULL AUTO_INCREMENT,
  `uploadID` INT(11) NOT NULL,
  `content`  TEXT    NOT NULL,
  PRIMARY KEY (`postID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `profileID` INT(11) NOT NULL AUTO_INCREMENT,
  `photoID`   INT(11)          DEFAULT NULL,
  `bannerID`  INT(11)          DEFAULT NULL,
  PRIMARY KEY (`profileID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `ratingID` INT(11)      NOT NULL AUTO_INCREMENT,
  `blogID`   INT(11)      NOT NULL,
  `ip`       VARCHAR(255) NOT NULL,
  PRIMARY KEY (`ratingID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shares`
--

CREATE TABLE IF NOT EXISTS `shares` (
  `shareID`   INT(11) NOT NULL AUTO_INCREMENT,
  `uploadID`  INT(11) NOT NULL,
  `amount`    INT(11) NOT NULL,
  `shareType` VARCHAR(55)      DEFAULT NULL,
  PRIMARY KEY (`shareID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tagID`     INT(11) NOT NULL AUTO_INCREMENT,
  `uploadID`  INT(11) NOT NULL,
  `userTagID` INT(11) NOT NULL,
  PRIMARY KEY (`tagID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `telephone`
--

CREATE TABLE IF NOT EXISTS `telephone` (
  `telephoneID`   INT(11) NOT NULL AUTO_INCREMENT,
  `privateNumber` VARCHAR(16)      DEFAULT NULL,
  `workNumber`    VARCHAR(16)      DEFAULT NULL,
  PRIMARY KEY (`telephoneID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `upload`
--

CREATE TABLE IF NOT EXISTS `upload` (
  `uploadID`   INT(11)    NOT NULL AUTO_INCREMENT,
  `accountID`  INT(11)    NOT NULL,
  `softDelete` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uploadID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `uploaddate`
--

CREATE TABLE IF NOT EXISTS `uploaddate` (
  `uploadDateID`   INT(11)  NOT NULL AUTO_INCREMENT,
  `uploadID`       INT(11)  NOT NULL,
  `uploadDate`     DATETIME NOT NULL,
  `uploadEditDate` DATETIME NOT NULL,
  PRIMARY KEY (`uploadDateID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `views`
--

CREATE TABLE IF NOT EXISTS `views` (
  `viewID` INT(11)     NOT NULL AUTO_INCREMENT,
  `blogID` INT(11)     NOT NULL,
  `ip`     VARCHAR(25) NOT NULL,
  PRIMARY KEY (`viewID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `pluginID` INT(11)     NOT NULL AUTO_INCREMENT,
  `communityID` INT(11)     NOT NULL,
  `searchengine` INT(11) NOT NULL,
  PRIMARY KEY (`pluginID`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = latin1
  AUTO_INCREMENT = 1;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;