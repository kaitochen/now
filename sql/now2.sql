-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-03-04 09:12:52
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `now`
--

-- --------------------------------------------------------

--
-- 表的结构 `note`
--

CREATE TABLE `note` (
  `id` smallint(5) NOT NULL,
  `posterid` char(10) NOT NULL,
  `postername` char(15) NOT NULL,
  `title` char(100) NOT NULL,
  `time` char(50) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `type` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `notecomment`
--

CREATE TABLE `notecomment` (
  `id` smallint(5) NOT NULL,
  `noteid` smallint(5) NOT NULL,
  `answerid` char(10) NOT NULL,
  `answername` char(10) NOT NULL,
  `time` char(50) NOT NULL,
  `content` varchar(1000) CHARACTER SET utf32 NOT NULL,
  `finish` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `notice`
--

CREATE TABLE `notice` (
  `id` smallint(5) NOT NULL,
  `teacherid` char(10) CHARACTER SET utf8mb4 NOT NULL,
  `userid` char(10) NOT NULL,
  `time` char(20) NOT NULL,
  `content` char(200) NOT NULL,
  `finish` tinyint(1) NOT NULL DEFAULT '0',
  `source` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `plan`
--

CREATE TABLE `plan` (
  `id` tinyint(5) NOT NULL,
  `userid` char(10) NOT NULL,
  `time` char(20) NOT NULL,
  `content` char(200) NOT NULL,
  `finish` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `plan`
--

INSERT INTO `plan` (`id`, `userid`, `time`, `content`, `finish`) VALUES
(1, '2013051976', '20170311', '做完前端界面和功能', 0);

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE `project` (
  `projectid` tinyint(5) NOT NULL,
  `userid` char(10) NOT NULL,
  `teacherid` char(10) NOT NULL,
  `projectname` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `teacherinfo`
--

CREATE TABLE `teacherinfo` (
  `id` smallint(10) NOT NULL,
  `teacherid` char(15) NOT NULL,
  `teachername` char(10) NOT NULL,
  `teacherphone` char(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` smallint(4) NOT NULL,
  `userid` char(10) NOT NULL,
  `userkey` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `userid`, `userkey`) VALUES
(44, '2013051976', '2013051976');

-- --------------------------------------------------------

--
-- 表的结构 `userinfo`
--

CREATE TABLE `userinfo` (
  `id` smallint(4) NOT NULL,
  `userId` char(10) NOT NULL,
  `userName` char(15) NOT NULL,
  `userPhone` char(11) NOT NULL,
  `userMajor` char(30) NOT NULL,
  `userTeacher` char(10) NOT NULL DEFAULT '无',
  `teacherId` smallint(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `userinfo`
--

INSERT INTO `userinfo` (`id`, `userId`, `userName`, `userPhone`, `userMajor`, `userTeacher`, `teacherId`) VALUES
(21, '2013051976', '陈俊铠', '15627861371', '电子科学与技术', '无', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `notecomment`
--
ALTER TABLE `notecomment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projectid`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `teacherinfo`
--
ALTER TABLE `teacherinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacherid` (`teacherid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `note`
--
ALTER TABLE `note`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `notecomment`
--
ALTER TABLE `notecomment`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `plan`
--
ALTER TABLE `plan`
  MODIFY `id` tinyint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `project`
--
ALTER TABLE `project`
  MODIFY `projectid` tinyint(5) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `teacherinfo`
--
ALTER TABLE `teacherinfo`
  MODIFY `id` smallint(10) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- 使用表AUTO_INCREMENT `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` smallint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
