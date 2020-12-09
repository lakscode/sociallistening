-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2020 at 10:45 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialmedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brandid` int(11) NOT NULL,
  `sourcebrand` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `keywords` varchar(500) NOT NULL,
  `exclude_handle` varchar(2000) NOT NULL,
  `competitors` varchar(50) NOT NULL,
  `active` int(11) NOT NULL,
  `download` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `charts`
--

CREATE TABLE `charts` (
  `chartid` int(11) NOT NULL,
  `shortname` varchar(25) NOT NULL,
  `chartname` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `charttypeid` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `charttypes`
--

CREATE TABLE `charttypes` (
  `charttypeid` int(11) NOT NULL,
  `charttype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `charttypes`
--

INSERT INTO `charttypes` (`charttypeid`, `charttype`) VALUES
(1, 'line'),
(2, 'column'),
(3, 'pie'),
(4, 'bar');

-- --------------------------------------------------------

--
-- Table structure for table `chart_themes`
--

CREATE TABLE `chart_themes` (
  `ct_id` int(11) NOT NULL,
  `theme` varchar(300) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  `theme_js_script` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_themes`
--

INSERT INTO `chart_themes` (`ct_id`, `theme`, `color_code`, `theme_js_script`, `created_by`) VALUES
(1, 'Black', '#2A2A2B', 'Highcharts.setOptions(Highcharts.themeBlack);', 0),
(2, 'DarkUnica', '#3E3E40', 'Highcharts.setOptions(Highcharts.themeDarkUnica);', 0),
(3, 'White', '#FFFFFF', '', 2),
(4, 'Gray', '#F0F0FF', 'Highcharts.setOptions(Highcharts.themeGray);', 2),
(5, 'DarkBlue', '#303060', 'Highcharts.setOptions(Highcharts.themeDarkBlue);', 2),
(6, 'DarkGreen', '#306030', 'Highcharts.setOptions(Highcharts.themeDarkGreen);', 2);

-- --------------------------------------------------------

--
-- Table structure for table `chart_themes_mapping`
--

CREATE TABLE `chart_themes_mapping` (
  `ctm_id` int(11) NOT NULL,
  `ct_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_themes_mapping`
--

INSERT INTO `chart_themes_mapping` (`ctm_id`, `ct_id`, `userid`) VALUES
(1, 3, 3),
(2, 6, 2),
(3, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configid` int(11) NOT NULL,
  `configname` varchar(50) NOT NULL,
  `configvalue` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `keywordsid` int(11) NOT NULL,
  `categoryname` varchar(50) NOT NULL,
  `keywords_set1` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `keywords_set2` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `do_not_include` varchar(5000) CHARACTER SET utf8 NOT NULL,
  `exclude_handle` varchar(2000) NOT NULL,
  `chartid` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `listeningdata`
--

CREATE TABLE `listeningdata` (
  `id` int(11) NOT NULL,
  `brandid` int(11) NOT NULL,
  `text` varchar(10000) NOT NULL,
  `date_created` datetime NOT NULL,
  `language` varchar(50) NOT NULL,
  `author` varchar(100) NOT NULL,
  `kloutscore` double NOT NULL,
  `published` datetime NOT NULL,
  `link` varchar(300) NOT NULL,
  `title` varchar(500) NOT NULL,
  `author_img` varchar(256) NOT NULL,
  `sentiment` int(1) NOT NULL,
  `sentiment_n` int(11) NOT NULL,
  `follower_count` int(11) NOT NULL,
  `friends_count` int(11) NOT NULL,
  `favourites_count` int(11) NOT NULL,
  `statuses_count` int(11) NOT NULL,
  `retweet_count` int(11) NOT NULL,
  `favorite_count` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `source` varchar(100) NOT NULL,
  `id_str` varchar(256) NOT NULL,
  `user_id_str` varchar(256) NOT NULL,
  `user_screen_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `twitter_client` varchar(256) NOT NULL,
  `site_full` varchar(300) NOT NULL,
  `site` varchar(100) NOT NULL,
  `site_section` varchar(300) NOT NULL,
  `section_title` varchar(500) NOT NULL,
  `title_full` varchar(500) NOT NULL,
  `replies_count` int(11) NOT NULL,
  `participants_count` int(11) NOT NULL,
  `site_type` varchar(50) NOT NULL,
  `spam_score` int(11) NOT NULL,
  `ord_in_thread` int(11) NOT NULL,
  `crawled` datetime NOT NULL,
  `art_body` varchar(256) NOT NULL,
  `source_org` varchar(50) NOT NULL,
  `source_org_url` varchar(100) NOT NULL,
  `source_twitter` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `rolesid` int(11) NOT NULL,
  `rolename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`rolesid`, `rolename`) VALUES
(1, 'Client Admin'),
(2, 'Client User'),
(3, 'CMO'),
(4, 'CIO'),
(5, 'COO'),
(6, 'CEO'),
(7, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `role_chart_mapping`
--

CREATE TABLE `role_chart_mapping` (
  `rc_id` int(11) NOT NULL,
  `rolesid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `chartid` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `source` varchar(30) NOT NULL,
  `brandid` int(11) NOT NULL,
  `next_url` varchar(500) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `submenuid` int(11) NOT NULL,
  `submenu` varchar(50) NOT NULL,
  `shortname` varchar(10) NOT NULL,
  `charttypeid` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu`
--

INSERT INTO `submenu` (`submenuid`, `submenu`, `shortname`, `charttypeid`, `active`) VALUES
(1, 'View by Language', 'Lang', 1, 0),
(2, 'View by Posts', 'Posts', 1, 1),
(3, 'View by Site', 'Site', 1, 0),
(4, 'View by Source', 'Source', 1, 1),
(5, 'View by Sentiment', 'Sentiment', 1, 1),
(6, 'Word Cloud', 'Words', 1, 0),
(7, 'View by Top Influencers', 'Influencer', 1, 0),
(8, 'View by Region', 'Region', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE `usergroup` (
  `usergroupid` int(11) NOT NULL,
  `usergroupname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroup`
--

INSERT INTO `usergroup` (`usergroupid`, `usergroupname`) VALUES
(1, 'CSC');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `rolesid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `firstname`, `created`, `rolesid`, `status`) VALUES
(1, 'sampath', 'pass1234', 'Sampath', '0000-00-00 00:00:00', 1, 1),
(2, 'lakshmi', 'pass1234', 'Lakshmi', '0000-00-00 00:00:00', 3, 1),
(3, 'shruthi', 'pass1234', 'Shruthi', '0000-00-00 00:00:00', 5, 1),
(4, 'katti', 'pass1234', 'Sankarshan', '0000-00-00 00:00:00', 4, 1),
(5, 'admin', 'admin', 'Admin', '2015-06-24 00:00:00', 2, 1),
(6, 'swathi', 'pass1234', 'Swathi', '2015-07-07 15:00:00', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group_mapping`
--

CREATE TABLE `user_group_mapping` (
  `ugm_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `usergroupid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_group_mapping`
--

INSERT INTO `user_group_mapping` (`ugm_id`, `userid`, `usergroupid`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `charts`
--
ALTER TABLE `charts`
  ADD PRIMARY KEY (`chartid`);

--
-- Indexes for table `charttypes`
--
ALTER TABLE `charttypes`
  ADD PRIMARY KEY (`charttypeid`);

--
-- Indexes for table `chart_themes`
--
ALTER TABLE `chart_themes`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `chart_themes_mapping`
--
ALTER TABLE `chart_themes_mapping`
  ADD PRIMARY KEY (`ctm_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configid`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`keywordsid`);

--
-- Indexes for table `listeningdata`
--
ALTER TABLE `listeningdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rolesid`);

--
-- Indexes for table `role_chart_mapping`
--
ALTER TABLE `role_chart_mapping`
  ADD PRIMARY KEY (`rc_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`submenuid`);

--
-- Indexes for table `usergroup`
--
ALTER TABLE `usergroup`
  ADD PRIMARY KEY (`usergroupid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `user_group_mapping`
--
ALTER TABLE `user_group_mapping`
  ADD PRIMARY KEY (`ugm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brandid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `charts`
--
ALTER TABLE `charts`
  MODIFY `chartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `charttypes`
--
ALTER TABLE `charttypes`
  MODIFY `charttypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chart_themes`
--
ALTER TABLE `chart_themes`
  MODIFY `ct_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chart_themes_mapping`
--
ALTER TABLE `chart_themes_mapping`
  MODIFY `ctm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `keywordsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `listeningdata`
--
ALTER TABLE `listeningdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `rolesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role_chart_mapping`
--
ALTER TABLE `role_chart_mapping`
  MODIFY `rc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `submenuid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `usergroup`
--
ALTER TABLE `usergroup`
  MODIFY `usergroupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_group_mapping`
--
ALTER TABLE `user_group_mapping`
  MODIFY `ugm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
