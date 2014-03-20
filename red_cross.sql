-- phpMyAdmin SQL Dump
-- version 4.0.9deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2014 at 01:59 PM
-- Server version: 5.1.72-2
-- PHP Version: 5.3.3-7+squeeze17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `red_cross`
--

-- --------------------------------------------------------

--
-- Table structure for table `Answer`
--

CREATE TABLE IF NOT EXISTS `Answer` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`answer_id`),
  KEY `fk_Answer_Question1_idx` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE IF NOT EXISTS `Category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `Class`
--

CREATE TABLE IF NOT EXISTS `Class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `trainer_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `gateway` int(128) NOT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `class_id` (`class_id`),
  KEY `fk_Class_Trainer1_idx` (`trainer_id`),
  KEY `fk_Class_Location1_idx` (`location_id`),
  KEY `fk_Class_Test1_idx` (`test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `ClassTopic`
--

CREATE TABLE IF NOT EXISTS `ClassTopic` (
  `topic_group_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  PRIMARY KEY (`topic_group_id`,`class_id`),
  KEY `fk_Topic_group_has_Class_Class1_idx` (`class_id`),
  KEY `fk_Topic_group_has_Class_Topic_group1_idx` (`topic_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Evaluation`
--

CREATE TABLE IF NOT EXISTS `Evaluation` (
  `evaluation_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `participants` int(11) DEFAULT NULL,
  `age_group` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `trainer_id` int(11) NOT NULL,
  `supervisor_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `location` varchar(45) NOT NULL,
  `notes` varchar(500) NOT NULL,
  PRIMARY KEY (`evaluation_id`),
  KEY `fk_Evaluation_Trainer_idx` (`trainer_id`),
  KEY `fk_Evaluation_Supervisor1_idx` (`supervisor_id`),
  KEY `fk_Evaluation_Location1_idx` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `EvaluationCategory`
--

CREATE TABLE IF NOT EXISTS `EvaluationCategory` (
  `evaluation_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `evaluation` int(1) NOT NULL,
  PRIMARY KEY (`evaluation_id`,`category_id`),
  KEY `fk_Evaluation_has_Category_Category1_idx` (`category_id`),
  KEY `fk_Evaluation_has_Category_Evaluation1_idx` (`evaluation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE IF NOT EXISTS `Location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `municipality_id` int(11) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `fk_Location_Municipality1_idx` (`municipality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;

-- --------------------------------------------------------

--
-- Table structure for table `Municipality`
--

CREATE TABLE IF NOT EXISTS `Municipality` (
  `municipality_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `coords` varchar(255) NOT NULL,
  PRIMARY KEY (`municipality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Table structure for table `Participant`
--

CREATE TABLE IF NOT EXISTS `Participant` (
  `participant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `answered` varchar(64) NOT NULL,
  PRIMARY KEY (`participant_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantAnswer`
--

CREATE TABLE IF NOT EXISTS `ParticipantAnswer` (
  `test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `answer` tinyint(1) DEFAULT NULL,
  `type` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`test_id`,`question_id`,`participant_id`,`type`),
  KEY `fk_TestQuestions_has_Participant_Participant1_idx` (`participant_id`),
  KEY `fk_TestQuestions_has_Participant_TestQuestions1_idx` (`test_id`,`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantAttendance`
--

CREATE TABLE IF NOT EXISTS `ParticipantAttendance` (
  `topic_group_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  `attendance` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`topic_group_id`,`class_id`,`participant_id`),
  KEY `fk_ClassTopic_has_Participant_Participant1_idx` (`participant_id`),
  KEY `fk_ClassTopic_has_Participant_ClassTopic1_idx` (`topic_group_id`,`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ParticipantClass`
--

CREATE TABLE IF NOT EXISTS `ParticipantClass` (
  `class_id` int(11) NOT NULL,
  `participant_id` int(11) NOT NULL,
  UNIQUE KEY `class_id` (`class_id`,`participant_id`),
  KEY `participant_id` (`participant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Question`
--

CREATE TABLE IF NOT EXISTS `Question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `Supervisor`
--

CREATE TABLE IF NOT EXISTS `Supervisor` (
  `supervisor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `municipality_id` int(11) NOT NULL,
  PRIMARY KEY (`supervisor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `Test`
--

CREATE TABLE IF NOT EXISTS `Test` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `TestQuestion`
--

CREATE TABLE IF NOT EXISTS `TestQuestion` (
  `test_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`test_id`,`question_id`),
  KEY `fk_Test_has_Question_Question1_idx` (`question_id`),
  KEY `fk_Test_has_Question_Test1_idx` (`test_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `Topic`
--

CREATE TABLE IF NOT EXISTS `Topic` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(256) DEFAULT NULL,
  `topic_group_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `fk_Topic_Topic_group1_idx` (`topic_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `TopicGroup`
--

CREATE TABLE IF NOT EXISTS `TopicGroup` (
  `topic_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`topic_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `Trainer`
--

CREATE TABLE IF NOT EXISTS `Trainer` (
  `trainer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `municipality_id` int(11) NOT NULL,
  PRIMARY KEY (`trainer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `municipality_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `is_superuser` int(11) DEFAULT NULL,
  `activiation_code` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_User_Municipality1_idx` (`municipality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Answer`
--
ALTER TABLE `Answer`
  ADD CONSTRAINT `fk_Answer_Question1` FOREIGN KEY (`question_id`) REFERENCES `Question` (`question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Class`
--
ALTER TABLE `Class`
  ADD CONSTRAINT `fk_Class_Location1` FOREIGN KEY (`location_id`) REFERENCES `Location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Class_Test1` FOREIGN KEY (`test_id`) REFERENCES `Test` (`test_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Class_Trainer1` FOREIGN KEY (`trainer_id`) REFERENCES `Trainer` (`trainer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ClassTopic`
--
ALTER TABLE `ClassTopic`
  ADD CONSTRAINT `fk_Topic_group_has_Class_Class1` FOREIGN KEY (`class_id`) REFERENCES `Class` (`class_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Topic_group_has_Class_Topic_group1` FOREIGN KEY (`topic_group_id`) REFERENCES `TopicGroup` (`topic_group_id`) ON UPDATE NO ACTION;

--
-- Constraints for table `Evaluation`
--
ALTER TABLE `Evaluation`
  ADD CONSTRAINT `fk_Evaluation_Location1` FOREIGN KEY (`location_id`) REFERENCES `Location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Evaluation_Supervisor1` FOREIGN KEY (`supervisor_id`) REFERENCES `Supervisor` (`supervisor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Evaluation_Trainer` FOREIGN KEY (`trainer_id`) REFERENCES `Trainer` (`trainer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `EvaluationCategory`
--
ALTER TABLE `EvaluationCategory`
  ADD CONSTRAINT `fk_Evaluation_has_Category_Category1` FOREIGN KEY (`category_id`) REFERENCES `Category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Evaluation_has_Category_Evaluation1` FOREIGN KEY (`evaluation_id`) REFERENCES `Evaluation` (`evaluation_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Location`
--
ALTER TABLE `Location`
  ADD CONSTRAINT `fk_Location_Municipality1` FOREIGN KEY (`municipality_id`) REFERENCES `Municipality` (`municipality_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ParticipantAnswer`
--
ALTER TABLE `ParticipantAnswer`
  ADD CONSTRAINT `fk_TestQuestions_has_Participant_Participant1` FOREIGN KEY (`participant_id`) REFERENCES `Participant` (`participant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TestQuestions_has_Participant_TestQuestions1` FOREIGN KEY (`test_id`, `question_id`) REFERENCES `TestQuestion` (`test_id`, `question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ParticipantAttendance`
--
ALTER TABLE `ParticipantAttendance`
  ADD CONSTRAINT `fk_ClassTopic_has_Participant_ClassTopic1` FOREIGN KEY (`topic_group_id`, `class_id`) REFERENCES `ClassTopic` (`topic_group_id`, `class_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ClassTopic_has_Participant_Participant1` FOREIGN KEY (`participant_id`) REFERENCES `Participant` (`participant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `TestQuestion`
--
ALTER TABLE `TestQuestion`
  ADD CONSTRAINT `fk_Test_has_Question_Question1` FOREIGN KEY (`question_id`) REFERENCES `Question` (`question_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Test_has_Question_Test1` FOREIGN KEY (`test_id`) REFERENCES `Test` (`test_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `Topic`
--
ALTER TABLE `Topic`
  ADD CONSTRAINT `fk_Topic_Topic_group1` FOREIGN KEY (`topic_group_id`) REFERENCES `TopicGroup` (`topic_group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `fk_User_Municipality1` FOREIGN KEY (`municipality_id`) REFERENCES `Municipality` (`municipality_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
