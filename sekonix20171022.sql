-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-10-22 10:49:11
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sekonix`
--
CREATE DATABASE IF NOT EXISTS `sekonix` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sekonix`;

-- --------------------------------------------------------

--
-- 表的结构 `sk_admin`
--

DROP TABLE IF EXISTS `sk_admin`;
CREATE TABLE IF NOT EXISTS `sk_admin` (
  `admin_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL DEFAULT '89ca2407297cff2751bbef6eda6593f0',
  `mobile` varchar(11) DEFAULT NULL,
  `skline` varchar(6) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `power` smallint(5) NOT NULL,
  `lastlogintime` int(10) DEFAULT NULL,
  `lastloginip` varchar(15) DEFAULT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 插入之前先把表清空（truncate） `sk_admin`
--

TRUNCATE TABLE `sk_admin`;
--
-- 转存表中的数据 `sk_admin`
--

INSERT INTO `sk_admin` (`admin_id`, `username`, `realname`, `password`, `mobile`, `skline`, `email`, `power`, `lastlogintime`, `lastloginip`, `create_user`, `create_time`, `status`, `update_time`) VALUES
(1, 'jason', '梁国成', '89ca2407297cff2751bbef6eda6593f0', '18006303246', '193', 'jason.leung@163.com', 1, 1508638340, NULL, '梁国成', 1498696655, 1, 1508216836),
(2, 'dinglinying', '丁林英', '89ca2407297cff2751bbef6eda6593f0', '13021639593', '193', 'xxx@xx.xxx', 1, 1498696655, NULL, '梁国成', 1498696655, 1, 1508463422),
(3, 'liuchaoqun', '刘超群', '89ca2407297cff2751bbef6eda6593f0', '13287855211', '193', '', 1, NULL, NULL, '梁国成', 1498696655, 1, 1508218276),
(4, 'qiaojianhui', '乔建辉', '89ca2407297cff2751bbef6eda6593f0', '13869058483', '191', 'q-qjh@163.com', 1, NULL, NULL, '梁国成', 0, 1, 1508218153),
(5, 'zhaoxiangren', '赵向仁', '89ca2407297cff2751bbef6eda6593f0', '18663159117', '191', 'fuqiang.619@163.com', 1, NULL, NULL, '梁国成', 0, 1, 1508218263),
(6, 'dongjunchao', '董君超', '89ca2407297cff2751bbef6eda6593f0', '', '193', '', 1, NULL, NULL, '梁国成', 1508218074, 1, NULL),
(7, 'liangshuangjun', '梁双俊', 'd4c04e5eb37a01f8c13f5aac0720ef56', '13563181918', '191', '', 1, 1508491014, NULL, '梁国成', 1508490709, 1, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sk_check`
--

DROP TABLE IF EXISTS `sk_check`;
CREATE TABLE IF NOT EXISTS `sk_check` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL DEFAULT '0',
  `lot` varchar(20) NOT NULL DEFAULT '0',
  `user` varchar(20) NOT NULL,
  `num` smallint(10) unsigned NOT NULL,
  `goods` smallint(10) unsigned DEFAULT NULL,
  `bads` smallint(10) unsigned DEFAULT NULL,
  `liangdian` smallint(10) unsigned DEFAULT NULL,
  `yiwu` smallint(10) unsigned DEFAULT NULL,
  `henji` smallint(10) unsigned DEFAULT NULL,
  `qipao` smallint(10) unsigned DEFAULT NULL,
  `fm` smallint(10) unsigned DEFAULT NULL,
  `paopan` smallint(10) unsigned DEFAULT NULL,
  `loss` smallint(10) unsigned DEFAULT NULL,
  `wuqian` smallint(10) unsigned DEFAULT NULL,
  `zhuangfan` smallint(10) unsigned DEFAULT NULL,
  `banyue` smallint(10) unsigned DEFAULT NULL,
  `xiaoyi` smallint(10) unsigned DEFAULT NULL,
  `caixian` smallint(10) unsigned DEFAULT NULL,
  `gate` smallint(10) unsigned DEFAULT NULL,
  `huahen` smallint(10) unsigned DEFAULT NULL,
  `heidian` smallint(10) unsigned DEFAULT NULL,
  `chengxing` smallint(10) unsigned DEFAULT NULL,
  `yahen` smallint(10) unsigned DEFAULT NULL,
  `dumo` smallint(10) unsigned DEFAULT NULL,
  `fabai` smallint(10) unsigned DEFAULT NULL,
  `xihua` smallint(10) unsigned DEFAULT NULL,
  `caiyi` smallint(10) unsigned DEFAULT NULL,
  `chengdian` smallint(10) unsigned DEFAULT NULL,
  `others` smallint(10) DEFAULT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 插入之前先把表清空（truncate） `sk_check`
--

TRUNCATE TABLE `sk_check`;
--
-- 转存表中的数据 `sk_check`
--

INSERT INTO `sk_check` (`id`, `model`, `lot`, `user`, `num`, `goods`, `bads`, `liangdian`, `yiwu`, `henji`, `qipao`, `fm`, `paopan`, `loss`, `wuqian`, `zhuangfan`, `banyue`, `xiaoyi`, `caixian`, `gate`, `huahen`, `heidian`, `chengxing`, `yahen`, `dumo`, `fabai`, `xihua`, `caiyi`, `chengdian`, `others`, `create_user`, `create_time`, `update_time`, `status`) VALUES
(1, 'MV1419L1-13', '171014A01', '黄苗苗', 1120, 1100, 20, 1, 1, 1, 1, 1, 1, NULL, 1, 1, NULL, 1, 1, 1, 1, 1, 1, 1, NULL, 1, 1, 1, 1, NULL, '梁国成', 1543211111, NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sk_coating`
--

DROP TABLE IF EXISTS `sk_coating`;
CREATE TABLE IF NOT EXISTS `sk_coating` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ct_model` varchar(20) NOT NULL,
  `ct_machine` tinyint(2) unsigned NOT NULL,
  `ct_date` int(10) NOT NULL,
  `ct_lot` varchar(20) NOT NULL,
  `ct_user` varchar(20) NOT NULL,
  `start_time` int(10) NOT NULL,
  `over_time` int(10) DEFAULT NULL,
  `ct_num` int(10) unsigned NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `spec_t` float(5,2) unsigned DEFAULT NULL,
  `spec_r` float(5,2) unsigned DEFAULT NULL,
  `ck_num` int(10) unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_time` int(10) DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  `tips` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 插入之前先把表清空（truncate） `sk_coating`
--

TRUNCATE TABLE `sk_coating`;
--
-- 转存表中的数据 `sk_coating`
--

INSERT INTO `sk_coating` (`id`, `ct_model`, `ct_machine`, `ct_date`, `ct_lot`, `ct_user`, `start_time`, `over_time`, `ct_num`, `create_user`, `spec_t`, `spec_r`, `ck_num`, `status`, `create_time`, `update_time`, `tips`) VALUES
(1, 'MV1419L1-23', 5, 20170927, '2', '张乐乐', 180000, NULL, 2240, '梁国成', NULL, NULL, 0, 0, 1450055600, NULL, NULL),
(2, 'MV1419L1-23', 5, 20170927, '2', '张乐乐', 180000, NULL, 2240, '梁国成', NULL, NULL, 0, 0, 1450055600, NULL, NULL),
(3, 'MV1419L2-23', 5, 20170927, '1', '张乐乐', 180000, NULL, 1280, '梁国成', NULL, NULL, 0, 0, 1450055600, NULL, '1314'),
(4, 'MV1419L1-13', 2, 20171012, 'H01', '宋晓科', 135409, NULL, 65535, '梁国成', NULL, NULL, NULL, 1, 1507787658, NULL, ''),
(5, 'MV1419L1-20', 2, 20171012, 'H01', '宋晓科', 135409, NULL, 2291, '梁国成', NULL, NULL, NULL, 0, 1507787658, NULL, 'SDFSDF'),
(6, 'MV1419L2-13', 2, 20171012, 'H01', '宋晓科', 135409, NULL, 1449, '梁国成', NULL, NULL, NULL, 0, 1507787658, NULL, ''),
(7, 'MV1419L2-20', 2, 20171012, 'H01', '宋晓科', 135409, NULL, 27499, '梁国成', NULL, NULL, NULL, 0, 1507787658, NULL, ''),
(8, 'MV1419L1-13', 4, 20171013, 'A01', '张琦', 152523, NULL, 65535, '梁国成', NULL, NULL, NULL, 1, 1507787734, 1507879528, ''),
(9, 'MV1419L1-20', 2, 20171012, 'H01', '宋晓科', 135409, NULL, 2291, '梁国成', NULL, NULL, NULL, 0, 1507787734, NULL, 'SDFSDF'),
(10, 'MV1419L2-13', 2, 20171012, 'H01', '宋晓科', 135409, NULL, 1449, '梁国成', NULL, NULL, NULL, 0, 1507787734, NULL, ''),
(11, 'MV1419L2-20', 2, 20171012, 'H01', '宋晓科', 0, NULL, 27499, '梁国成', NULL, NULL, NULL, 0, 1507787734, NULL, ''),
(12, 'MV1419L1-13', 3, 20171012, 'E01', '马士友', 17, NULL, 10010, '梁国成', NULL, NULL, NULL, 1, 1507801177, NULL, ''),
(13, 'MV1419L1-13', 5, 20171012, 'E02', '马士友', 17, NULL, 65535, '梁国成', NULL, NULL, NULL, 1, 1507801282, NULL, ''),
(14, 'MV1419L1-20', 5, 20171012, 'E02', '马士友', 17, NULL, 2291, '梁国成', NULL, NULL, NULL, 0, 1507801282, NULL, ''),
(15, 'MV1419L2-13', 5, 20171012, 'E02', '马士友', 17, NULL, 1449, '梁国成', NULL, NULL, NULL, 0, 1507801282, NULL, ''),
(16, 'MV1419L2-20', 5, 20171012, 'E02', '马士友', 17, NULL, 27499, '梁国成', NULL, NULL, NULL, 0, 1507801282, NULL, ''),
(17, 'MV1419L1-13', 5, 20171012, 'E02', '马士友', 17, NULL, 65535, '梁国成', NULL, NULL, NULL, 1, 1507801416, NULL, ''),
(18, 'MV1419L1-20', 5, 20171012, 'E02', '马士友', 17, NULL, 2291, '梁国成', NULL, NULL, NULL, 0, 1507801416, NULL, ''),
(19, 'MV1419L2-13', 5, 20171012, 'E02', '马士友', 17, NULL, 1449, '梁国成', NULL, NULL, NULL, 0, 1507801416, NULL, ''),
(20, 'MV1419L2-20', 5, 20171012, 'E02', '马士友', 17, NULL, 27499, '梁国成', NULL, NULL, NULL, 1, 1507801416, NULL, ''),
(21, 'AM1663L1-1', 1, 1507910400, 'A01', '张乐乐', 1508638800, NULL, 2474, '梁国成', NULL, NULL, NULL, 1, 1507987953, 1508638856, ''),
(22, 'AM1663L6-1', 1, 1507910400, 'A01', '张乐乐', 1507987938, NULL, 2240, '梁国成', NULL, NULL, NULL, 1, 1507987953, NULL, ''),
(23, 'MV1419L1-13', 1, 1508601600, 'A01', '张乐乐', 1508638860, NULL, 10302, '梁国成', NULL, NULL, NULL, 1, 1507987953, 1508638917, ''),
(24, 'MV1419L1-20', 1, 1507910400, 'A01', '张乐乐', 1507987938, NULL, 2291, '梁国成', NULL, NULL, NULL, 1, 1507987953, NULL, ''),
(25, 'MV1419L2-13', 3, 1508342400, 'B02', '范岩', 1508424600, NULL, 1428, '梁国成', NULL, NULL, NULL, 1, 1507987953, 1508424602, '12306'),
(26, 'MV1419L2-20', 1, 1508342400, 'A01', '马士友', 1508424720, NULL, 2499, '梁国成', NULL, NULL, NULL, 0, 1507987953, 1508424750, '14111');

-- --------------------------------------------------------

--
-- 表的结构 `sk_color`
--

DROP TABLE IF EXISTS `sk_color`;
CREATE TABLE IF NOT EXISTS `sk_color` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `color_type` varchar(20) NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 插入之前先把表清空（truncate） `sk_color`
--

TRUNCATE TABLE `sk_color`;
--
-- 转存表中的数据 `sk_color`
--

INSERT INTO `sk_color` (`id`, `color_type`, `create_user`, `create_time`) VALUES
(1, 'GREEN#1', '梁国成', 2147483647),
(2, 'GREEN#2', '梁国成', 2147483647),
(3, 'GREEN#3', '梁国成', 2147483647),
(4, 'GREEN#4', '梁国成', 2147483647),
(5, 'BLUE#1', '梁国成', 2147483647),
(6, 'BLUE#2', '梁国成', 2147483647),
(7, 'BLUE#3', '梁国成', 2147483647),
(8, 'BLUE#4', '梁国成', 2147483647),
(9, 'PURPLE#1', '梁国成', 2147483647),
(10, 'PURPLE#2', '梁国成', 2147483647),
(11, 'PURPLE#3', '梁国成', 2147483647),
(12, 'PURPLE#4', '梁国成', 2147483647),
(13, 'YELLOW#1', '梁国成', 2147483647),
(14, 'CYAN#1', '梁国成', 2147483647);

-- --------------------------------------------------------

--
-- 表的结构 `sk_count`
--

DROP TABLE IF EXISTS `sk_count`;
CREATE TABLE IF NOT EXISTS `sk_count` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL,
  `num` smallint(10) NOT NULL,
  `count_user` varchar(20) NOT NULL,
  `last_time` int(12) DEFAULT NULL,
  `tips` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 插入之前先把表清空（truncate） `sk_count`
--

TRUNCATE TABLE `sk_count`;
--
-- 转存表中的数据 `sk_count`
--

INSERT INTO `sk_count` (`id`, `model`, `num`, `count_user`, `last_time`, `tips`) VALUES
(1, 'AM1663L1-1', 0, '梁国成', 1508657909, NULL),
(2, 'AM1663L6-1', 0, '梁国成', 1508657909, NULL),
(3, 'MV1419L1-13', 0, '梁国成', 1508657909, NULL),
(4, 'MV1419L1-20', 0, '梁国成', 1508657909, NULL),
(5, 'MV1419L2-13', 0, '梁国成', 1508657909, NULL),
(6, 'MV1419L2-20', 0, '梁国成', 1508657909, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sk_enter`
--

DROP TABLE IF EXISTS `sk_enter`;
CREATE TABLE IF NOT EXISTS `sk_enter` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `et_model` varchar(20) NOT NULL,
  `et_date` int(10) NOT NULL,
  `et_time` int(10) NOT NULL,
  `et_num` smallint(10) NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `md_user` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_time` int(12) NOT NULL,
  `update_time` int(12) DEFAULT NULL,
  `tips` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=156 ;

--
-- 插入之前先把表清空（truncate） `sk_enter`
--

TRUNCATE TABLE `sk_enter`;
--
-- 转存表中的数据 `sk_enter`
--

INSERT INTO `sk_enter` (`id`, `et_model`, `et_date`, `et_time`, `et_num`, `create_user`, `md_user`, `status`, `create_time`, `update_time`, `tips`) VALUES
(5, 'MV1419L1-13', 20170822, 8385959, 3950, '丁林英', '王云', 1, 2147483647, NULL, '0'),
(10, 'MV1419L2-13', 20170822, 8385959, 1280, '丁林英', '王云', 1, 2147483647, NULL, '0'),
(17, 'MV1419L1-20', 20170822, 8385959, 1400, '丁林英', '王云', 1, 2147483647, NULL, '0'),
(18, 'MV1419L2-20', 20170826, 8385959, 2800, '丁林英', '王云', 1, 2147483647, NULL, '0'),
(93, 'MV1419L2-13', 20170926, 0, 1, '梁国成', '1111', 1, 1506416047, NULL, ''),
(94, 'MV1419L1-13', 20170926, 0, 1, '梁国成', '14123', 1, 1506416146, NULL, ''),
(95, 'MV1419L2-13', 20170926, 0, 1, '梁国成', '14123', 1, 1506416146, NULL, ''),
(96, 'MV1419L1-13', 20170926, 0, 11212, '梁国成', '12412', 1, 1506416415, NULL, ''),
(97, 'MV1419L1-13', 20170926, 0, 11212, '梁国成', '12412', 1, 1506416431, NULL, ''),
(98, 'MV1419L1-13', 20170926, 0, 4545, '梁国成', '454', 1, 1506416440, NULL, ''),
(99, 'MV1419L1-13', 20170926, 0, 32767, '梁国成', '41412', 1, 1506416612, NULL, ''),
(100, 'MV1419L1-20', 20170926, 0, 213, '梁国成', '41412', 1, 1506416612, NULL, ''),
(101, 'MV1419L2-20', 20170926, 0, 1, '梁国成', '11', 1, 1506417617, NULL, ''),
(102, 'MV1419L1-13', 20170926, 0, 1212, '梁国成', '442', 1, 1506417709, NULL, ''),
(103, 'MV1419L1-13', 20170926, 0, 1212, '梁国成', '121', 1, 1506417725, NULL, ''),
(104, 'MV1419L1-13', 20170926, 0, 1212, '梁国成', '12', 1, 1506417748, NULL, ''),
(105, 'MV1419L1-13', 20170926, 0, 32767, '梁国成', '411', 1, 1506418498, NULL, ''),
(106, 'MV1419L1-20', 20170926, 0, 123, '梁国成', '411', 1, 1506418498, NULL, ''),
(107, 'MV1419L2-13', 20170926, 9, 123, '梁国成', '020', 1, 1506477561, NULL, '111'),
(108, 'MV1419L2-20', 20170926, 9, 456, '梁国成', '020', 1, 1506477561, NULL, '222'),
(109, 'MV1419L1-13', 20170927, 10, 111, '梁国成', '000', 1, 1506477640, NULL, '1'),
(110, 'MV1419L1-20', 20170927, 10, 222, '梁国成', '000', 1, 1506477640, NULL, '2'),
(111, 'MV1419L2-13', 1483228800, 134418, 22, '梁国成', '', 1, 1506491079, NULL, ''),
(112, 'MV1419L2-20', 1507801416, 134418, 12121, '梁国成', '', 1, 1506491079, NULL, ''),
(113, 'MV1419L2-13', 1507801416, 134550, 1, '梁国成', '1', 1, 1506491173, NULL, ''),
(114, 'MV1419L2-20', 20170926, 134550, 12121, '梁国成', '1', 1, 1506491173, NULL, ''),
(115, 'MV1419L1-13', 20170926, 165110, 1212, '梁国成', '1', 1, 1507711876, NULL, ''),
(116, 'MV1419L1-13', 20171011, 165120, 1212, '梁国成', '1', 1, 1507711936, NULL, ''),
(117, 'MV1419L1-13', 20171011, 165416, 1212, '梁国成', '1', 1, 1507712058, NULL, ''),
(118, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712115, NULL, ''),
(119, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712116, NULL, ''),
(120, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712116, NULL, ''),
(121, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712117, NULL, ''),
(122, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712117, NULL, ''),
(123, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712117, NULL, ''),
(124, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712117, NULL, ''),
(125, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712117, NULL, ''),
(126, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712131, NULL, ''),
(127, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712132, NULL, ''),
(128, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712132, NULL, ''),
(129, 'MV1419L1-13', 20171011, 165515, 1212, '梁国成', '1', 1, 1507712132, NULL, ''),
(130, 'MV1419L1-13', 20171011, 165856, 1212, '梁国成', '1', 1, 1507712339, NULL, ''),
(131, 'MV1419L1-13', 20171011, 165917, 1212, '梁国成', '1', 1, 1507712364, NULL, ''),
(132, 'MV1419L1-20', 20171011, 165917, 111, '梁国成', '1', 1, 1507712364, NULL, '2346'),
(133, 'MV1419L1-13', 20171011, 170116, 1212, '梁国成', '1', 1, 1507712482, NULL, ''),
(134, 'MV1419L1-20', 20171011, 170116, 111, '梁国成', '1', 1, 1507712482, NULL, ''),
(135, 'MV1419L1-13', 20171011, 170229, 1212, '梁国成', '王云', 1, 1507712554, NULL, 'sdfsdf'),
(136, 'MV1419L1-20', 20171011, 170229, 111, '梁国成', '王云', 1, 1507712554, NULL, ''),
(137, 'MV1419L1-13', 20170926, 171609, 12000, '梁国成', '王云', 1, 1507713372, NULL, ''),
(138, 'MV1419L1-13', 20170926, 171914, 12000, '梁国成', '王小二', 1, 1507713558, NULL, ''),
(139, 'MV1419L1-13', 20170926, 171942, 12000, '梁国成', '王小二', 1, 1507714653, NULL, ''),
(140, 'MV1419L1-13', 20171012, 131614, 11202, '梁国成', '王大花', 1, 1507785389, NULL, '11202'),
(141, 'MV1419L1-13', 20171012, 132032, 11202, '梁国成', '王大花', 1, 1507785583, NULL, ''),
(142, 'MV1419L1-13', 20171012, 132629, 11202, '梁国成', '王大花', 1, 1507785991, NULL, ''),
(143, 'MV1419L1-13', 20171012, 132856, 11202, '梁国成', '王大花', 1, 1507786137, NULL, ''),
(144, 'MV1419L1-13', 20171012, 132937, 11202, '梁国成', '王大花', 1, 1507786179, NULL, ''),
(145, 'MV1419L1-13', 20171012, 133011, 11202, '梁国成', '王大花', 1, 1507786211, NULL, ''),
(146, 'MV1419L1-13', 20171012, 133202, 11202, '梁国成', '王大花', 1, 1507786326, NULL, ''),
(147, 'MV1419L1-13', 20171012, 133202, 11202, '梁国成', '王大花', 1, 1507786340, NULL, ''),
(148, 'MV1419L1-13', 20171012, 133222, 11202, '梁国成', '王大花', 1, 1507786343, NULL, ''),
(149, 'MV1419L1-13', 20171012, 133720, 11202, '梁国成', '王大花', 1, 1507786642, NULL, ''),
(150, 'MV1419L1-13', 20171012, 134221, 11202, '梁国成', '王大花', 1, 1507786942, NULL, ''),
(151, 'MV1419L1-13', 20171014, 92155, 1, '梁国成', '王大花', 1, 1507944240, NULL, ''),
(152, 'AM1663L6-1', 2017, 21, 2240, '梁国成', '王大花', 1, 1507986119, NULL, NULL),
(153, 'AM1663L1-1', 2017, 21, 2241, '梁国成', '王大花', 1, 1507986289, NULL, NULL),
(154, 'AM1663L1-1', 2017, 9, 221, '梁国成', '王小二', 1, 1507986452, 1508029232, ''),
(155, 'AM1663L1-1', 2017, 8, 12, '梁国成', '刘敏', 1, 1507987653, 1508458620, '');

-- --------------------------------------------------------

--
-- 表的结构 `sk_lens`
--

DROP TABLE IF EXISTS `sk_lens`;
CREATE TABLE IF NOT EXISTS `sk_lens` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL,
  `specs` smallint(5) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `material` varchar(10) DEFAULT NULL,
  `create_user` varchar(20) NOT NULL,
  `status` int(1) DEFAULT '1',
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

--
-- 插入之前先把表清空（truncate） `sk_lens`
--

TRUNCATE TABLE `sk_lens`;
--
-- 转存表中的数据 `sk_lens`
--

INSERT INTO `sk_lens` (`id`, `model`, `specs`, `color`, `material`, `create_user`, `status`, `create_time`, `update_time`) VALUES
(16, 'AM1663L2-1', 49, '绿色#2', 'E48R', '梁国成', 0, 1503711807, 1503711884),
(17, 'AM1663L6-1', 96, '绿色#2', 'E48R', '梁国成', 0, 1503650000, NULL),
(18, 'AM1964L2-1', 96, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(19, 'AM1964L2-2', 49, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(20, 'AM1964L3-1', 96, '绿色#1', 'OKP4', '梁国成', 1, 1503650000, NULL),
(21, 'AM1964L5-1', 164, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(22, 'AM1964L5-2', 96, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(23, 'AM1964L6-1', 164, '绿色#1', 'OKP4', '梁国成', 1, 1503650000, NULL),
(24, 'AM1964L6-2', 96, '绿色#1', 'OKP4', '梁国成', 1, 1503650000, NULL),
(25, 'AV1146L6-1', 96, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(26, 'AV1241L2-1', 96, '绿色#1', 'E48R', '梁国成', 1, 1503650000, NULL),
(27, 'AV1241L2-2', 96, '绿色#1', 'E48R', '梁国成', 1, 1503650000, NULL),
(28, 'AV1241L5-1', 136, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(29, 'AV1241L5-2', 136, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(30, 'AV1446L1-1', 48, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(31, 'AV1446L4-1', 96, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(32, 'AV1454L2-2', 96, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(33, 'AV1454L3-1', 96, '绿色#1', 'OKP4', '梁国成', 1, 1503650000, NULL),
(34, 'AV1454L5-2', 96, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(35, 'AV1454L5-3', 96, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(36, 'AV1541L2-1', 60, '绿色#1', 'E48R', '梁国成', 1, 1503650000, NULL),
(37, 'AV1541L3-1', 96, '绿色#1', 'OKP4', '梁国成', 1, 1503650000, NULL),
(38, 'AV1541L6-1', 96, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(39, 'AV1548L2-1', 96, '绿色#1', 'OKP4', '梁国成', 1, 1503650000, NULL),
(40, 'AV1548L3-1', 96, '绿色#1', 'E48R', '梁国成', 1, 1503650000, NULL),
(41, 'AV1745L4-1', 96, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(42, 'GEN4L3-1', 60, '绿色#1', 'OKP4', '梁国成', 1, 1503650000, NULL),
(43, 'GEN4L6-1', 60, '绿色#2', 'E48R', '梁国成', 1, 1503650000, NULL),
(44, 'MV1419L1-20', 379, '绿色#1', 'E48R', '梁国成', 1, 1503650000, NULL),
(45, 'MV1419L1-23', 379, '绿色#1', 'E48R', '梁国成', 1, 1503650000, NULL),
(46, 'MV1419L2-20', 379, '绿色#1', 'E48R', '梁国成', 1, 1503650000, NULL),
(47, 'MV1419L2-23', 379, '绿色#1', 'E48R', '梁国成', 1, 1503650000, NULL),
(48, 'SK0544L1-1', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(49, 'SK0544L1-2', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(50, 'SK0544L2-2', 214, '紫色#2', 'EP5000', '梁国成', 1, 1503650000, NULL),
(51, 'SK0544L3-2', 175, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(52, 'SK0544L4-1', 175, '紫色#2', 'EP7000', '梁国成', 1, 1503650000, NULL),
(53, 'SK0544L4-2', 175, '紫色#2', 'EP7000', '梁国成', 1, 1503650000, NULL),
(54, 'SK0544L5-2', 175, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(55, 'SK0544L6-2', 175, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(56, 'SK0551L1-1', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(57, 'SK0551L2-1', 214, '紫色#2', 'EP6000', '梁国成', 1, 1503650000, NULL),
(58, 'SK0551L3-1', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(59, 'SK0555L1-2', 216, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(60, 'SK0555L1-3', 216, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(61, 'SK0555L1-4', 216, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(62, 'SK0555L2-2', 216, '绿色#1', 'EP6000', '梁国成', 1, 1503650000, NULL),
(63, 'SK0555L2-3', 216, '绿色#1', 'EP6000', '梁国成', 1, 1503650000, NULL),
(64, 'SK0555L2-4', 216, '绿色#1', 'EP6000', '梁国成', 1, 1503650000, NULL),
(65, 'SK0555L3-2', 216, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(66, 'SK0555L3-3', 216, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(67, 'SK0555L3-4', 216, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(68, 'SK0555L4-2', 216, '绿色#2', 'K26R', '梁国成', 1, 1503650000, NULL),
(69, 'SK0555L4-3', 216, '绿色#2', 'K26R', '梁国成', 1, 1503650000, NULL),
(70, 'SK0555L4-4', 216, '绿色#2', 'K26R', '梁国成', 1, 1503650000, NULL),
(71, 'SK0557L1-1', 259, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(72, 'SK0557L2-1', 259, '紫色#2', 'EP6000', '梁国成', 1, 1503650000, NULL),
(73, 'SK0557L3-1', 259, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(74, 'SK0557L4-1', 259, '紫色#2', 'EP7000', '梁国成', 1, 1503650000, NULL),
(75, 'SK0557L5-1', 259, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(76, 'SK0557L6-1', 259, '紫色#2', 'EP6000', '梁国成', 1, 1503650000, NULL),
(77, 'SK0844L1-1', 175, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(78, 'SK0844L2-1', 175, '绿色#1', 'EP7000', '梁国成', 1, 1503650000, NULL),
(79, 'SK0844L3-1', 259, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(80, 'SK0844L4-1', 136, '绿色#2', 'K26R', '梁国成', 1, 1503650000, NULL),
(81, 'SK084CL1-1', 175, '蓝色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(82, 'SK084CL2-1', 175, '蓝色#2', 'EP4500', '梁国成', 1, 1503650000, NULL),
(83, 'SK084CL3-1', 259, '蓝色#1', 'K26R', '梁国成', 1, 1503650000, NULL),
(84, 'SK084CL4-1', 175, '蓝色#2', 'EP8000', '梁国成', 1, 1503650000, NULL),
(85, 'SK084CL5-1', 175, '蓝色#1', 'K26R', '梁国成', 1, 1503650000, NULL),
(86, 'SK084CL6-1', 175, '蓝色#2', 'EP4500', '梁国成', 1, 1503650000, NULL),
(87, 'SK1335L1-1', 136, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(88, 'SK1335L2-1', 175, '绿色#1', 'OKP1', '梁国成', 1, 1503650000, NULL),
(89, 'SK1335L3-1', 140, '绿色#2', 'APEL', '梁国成', 1, 1503650000, NULL),
(90, 'SK1335L4-1', 140, '绿色#2', 'K26R', '梁国成', 1, 1503650000, NULL),
(91, 'SN0832L4-3', 259, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(92, 'SN0832L4-8', 259, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(93, 'SN0832L1-11', 214, '紫色#2', 'EP5000', '梁国成', 1, 1503650000, NULL),
(94, 'SN0832L1-3', 214, '紫色#2', 'EP5000', '梁国成', 1, 1503650000, NULL),
(95, 'SN0832L1-8', 214, '紫色#2', 'EP5000', '梁国成', 1, 1503650000, NULL),
(96, 'SN0832L1-9', 214, '紫色#2', 'EP5000', '梁国成', 1, 1503650000, NULL),
(97, 'SN0832L2-11', 175, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(98, 'SN0832L2-3', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(99, 'SN0832L2-8', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(100, 'SN0832L2-9', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(101, 'SN0832L3-12', 259, '紫色#2', 'EP6000', '梁国成', 1, 1503650000, NULL),
(102, 'SN0832L3-3', 259, '紫色#2', 'EP6000', '梁国成', 1, 1503650000, NULL),
(103, 'SN0832L3-8', 259, '紫色#2', 'EP6000', '梁国成', 1, 1503650000, NULL),
(104, 'SN0832L3-9', 257, '紫色#2', 'EP6000', '梁国成', 1, 1503650000, NULL),
(105, 'SN0832L4-12', 259, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(106, 'SN0832L4-9', 259, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(107, 'SN0832L5-12', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(108, 'SN0832L5-3', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(109, 'SN0832L5-8', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(110, 'SN0832L5-9', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(111, 'SN0847L1-1', 216, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(112, 'SN0847L1-2', 216, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(113, 'SN0847L2-1', 216, '紫色#2', 'EP6000', '梁国成', 1, 1503650000, NULL),
(114, 'SN0847L2-2', 216, '紫色#2', 'EP6000', '梁国成', 1, 1503650000, NULL),
(115, 'SN0847L3-1', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(116, 'SN0847L3-2', 214, '紫色#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(117, 'SN0847L4-1', 136, '青绿#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(118, 'SN0847L4-2', 136, '青绿#1', 'APEL', '梁国成', 1, 1503650000, NULL),
(120, 'AV1654L2-1', 44, '绿色#2', 'APEL', '梁国成', 0, 1503706856, NULL),
(121, 'AV1654L3-1', 60, '绿色#2', 'APEL', '梁国成', 0, 1503706874, NULL),
(122, 'AV1654L4-1', 96, '绿色#1', 'EP7000', '梁国成', 0, 1503706896, 1503706896),
(127, 'AM1663L1-1', 111, '绿色#1', 'OKP4', '梁国成', 0, 1503813557, NULL),
(128, 'MV1418L2-5', 2, '绿色#3', 'E48R', '梁国成', 0, 1506327818, NULL),
(130, 'MV1419L2-13', 396, '绿色#1', 'E48R', '梁国成', 1, 1507950083, NULL),
(131, 'MV1419L1-13', 396, '绿色#1', 'E48R', '梁国成', 1, 1507950094, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sk_machine`
--

DROP TABLE IF EXISTS `sk_machine`;
CREATE TABLE IF NOT EXISTS `sk_machine` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` tinyint(2) NOT NULL,
  `nickname` varchar(1) NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 插入之前先把表清空（truncate） `sk_machine`
--

TRUNCATE TABLE `sk_machine`;
--
-- 转存表中的数据 `sk_machine`
--

INSERT INTO `sk_machine` (`id`, `name`, `nickname`, `create_user`, `create_time`) VALUES
(1, 1, 'A', '梁国成', 2147483647),
(2, 2, 'B', '梁国成', 2147483647),
(3, 3, 'C', '梁国成', 2147483647),
(4, 4, 'D', '梁国成', 2147483647),
(5, 5, 'E', '梁国成', 2147483647),
(6, 6, 'F', '梁国成', 2147483647),
(7, 7, 'G', '梁国成', 2147483647),
(8, 8, 'H', '梁国成', 2147483647),
(9, 9, 'I', '梁国成', 2147483647),
(10, 10, 'J', '梁国成', 2147483647),
(11, 11, 'K', '梁国成', 2147483647),
(12, 12, 'L', '梁国成', 2147483647),
(13, 13, 'M', '梁国成', 2147483647);

-- --------------------------------------------------------

--
-- 表的结构 `sk_menu`
--

DROP TABLE IF EXISTS `sk_menu`;
CREATE TABLE IF NOT EXISTS `sk_menu` (
  `menu_id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL DEFAULT '',
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `m` varchar(20) NOT NULL DEFAULT '',
  `c` varchar(20) NOT NULL DEFAULT '',
  `f` varchar(20) NOT NULL DEFAULT '',
  `data` varchar(100) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 插入之前先把表清空（truncate） `sk_menu`
--

TRUNCATE TABLE `sk_menu`;
--
-- 转存表中的数据 `sk_menu`
--

INSERT INTO `sk_menu` (`menu_id`, `name`, `parentid`, `m`, `c`, `f`, `data`, `listorder`, `status`, `type`) VALUES
(1, '菜单管理', 0, 'admin', 'menu', 'index', '', 2, 1, 1),
(2, '入库管理', 0, 'admin', 'enter', 'index', '', 10, 1, 1),
(3, '镀膜管理', 0, 'admin', 'coating', 'index', '', 9, 1, 1),
(4, '分光性能管理', 0, 'admin', 'spec', 'index', '', 7, 1, 1),
(5, '单品检查', 0, 'admin', 'check', 'index', '', 8, 1, 1),
(6, '基本管理', 0, 'admin', 'basic', 'index', '', 2, 1, 1),
(7, '用户管理', 0, 'admin', 'admin', 'index', '', 4, 1, 1),
(8, '文章管理', 0, 'admin', 'content', 'index', '', 1, -1, 1),
(9, '温湿度记录', 0, 'admin', 'temp', 'index', '', 6, 1, 1),
(10, '型号管理', 0, 'admin', 'lens', 'index', '', 5, 1, 1),
(11, '人员管理', 0, 'admin', 'users', 'index', '', 3, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sk_spec`
--

DROP TABLE IF EXISTS `sk_spec`;
CREATE TABLE IF NOT EXISTS `sk_spec` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `ct_lot` varchar(20) NOT NULL,
  `sp_type` smallint(2) unsigned NOT NULL,
  `sp_side` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `sp_time` int(10) NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  `ciex` float(6,5) DEFAULT NULL,
  `ciey` float(6,5) DEFAULT NULL,
  `tspec` float(6,4) unsigned DEFAULT NULL,
  `rspeca` float(6,4) unsigned DEFAULT NULL,
  `rspecb` float(6,4) unsigned DEFAULT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `sk_spec`
--

TRUNCATE TABLE `sk_spec`;
-- --------------------------------------------------------

--
-- 表的结构 `sk_spec_data`
--

DROP TABLE IF EXISTS `sk_spec_data`;
CREATE TABLE IF NOT EXISTS `sk_spec_data` (
  `id` mediumint(10) NOT NULL AUTO_INCREMENT,
  `ct_lot` varchar(20) NOT NULL,
  `type` tinyint(5) NOT NULL,
  `data` text NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 插入之前先把表清空（truncate） `sk_spec_data`
--

TRUNCATE TABLE `sk_spec_data`;
-- --------------------------------------------------------

--
-- 表的结构 `sk_temp`
--

DROP TABLE IF EXISTS `sk_temp`;
CREATE TABLE IF NOT EXISTS `sk_temp` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `temp_date` int(10) NOT NULL,
  `place` varchar(20) NOT NULL,
  `temp1` float(5,1) NOT NULL,
  `hum1` float(5,1) NOT NULL,
  `temp2` float(5,1) DEFAULT NULL,
  `hum2` float(5,1) DEFAULT NULL,
  `temp3` float(5,1) DEFAULT NULL,
  `hum3` float(5,1) DEFAULT NULL,
  `temp4` float(5,1) DEFAULT NULL,
  `hum4` float(5,1) DEFAULT NULL,
  `temp5` float(5,1) DEFAULT NULL,
  `hum5` float(5,1) DEFAULT NULL,
  `temp6` float(5,1) DEFAULT NULL,
  `hum6` float(5,1) DEFAULT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 插入之前先把表清空（truncate） `sk_temp`
--

TRUNCATE TABLE `sk_temp`;
--
-- 转存表中的数据 `sk_temp`
--

INSERT INTO `sk_temp` (`id`, `temp_date`, `place`, `temp1`, `hum1`, `temp2`, `hum2`, `temp3`, `hum3`, `temp4`, `hum4`, `temp5`, `hum5`, `temp6`, `hum6`, `create_user`, `create_time`, `update_time`, `status`) VALUES
(1, 1507987938, '镀膜区', 22.5, 49.0, 21.5, 48.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '梁国成', 1507987938, 1507987938, 1),
(2, 1507987938, '分光区', 22.5, 49.0, 21.5, 48.5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '梁国成', 1507987938, 1507987938, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sk_user`
--

DROP TABLE IF EXISTS `sk_user`;
CREATE TABLE IF NOT EXISTS `sk_user` (
  `id` smallint(10) NOT NULL AUTO_INCREMENT,
  `workid` int(10) DEFAULT NULL,
  `name` varchar(20) NOT NULL,
  `sexual` tinyint(1) unsigned DEFAULT NULL,
  `cardid` varchar(18) DEFAULT NULL,
  `dept` varchar(20) NOT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `joindate` int(10) NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `tips` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- 插入之前先把表清空（truncate） `sk_user`
--

TRUNCATE TABLE `sk_user`;
--
-- 转存表中的数据 `sk_user`
--

INSERT INTO `sk_user` (`id`, `workid`, `name`, `sexual`, `cardid`, `dept`, `mobile`, `joindate`, `create_user`, `create_time`, `update_time`, `status`, `tips`) VALUES
(1, NULL, '马士友', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(2, NULL, '熊世磊', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(3, NULL, '宋晓科', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(4, NULL, '史森堂', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(5, NULL, '范岩', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(6, NULL, '窦莹', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(7, NULL, '杨建民', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(8, NULL, '邓志远', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(9, NULL, '张乐乐', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(10, NULL, '董华晓', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(11, 60000, '单客客', 1, '371011111111111111', '镀膜', '13111111111', 2017, '梁国成', 1508372173, 1508380471, 1, ''),
(12, NULL, '王宏生', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(13, NULL, '张琦', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(14, NULL, '杨伟仿', NULL, NULL, '镀膜', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(15, NULL, '王云', NULL, NULL, '成型', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(16, NULL, '刘敏', NULL, NULL, '成型', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(17, NULL, '丁苏红', NULL, NULL, '成型', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(18, NULL, '冯素兰', NULL, NULL, '成型', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(19, NULL, '陈丽艳', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(20, NULL, '陈彦平', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(21, NULL, '崔远娥', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(22, NULL, '高海凤', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(23, NULL, '高立志', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(24, NULL, '韩红', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(25, NULL, '韩会如', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(26, NULL, '黄苗苗', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(27, NULL, '李凤美', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(28, NULL, '李圆圆', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(29, NULL, '连晓璇', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(30, NULL, '梁凤各', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(31, NULL, '宁璐璐', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(32, NULL, '齐群群', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(33, NULL, '宋文龙', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(34, NULL, '孙丹', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(35, NULL, '汤克燕', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(36, NULL, '唐久玲', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(37, NULL, '王贵群', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(38, NULL, '王金莲', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(39, NULL, '王锦凤', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(40, NULL, '王倩倩', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(41, NULL, '王瑞楠', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(42, NULL, '王守侠', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(43, NULL, '王雪', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(44, NULL, '王亚西', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(45, NULL, '王圆圆', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(46, NULL, '魏献玲', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(47, NULL, '杨园芳', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(48, NULL, '殷红倩', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(49, NULL, '张静瑶', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(50, NULL, '张茜茜', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(51, NULL, '张双菊', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(52, NULL, '张艳艳', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(53, NULL, '赵志芹', NULL, NULL, '单品', NULL, 1508372202, '梁国成', 1508372173, NULL, 1, NULL),
(54, 69009, '王小丫', 2, '371011111111111111', '成型', '13111111111', 1508342400, '梁国成', 1508377413, NULL, 0, '新入职'),
(55, 69010, '王小二', 1, '371011111111111111', '成型', '13122222222', 1508342400, '梁国成', 1508377781, NULL, 0, '新入职');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
