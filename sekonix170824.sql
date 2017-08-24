-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-08-24 12:26:58
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

-- --------------------------------------------------------

--
-- 表的结构 `sk_admin`
--

CREATE TABLE IF NOT EXISTS `sk_admin` (
  `admin_id` mediumint(6) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL DEFAULT '89ca2407297cff2751bbef6eda6593f0',
  `lastloginip` varchar(15) DEFAULT NULL,
  `lastlogintime` int(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `group` smallint(5) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `realname` (`realname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `sk_admin`
--

INSERT INTO `sk_admin` (`admin_id`, `username`, `realname`, `password`, `lastloginip`, `lastlogintime`, `email`, `group`, `status`, `create_time`) VALUES
(1, 'jason', '梁国成', '89ca2407297cff2751bbef6eda6593f0', NULL, 1503552723, 'jason.leung@163.com', 1, 1, 2147483647),
(2, 'dinglinying', '丁林英', '89ca2407297cff2751bbef6eda6593f0', NULL, 1498696655, NULL, 1, 1, 2147483647);

-- --------------------------------------------------------

--
-- 表的结构 `sk_ckdata`
--

CREATE TABLE IF NOT EXISTS `sk_ckdata` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `ck_model` smallint(10) unsigned NOT NULL DEFAULT '0',
  `ck_lot` smallint(10) unsigned NOT NULL DEFAULT '0',
  `ck_user` varchar(20) NOT NULL,
  `ck_num` smallint(10) unsigned NOT NULL,
  `goods_num` smallint(10) unsigned DEFAULT NULL,
  `bads_num` smallint(10) unsigned DEFAULT NULL,
  `yiwu` smallint(10) unsigned DEFAULT NULL,
  `xiaoyiwu` smallint(10) unsigned DEFAULT NULL,
  `liangdian` smallint(10) unsigned DEFAULT NULL,
  `henji` smallint(10) unsigned DEFAULT NULL,
  `meibiaoqian` smallint(10) unsigned DEFAULT NULL,
  `paopan` smallint(10) unsigned DEFAULT NULL,
  `shaojingpian` smallint(10) unsigned DEFAULT NULL,
  `heidian` smallint(10) unsigned DEFAULT NULL,
  `fanjingpian` smallint(10) unsigned DEFAULT NULL,
  `qipao` smallint(10) unsigned DEFAULT NULL,
  `fm` smallint(10) unsigned DEFAULT NULL,
  `huahen` smallint(10) unsigned DEFAULT NULL,
  `yahen` smallint(10) unsigned DEFAULT NULL,
  `chengxingdian` smallint(10) unsigned DEFAULT NULL,
  `chengxingbuliang` smallint(10) unsigned DEFAULT NULL,
  `fabai` smallint(10) unsigned DEFAULT NULL,
  `xitouhuahen` smallint(10) unsigned DEFAULT NULL,
  `cailiaoxian` smallint(10) unsigned DEFAULT NULL,
  `cailiaoyiwu` smallint(10) unsigned DEFAULT NULL,
  `gate` smallint(10) unsigned DEFAULT NULL,
  `banyue` smallint(10) unsigned DEFAULT NULL,
  `dumo` smallint(10) unsigned DEFAULT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`,`ck_model`,`ck_lot`),
  UNIQUE KEY `id` (`id`),
  KEY `ck_model` (`ck_model`) USING BTREE,
  KEY `ck_lot` (`ck_lot`) USING BTREE,
  KEY `ck_user` (`ck_user`) USING BTREE,
  KEY `create_user` (`create_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sk_ckuser`
--

CREATE TABLE IF NOT EXISTS `sk_ckuser` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `ck_name` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`ck_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sk_ckuser`
--

INSERT INTO `sk_ckuser` (`id`, `ck_name`, `create_time`) VALUES
(1, '0', 2147483647);

-- --------------------------------------------------------

--
-- 表的结构 `sk_coating`
--

CREATE TABLE IF NOT EXISTS `sk_coating` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `ct_model` varchar(20) NOT NULL,
  `ct_machine` smallint(10) unsigned NOT NULL,
  `ct_date` date NOT NULL,
  `ct_lot` varchar(20) NOT NULL,
  `ct_user` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `over_time` time DEFAULT NULL,
  `ct_num` smallint(10) unsigned NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `spec_t` tinyint(1) unsigned DEFAULT NULL,
  `spec_r` tinyint(1) unsigned DEFAULT NULL,
  `ck_status` tinyint(1) unsigned DEFAULT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  `tips` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ct_model` (`ct_model`),
  KEY `ct_machine` (`ct_machine`),
  KEY `ct_user` (`ct_user`),
  KEY `create_user` (`create_user`),
  KEY `ct_lot` (`ct_lot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sk_color`
--

CREATE TABLE IF NOT EXISTS `sk_color` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `color_type` varchar(20) NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `create_user` (`create_user`),
  KEY `color_type` (`color_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

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
-- 表的结构 `sk_ctuser`
--

CREATE TABLE IF NOT EXISTS `sk_ctuser` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `ct_name` varchar(20) NOT NULL,
  `creat_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`ct_name`),
  KEY `creat_user` (`creat_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sk_ctuser`
--

INSERT INTO `sk_ctuser` (`id`, `ct_name`, `creat_user`, `create_time`) VALUES
(1, '马士友', '梁国成', 2147483647);

-- --------------------------------------------------------

--
-- 表的结构 `sk_enter`
--

CREATE TABLE IF NOT EXISTS `sk_enter` (
  `enter_id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `et_model` varchar(20) NOT NULL,
  `et_date` date NOT NULL,
  `et_time` time NOT NULL,
  `et_num` smallint(10) NOT NULL,
  `et_box` smallint(10) DEFAULT NULL,
  `create_user` varchar(20) NOT NULL,
  `md_user` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`enter_id`),
  KEY `et_model` (`et_model`) USING BTREE,
  KEY `md_user` (`md_user`),
  KEY `et_user` (`create_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `sk_enter`
--

INSERT INTO `sk_enter` (`enter_id`, `et_model`, `et_date`, `et_time`, `et_num`, `et_box`, `create_user`, `md_user`, `status`, `create_time`, `update_time`) VALUES
(5, 'MV1419L1-13', '2017-08-22', '16:40:21', 3950, 1, '丁林英', '王云', 1, 2147483647, NULL),
(6, 'MV1419L2-13', '2017-08-22', '16:41:13', 3950, 2, '丁林英', '王云', 1, 2147483647, NULL),
(7, 'AV1548L2-1', '2017-08-22', '16:41:46', 960, 3, '丁林英', '王云', 1, 2147483647, NULL),
(8, 'AV1548L3-1', '2017-08-22', '16:42:15', 960, 3, '丁林英', '王云', 1, 2147483647, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sk_lens`
--

CREATE TABLE IF NOT EXISTS `sk_lens` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL,
  `specs` smallint(5) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `material` varchar(10) DEFAULT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `model` (`model`),
  KEY `color` (`color`),
  KEY `create_user` (`create_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `sk_lens`
--

INSERT INTO `sk_lens` (`id`, `model`, `specs`, `color`, `material`, `create_user`, `create_time`, `update_time`) VALUES
(1, 'MV1419L1-13', 395, 'GREEN#1', 'E48R', '梁国成', 2147483647, NULL),
(3, 'MV1419L2-13', 395, 'GREEN#1', 'E48R', '梁国成', 2147483647, NULL),
(5, 'AV1548L2-1', 96, 'GREEN#1', 'OKP4', '梁国成', 2147483647, NULL),
(6, 'AV1548L3-1', 96, 'GREEN#1', 'E48R', '梁国成', 2147483647, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `sk_machine`
--

CREATE TABLE IF NOT EXISTS `sk_machine` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `nickname` varchar(1) NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `create_user` (`create_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `sk_machine`
--

INSERT INTO `sk_machine` (`id`, `name`, `nickname`, `create_user`, `create_time`) VALUES
(1, '1号机', 'A', '梁国成', 2147483647),
(2, '2号机', 'B', '梁国成', 2147483647),
(3, '3号机', 'C', '梁国成', 2147483647),
(4, '4号机', 'D', '梁国成', 2147483647),
(5, '5号机', 'E', '梁国成', 2147483647),
(6, '6号机', 'F', '梁国成', 2147483647),
(7, '7号机', 'G', '梁国成', 2147483647),
(8, '8号机', 'H', '梁国成', 2147483647),
(9, '9号机', 'I', '梁国成', 2147483647),
(10, '10号机', 'J', '梁国成', 2147483647),
(11, '11号机', 'K', '梁国成', 2147483647),
(12, '12号机', 'L', '梁国成', 2147483647),
(13, '13号机', 'M', '梁国成', 2147483647);

-- --------------------------------------------------------

--
-- 表的结构 `sk_mduser`
--

CREATE TABLE IF NOT EXISTS `sk_mduser` (
  `id` smallint(10) unsigned NOT NULL AUTO_INCREMENT,
  `md_name` varchar(20) NOT NULL,
  `create_user` varchar(20) NOT NULL,
  `create_time` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `md_name` (`md_name`),
  KEY `create_user` (`create_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `sk_mduser`
--

INSERT INTO `sk_mduser` (`id`, `md_name`, `create_user`, `create_time`) VALUES
(1, '王云', '梁国成', 2147483647);

-- --------------------------------------------------------

--
-- 表的结构 `sk_menu`
--

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
  PRIMARY KEY (`menu_id`),
  KEY `listorder` (`listorder`),
  KEY `parentid` (`parentid`),
  KEY `module` (`m`,`c`,`f`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `sk_menu`
--

INSERT INTO `sk_menu` (`menu_id`, `name`, `parentid`, `m`, `c`, `f`, `data`, `listorder`, `status`, `type`) VALUES
(1, '菜单管理', 0, 'admin', 'menu', 'index', '', 10, 1, 1),
(2, '入库管理', 0, 'admin', 'enter', 'index', '', 9, 1, 1),
(3, '镀膜管理', 0, 'admin', 'coating', 'index', '', 8, 1, 1),
(4, '分光性能管理', 0, 'admin', 'spec', 'index', '', 6, 1, 1),
(5, '单品检查', 0, 'admin', 'checkdata', 'index', '', 7, 1, 1),
(6, '基本管理', 0, 'admin', 'basic', 'index', '', 3, 1, 1),
(7, '用户管理', 0, 'admin', 'admin', 'index', '', 4, 1, 1),
(8, '文章管理', 0, 'admin', 'Content', 'index', '', 0, 1, 1),
(9, '温湿度记录', 0, 'admin', 'temperature', 'index', '', 5, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `sk_news`
--

CREATE TABLE IF NOT EXISTS `sk_news` (
  `news_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(80) NOT NULL DEFAULT '',
  `small_title` varchar(30) NOT NULL DEFAULT '',
  `title_font_color` varchar(250) DEFAULT NULL COMMENT '标题颜色',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `keywords` char(40) NOT NULL DEFAULT '',
  `description` varchar(250) NOT NULL COMMENT '文章描述',
  `posids` varchar(250) NOT NULL DEFAULT '',
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `copyfrom` varchar(250) DEFAULT NULL COMMENT '来源',
  `username` char(20) NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`news_id`),
  KEY `status` (`status`,`listorder`,`news_id`),
  KEY `listorder` (`catid`,`status`,`listorder`,`news_id`),
  KEY `catid` (`catid`,`status`,`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `sk_news`
--

INSERT INTO `sk_news` (`news_id`, `catid`, `title`, `small_title`, `title_font_color`, `thumb`, `keywords`, `description`, `posids`, `listorder`, `status`, `copyfrom`, `username`, `create_time`, `update_time`, `count`) VALUES
(17, 3, 'test', 'test', '#5674ed', '/upload/2016/03/06/56dbdc0c483af.JPG', 'sss', 'sss', '', 1, -1, '0', 'admin', 1455756856, 0, 0),
(18, 3, '你好ssss', '你好', '#ed568b', '/upload/2016/03/06/56dbdc015e662.JPG', '你好', '你好sssss  ss', '', 2, -1, '3', 'admin', 1455756999, 0, 0),
(19, 8, '1', '11', '#5674ed', '/upload/2016/02/28/56d312b12ccec.png', '1', '1', '', 0, -1, '0', 'admin', 1456673467, 0, 0),
(20, 3, '事实上', '11', '', '/upload/2016/02/28/56d3185781237.png', '1', '11', '', 0, -1, '0', 'admin', 1456674909, 0, 0),
(21, 3, '习近平今日下午出席解放军代表团全体会议', '习近平出席解放军代表团全体会议', '', '/upload/2016/03/13/56e519a185c93.png', '中共中央总书记 国家主席 中央军委主席 习近平', '中共中央总书记', '', 2, 1, '1', 'admin', 1457854896, 0, 60),
(22, 12, '李克强让部长们当第一新闻发言人', '李克强让部长们当第一新闻发言人', '', '/upload/2016/03/13/56e51b6ac8ce2.jpg', '李克强  新闻发言人', '部长直接面对媒体回应关切，还能直接读到民情民生民意，而不是看别人的舆情汇报。', '', 0, 1, '0', 'admin', 1457855362, 0, 33),
(23, 3, '重庆美女球迷争芳斗艳', '重庆美女球迷争芳斗艳', '', '/upload/2016/03/13/56e51cbd34470.png', '重庆美女 球迷 争芳斗艳', '重庆美女球迷争芳斗艳', '', 10, 1, '0', 'admin', 1457855680, 0, 22),
(24, 3, '中超-汪嵩世界波制胜 富力客场1-0力擒泰达', '中超-汪嵩世界波制胜 富力客场1-0力擒泰达', '', '/upload/2016/03/13/56e51fc82b13a.png', '中超 汪嵩世界波  富力客场 1-0力擒泰达', '中超-汪嵩世界波制胜 富力客场1-0力擒泰达', '', 1, 1, '0', 'admin', 1457856460, 0, 25);

-- --------------------------------------------------------

--
-- 表的结构 `sk_news_content`
--

CREATE TABLE IF NOT EXISTS `sk_news_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` mediumint(8) unsigned NOT NULL,
  `content` mediumtext NOT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `news_id` (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `sk_news_content`
--

INSERT INTO `sk_news_content` (`id`, `news_id`, `content`, `create_time`, `update_time`) VALUES
(7, 17, '&lt;p&gt;\r\n	gsdggsgsgsgsg\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	sgsg\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	gsdgsg \r\n&lt;/p&gt;\r\n&lt;p style=&quot;text-align:center;&quot;&gt;\r\n	       ggg\r\n&lt;/p&gt;', 1455756856, 0),
(8, 18, '&lt;p&gt;\r\n	你好\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	我很好dsggfg\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	gsgfgdfgd\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	gggg\r\n&lt;/p&gt;', 1455756999, 0),
(9, 19, '111', 1456673467, 0),
(10, 20, '111', 1456674909, 0),
(11, 21, '&lt;p&gt;\r\n	&lt;span style=&quot;font-family:''Microsoft YaHei'', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;font-size:16px;line-height:32px;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3月13日下午，中共中央总书记、国家主席、中央军委主席习近平出席十二届全国人大四次会议解放军代表团全体会议，并发表重要讲话。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-family:''Microsoft YaHei'', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;font-size:16px;line-height:32px;&quot;&gt;&lt;img src=&quot;/upload/2016/03/13/56e519acb12ee.png&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;/span&gt;\r\n&lt;/p&gt;', 1457854896, 0),
(12, 22, '&lt;p style=&quot;font-size:16px;font-family:''Microsoft YaHei'', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;&quot;&gt;\r\n	&amp;nbsp; &amp;nbsp; “部长通道”是今年两会一大亮点，成为两会开放透明和善待媒体的一个象征。在这个通道上，以往记者拉着喊着部长接受采访的场景不见了，变为部长主动站出来回应关切，甚至变成部长排队10多分钟等着接受采访。媒体报道称，两会前李克强总理接连两次“发话”，要求各部委主要负责人“要积极回应舆论关切”。部长主动放料，使这个通道上传出了很多新闻，如交通部长对拥堵费传闻的回应，人社部部长称网传延迟退休时间表属误读等。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:''Microsoft YaHei'', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;&quot;&gt;\r\n	&amp;nbsp; &amp;nbsp; &amp;nbsp;&amp;nbsp;&lt;img src=&quot;/upload/2016/03/13/56e51b7fcd445.jpg&quot; alt=&quot;&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:''Microsoft YaHei'', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;&quot;&gt;\r\n	&amp;nbsp; &amp;nbsp; &amp;nbsp; 记者之所以喜欢跑两会，原因之一是两会上高官云集，能“堵”到、“逮”到、“抢”到很多大新闻——现在不需要堵、逮和抢，部长们主动曝料，打通了各种阻隔，树立了开明开放的政府形象。期待“部长通道”不只在两会期间存在，最好能成为一种官媒交流、官民沟通的常态化新闻通道。\r\n&lt;/p&gt;\r\n&lt;p style=&quot;font-size:16px;font-family:''Microsoft YaHei'', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;&quot;&gt;\r\n	&lt;span style=&quot;font-family:''Microsoft YaHei'', u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53;font-size:16px;line-height:32px;&quot;&gt;部长们多面对媒体多发言，不仅能提高自身的媒介素养，也带动部门新闻发言人，更加重视与媒体沟通。部长直接面对媒体回应关切，还能直接读到民情民生民意，而不是看别人的舆情汇报。&lt;/span&gt;\r\n&lt;/p&gt;', 1457855362, 0),
(13, 23, '&lt;p&gt;\r\n	&lt;span style=&quot;color:#666666;font-family:''Microsoft Yahei'', 微软雅黑, SimSun, 宋体, ''Arial Narrow'', serif;font-size:14px;line-height:28px;background-color:#FFFFFF;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2016年3月13日，2016年中超联赛第2轮：重庆力帆vs河南建业，主场美女球迷争芳斗艳。&lt;/span&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;span style=&quot;color:#666666;font-family:''Microsoft Yahei'', 微软雅黑, SimSun, 宋体, ''Arial Narrow'', serif;font-size:14px;line-height:28px;background-color:#FFFFFF;&quot;&gt;&lt;img src=&quot;/upload/2016/03/13/56e51cb17542e.png&quot; alt=&quot;&quot; /&gt;&lt;img src=&quot;/upload/2016/03/13/56e51cb180f8a.png&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\r\n&lt;/span&gt;\r\n&lt;/p&gt;', 1457855680, 0),
(14, 24, '<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	新浪体育讯　　北京时间2016年3月12日晚7点35分，2016年中超联赛第2轮的一场比赛在天津水滴体育场进行。由天津泰达主场对阵广州富力。上半场双方机会都不多，<strong>下半场第57分钟，常飞亚左路护住皮球回做，汪嵩迎球直接远射世界波破门。随后天津泰达尽管全力进攻，但伊万诺维奇和迪亚涅都浪费了近在咫尺的机会</strong>，最终不得不0-1主场告负。\r\n</p>\r\n<p>\r\n	<img src="/upload/2016/03/13/56e51f63a5742.png" alt="" width="474" height="301" title="" align="" /> \r\n</p>\r\n<p>\r\n	由于首轮中超对阵北京国安的比赛延期举行，因此本场比赛实际上是天津泰达本赛季的首次亮相。新援蒙特罗领衔锋线，两名外援中后卫均首发出场。另一方面，在首轮主场不敌中超新贵河北华夏之后，本赛季球员流失较多的广州富力也许不得不早早开始他们的保级谋划。本场陈志钊红牌停赛，澳大利亚外援吉安努顶替了上轮首发的肖智。\r\n</p>\r\n<p>\r\n	广州富力显然更快地适应了比赛节奏。第3分钟，吉安努前插领球大步杀入禁区形成单刀，回防的赞纳迪内果断放铲化解险情。第8分钟，雷纳尔迪尼奥左路踩单车过人后低平球传中，约万诺维奇伸出大长腿将球挡出底线。第14分钟，富力队左路传中到远点，聂涛头球解围险些失误，送出本场比赛第一个角球。\r\n</p>\r\n<p>\r\n	天津队中场的配合逐渐找到一些感觉。第23分钟，天津队通过一连串小配合打到左路，周海滨下底传中被挡出底线。角球被富力队顶出后天津队二次将球传到禁区前沿，蒙特罗转身后射门但软弱无力被程月磊得到。第27分钟，约万诺维奇断球后直塞蒙特罗，蒙特罗转身晃开后卫在禁区外大力轰门打高。第29分钟，瓦格纳任意球吊入禁区，程月磊出击失误没有击到球，天津队后点将球再次传中，姜至鹏在对方夹击下奋力将球顶出底线。\r\n</p>\r\n<p>\r\n	双方都没有太好的打开僵局的办法，开始陷入苦战。第33分钟，常飞亚左路晃开空档突然起脚，皮球擦着近门柱稍稍偏出底线。第43分钟，白岳峰被雷纳尔迪尼奥断球得手，后者利用速度甩开约万诺维奇，低平球传中又躲过了赞纳迪内的滑铲，但吉安努门前近在咫尺的推射被杨启鹏神奇地单腿挡出！双方半场只得0-0互交白卷。\r\n</p>\r\n<p>\r\n	中场休息双方都没有换人。第47分钟，蒙特罗前场扣过多名对方队员后将球交给周海滨，但周海滨传中时禁区内的胡人天越位在先。第51分钟，王嘉楠右路晃开聂涛下底，但传中球又高又远。第54分钟，雷纳尔迪尼奥中场拿球挑过李本舰，后者无奈将其放倒吃到黄牌。第57分钟，常飞亚左路护住皮球回做，汪嵩迎球直接远射，杨启鹏鞭长莫及，皮球呼啸着直挂远角！世界波！富力队客场1-0取得领先。\r\n</p>\r\n<p>\r\n	第62分钟，瓦格纳任意球吊到禁区，程月磊再次拿球脱手，幸亏张耀坤将球踢出了边线。天津队率先做出调整，迪亚涅和周通两名前锋登场换下郭皓和瓦格纳。第64分钟，天津队右路传中，周通禁区内甩头攻门，程月磊侧扑将球得到。富力队并未保守。第66分钟，常飞亚左路连续盘带杀入禁区，小角度射门打偏。不过一分钟，雷纳尔迪尼奥禁区右角远射，皮球在门前反弹后稍稍偏出。\r\n</p>\r\n<p>\r\n	第71分钟，吉安努禁区角上回做，常飞亚跟进远射，杨启鹏单掌将球托出。天津队马上打出反击，蒙特罗禁区内转身将球分到右路，胡人天的传中找到后排插上的周海滨，但后者的大力头球顶得太正被程月磊侯个正着。富力队肖智换下卢琳。第74分钟，迪亚涅依靠强壮的身体杀入禁区直塞，蒙特罗停球后射门被密集防守的后卫挡出。\r\n</p>\r\n<p>\r\n	于洋换下雷纳尔迪尼奥，富力队加强防守。第81分钟，天津队角球开出，迪亚涅甩头攻门顶偏。天津队连续得到角球机会。第85分钟，天津队角球二次进攻，周通传中，蒙特罗后点头球回做，约万诺维奇离门不到两米处转身扫射竟然将球踢飞！\r\n</p>\r\n<div id="ad_33" class="otherContent_01" style="margin:10px 20px 10px 0px;padding:4px;">\r\n	<iframe width="300px" height="250px" frameborder="0" src="http://img.adbox.sina.com.cn/ad/28543.html">\r\n	</iframe>\r\n</div>\r\n<p>\r\n	天津队范柏群换下李本舰。富力队用宁安换下常飞亚。第88分钟，胡人天战术犯规吃到黄牌。天津队久攻不下，第90分钟，赞纳迪内40米开外远射打偏。第93分钟，蒙特罗左路传中，迪亚涅头球争顶下来之后顺势扫射，皮球贴着横梁高出。广州富力最终将优势保持到了终场取得三分。\r\n</p>\r\n<p>\r\n	进球信息：\r\n</p>\r\n<p>\r\n	天津泰达：无。\r\n</p>\r\n<p>\r\n	广州富力：第58分钟，卢琳左路回做，汪嵩跟上远射破网。\r\n</p>\r\n<p>\r\n	黄牌信息：\r\n</p>\r\n<p>\r\n	天津泰达：第54分钟，李本舰。第88分钟，胡人天。\r\n</p>\r\n<p>\r\n	广州富力：无。\r\n</p>\r\n<p>\r\n	红牌信息：\r\n</p>\r\n<p>\r\n	无。\r\n</p>\r\n<p>\r\n	双方出场阵容：\r\n</p>\r\n<p>\r\n	天津泰达（4-5-1）：29-杨启鹏，23-聂涛、3-赞纳迪内、5-约万诺维奇、19-白岳峰，6-周海滨、7-李本舰（86分钟，28-范柏群）、8-胡人天、11-瓦格纳（63分钟，9-迪亚涅）、22-郭皓（63分钟，33-周通），10-蒙特罗；\r\n</p>\r\n<p>\r\n	广州富力（4-5-1）：1-程月磊，11-姜至鹏、5-张耀坤、22-张贤秀、28-王嘉楠，7-斯文森、21-常飞亚（88分钟，15-宁安）、23-卢琳（73分钟，29-肖智）、31-雷纳尔迪尼奥（77分钟，3-于洋）、33-汪嵩，9-吉安努。\r\n</p>\r\n<p>\r\n	（卢小挠）\r\n</p>\r\n<div>\r\n</div>\r\n<div style="font-size:0px;">\r\n</div>\r\n<p>\r\n	<br />\r\n</p>', 1457856460, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sk_position`
--

CREATE TABLE IF NOT EXISTS `sk_position` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` char(100) DEFAULT NULL,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `sk_position`
--

INSERT INTO `sk_position` (`id`, `name`, `status`, `description`, `create_time`, `update_time`) VALUES
(1, '首页大图', -1, '展示首页大图的推荐位1', 1455634352, 0),
(2, '首页大图', 1, '展示首页大图的', 1455634715, 0),
(3, '小图推荐', 1, '小图推荐位', 1456665873, 0),
(4, '首页后侧推荐位', -1, '', 1457248469, 0),
(5, '右侧广告位', 1, '右侧广告位', 1457873143, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sk_position_content`
--

CREATE TABLE IF NOT EXISTS `sk_position_content` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `position_id` int(5) unsigned NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) DEFAULT NULL,
  `news_id` mediumint(8) unsigned NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `sk_position_content`
--

INSERT INTO `sk_position_content` (`id`, `position_id`, `title`, `thumb`, `url`, `news_id`, `listorder`, `status`, `create_time`, `update_time`) VALUES
(23, 2, 'test', '/upload/2016/03/06/56dbdc0c483af.JPG', NULL, 17, 1, -1, 1455756856, 0),
(24, 2, '你好ssss', '/upload/2016/03/06/56dbdc015e662.JPG', NULL, 18, 2, -1, 1455756999, 0),
(25, 3, 'test', '/upload/2016/03/06/56dbdc0c483af.JPG', NULL, 17, 0, -1, 1455756856, 0),
(26, 2, 'ss', '/upload/2016/03/07/56dcbce02cab9.JPG', 'http://sina.com.cn', 0, 0, -1, 1457306890, 0),
(27, 2, '文章18测试sss', '/upload/2016/03/07/56dcc0158f70e.JPG', '', 18, 0, -1, 1457306930, 0),
(28, 2, '习近平今日下午出席解放军代表团全体会议', '/upload/2016/03/13/56e519a185c93.png', NULL, 21, 0, 1, 1457854896, 0),
(29, 3, '李克强让部长们当第一新闻发言人', '/upload/2016/03/13/56e51b6ac8ce2.jpg', NULL, 22, 12, 1, 1457855362, 0),
(30, 3, '重庆美女球迷争芳斗艳', '/upload/2016/03/13/56e51cbd34470.png', NULL, 23, 0, 1, 1457855680, 0),
(31, 3, '中超-汪嵩世界波制胜 富力客场1-0力擒泰达', '/upload/2016/03/13/56e51fc82b13a.png', NULL, 24, 0, 1, 1457856460, 0),
(32, 5, '2015劳伦斯国际体坛精彩瞬间', '/upload/2016/03/13/56e5612d525c3.png', 'http://sports.sina.com.cn/laureus/moment2015/', 0, 0, 1, 1457873220, 0),
(33, 5, 'singwa老师教您如何学PHP', '/upload/2016/03/13/56e56211c68e7.jpg', 'http://t.imooc.com/space/teacher/id/255838', 0, 0, 1, 1457873435, 0),
(34, 2, '习近平今日下午出席解放军代表团全体会议', '/upload/2016/03/13/56e519a185c93.png', NULL, 21, 0, 1, 1457854896, 0),
(35, 2, '中超-汪嵩世界波制胜 富力客场1-0力擒泰达', '/upload/2016/03/13/56e51fc82b13a.png', NULL, 24, 0, 1, 1457856460, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sk_spec`
--

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
  PRIMARY KEY (`id`),
  KEY `ct_lot` (`ct_lot`),
  KEY `create_user` (`create_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `sk_spec_data`
--

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
-- 限制导出的表
--

--
-- 限制表 `sk_ckdata`
--
ALTER TABLE `sk_ckdata`
  ADD CONSTRAINT `sk_ckdata_ibfk_1` FOREIGN KEY (`ck_user`) REFERENCES `sk_ckuser` (`ck_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sk_ckdata_ibfk_2` FOREIGN KEY (`create_user`) REFERENCES `sk_admin` (`realname`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `sk_coating`
--
ALTER TABLE `sk_coating`
  ADD CONSTRAINT `sk_coating_ibfk_1` FOREIGN KEY (`ct_model`) REFERENCES `sk_lens` (`model`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sk_coating_ibfk_2` FOREIGN KEY (`ct_machine`) REFERENCES `sk_machine` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sk_coating_ibfk_3` FOREIGN KEY (`ct_user`) REFERENCES `sk_ctuser` (`ct_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sk_coating_ibfk_4` FOREIGN KEY (`create_user`) REFERENCES `sk_admin` (`realname`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `sk_ctuser`
--
ALTER TABLE `sk_ctuser`
  ADD CONSTRAINT `sk_ctuser_ibfk_1` FOREIGN KEY (`creat_user`) REFERENCES `sk_admin` (`realname`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `sk_enter`
--
ALTER TABLE `sk_enter`
  ADD CONSTRAINT `sk_enter_ibfk_1` FOREIGN KEY (`et_model`) REFERENCES `sk_lens` (`model`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sk_enter_ibfk_2` FOREIGN KEY (`md_user`) REFERENCES `sk_mduser` (`md_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sk_enter_ibfk_3` FOREIGN KEY (`create_user`) REFERENCES `sk_admin` (`realname`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `sk_machine`
--
ALTER TABLE `sk_machine`
  ADD CONSTRAINT `sk_machine_ibfk_1` FOREIGN KEY (`create_user`) REFERENCES `sk_admin` (`realname`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `sk_mduser`
--
ALTER TABLE `sk_mduser`
  ADD CONSTRAINT `sk_mduser_ibfk_1` FOREIGN KEY (`create_user`) REFERENCES `sk_admin` (`realname`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 限制表 `sk_spec`
--
ALTER TABLE `sk_spec`
  ADD CONSTRAINT `sk_spec_ibfk_1` FOREIGN KEY (`ct_lot`) REFERENCES `sk_coating` (`ct_lot`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sk_spec_ibfk_2` FOREIGN KEY (`create_user`) REFERENCES `sk_admin` (`realname`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
