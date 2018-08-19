-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2018-08-19 20:50:34
-- 服务器版本： 5.7.18-1
-- PHP Version: 7.1.6-2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_car`
--

-- --------------------------------------------------------

--
-- 表的结构 `auth_app`
--

CREATE TABLE `auth_app` (
  `appid` varchar(20) NOT NULL,
  `appsercet` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `auth_app`
--

INSERT INTO `auth_app` (`appid`, `appsercet`) VALUES
('tp5restfultest', '123456');

-- --------------------------------------------------------

--
-- 表的结构 `auth_car`
--

CREATE TABLE `auth_car` (
  `uid` int(10) NOT NULL,
  `carid` varchar(10) NOT NULL,
  `appid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `car_data`
--

CREATE TABLE `car_data` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `g_sid` int(11) NOT NULL,
  `ccd` int(11) NOT NULL,
  `electric` int(11) NOT NULL,
  `acceleration` int(11) NOT NULL,
  `speed` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 表的结构 `car_image`
--

CREATE TABLE `car_image` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `g_sid` int(11) NOT NULL,
  `url` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_app`
--
ALTER TABLE `auth_app`
  ADD PRIMARY KEY (`appid`);

--
-- Indexes for table `auth_car`
--
ALTER TABLE `auth_car`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `carid` (`carid`),
  ADD KEY `App` (`appid`);

--
-- Indexes for table `car_data`
--
ALTER TABLE `car_data`
  ADD KEY `uid` (`uid`),
  ADD KEY `gid` (`gid`),
  ADD KEY `g_sid` (`g_sid`),
  ADD KEY `created` (`created`);

--
-- Indexes for table `car_image`
--
ALTER TABLE `car_image`
  ADD PRIMARY KEY (`url`),
  ADD KEY `gid` (`gid`),
  ADD KEY `g_sid` (`g_sid`),
  ADD KEY `uid` (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `auth_car`
--
ALTER TABLE `auth_car`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 限制导出的表
--

--
-- 限制表 `auth_car`
--
ALTER TABLE `auth_car`
  ADD CONSTRAINT `App` FOREIGN KEY (`appid`) REFERENCES `auth_app` (`appid`);

--
-- 限制表 `car_data`
--
ALTER TABLE `car_data`
  ADD CONSTRAINT `UID_DATA` FOREIGN KEY (`uid`) REFERENCES `auth_car` (`uid`);

--
-- 限制表 `car_image`
--
ALTER TABLE `car_image`
  ADD CONSTRAINT `UID_IMAGE` FOREIGN KEY (`uid`) REFERENCES `auth_car` (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
