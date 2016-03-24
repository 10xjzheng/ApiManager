-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-24 10:20:58
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `api_manager`
--

-- --------------------------------------------------------

--
-- 表的结构 `api`
--

CREATE TABLE IF NOT EXISTS `api` (
  `apiId` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `fkProjectId` int(20) unsigned NOT NULL,
  `functionName` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `apiName` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `apiDiscribe` text COLLATE utf8_czech_ci,
  `number` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `params` text COLLATE utf8_czech_ci,
  `returnParams` text COLLATE utf8_czech_ci,
  `type` varchar(20) COLLATE utf8_czech_ci NOT NULL DEFAULT 'GET',
  `userId` int(32) NOT NULL,
  `lastTime` datetime NOT NULL,
  PRIMARY KEY (`apiId`),
  KEY `fkProjectId` (`fkProjectId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `api`
--

INSERT INTO `api` (`apiId`, `fkProjectId`, `functionName`, `apiName`, `apiDiscribe`, `number`, `params`, `returnParams`, `type`, `userId`, `lastTime`) VALUES
(4, 1, 'GetOrderDetail', '获取订单详情', '获取订单详情', '001', 'a:5:{s:4:"name";a:2:{i:0;s:6:"userId";i:1;s:7:"orderId";}s:9:"paramType";a:2:{i:0;s:3:"int";i:1;s:3:"int";}s:4:"type";a:2:{i:0;s:1:"Y";i:1;s:1:"Y";}s:7:"default";a:2:{i:0;s:0:"";i:1;s:0:"";}s:3:"des";a:2:{i:0;s:8:"用户id";i:1;s:8:"订单id";}}', 'a:6:{s:6:"parent";a:2:{i:0;s:1:"1";i:1;s:1:"1";}s:9:"tableName";a:2:{i:0;s:2:"r0";i:1;s:2:"r1";}s:4:"name";a:2:{i:0;s:8:"orderNum";i:1;s:8:"orderSum";}s:9:"paramType";a:2:{i:0;s:6:"string";i:1;s:6:"string";}s:7:"default";a:2:{i:0;s:0:"";i:1;s:0:"";}s:3:"des";a:2:{i:0;s:12:"订单编号";i:1;s:12:"订单金额";}}', 'POST', 1, '2016-03-17 15:00:13'),
(6, 1, 'SubmitOrder', '提交订单', '下单接口', '002', 'a:5:{s:4:"name";a:7:{i:0;s:6:"userId";i:1;s:8:"shop_uid";i:2;s:5:"goods";i:3;s:6:"remark";i:4;s:9:"addressId";i:5;s:4:"type";i:6;s:9:"orderType";}s:9:"paramType";a:7:{i:0;s:3:"int";i:1;s:3:"int";i:2;s:6:"string";i:3;s:6:"string";i:4;s:3:"int";i:5;s:6:"string";i:6;s:6:"string";}s:4:"type";a:7:{i:0;s:1:"Y";i:1;s:1:"Y";i:2;s:1:"Y";i:3;s:1:"Y";i:4;s:1:"Y";i:5;s:1:"Y";i:6;s:1:"Y";}s:7:"default";a:7:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";}s:3:"des";a:7:{i:0;s:8:"用户id";i:1;s:14:"商店用户id";i:2;s:56:"商品json格式：\r\n[{"id": 1,"num": 2，"price": 12 }]";i:3;s:6:"备注";i:4;s:8:"地址id";i:5;s:46:"付款方式 0:货到付款，1：在线支付";i:6;s:36:"1:购物车下单，2：立即下单";}}', 'a:6:{s:6:"parent";a:3:{i:0;s:1:"1";i:1;s:1:"1";i:2;s:1:"1";}s:9:"tableName";a:3:{i:0;s:2:"r0";i:1;s:2:"r1";i:2;s:2:"r2";}s:4:"name";a:3:{i:0;s:9:"order_num";i:1;s:8:"order_id";i:2;s:9:"order_sum";}s:9:"paramType";a:3:{i:0;s:6:"string";i:1;s:6:"string";i:2;s:6:"string";}s:7:"default";a:3:{i:0;s:0:"";i:1;s:0:"";i:2;s:0:"";}s:3:"des";a:3:{i:0;s:12:"订单编号";i:1;s:8:"订单id";i:2;s:12:"订单金额";}}', 'POST', 1, '2016-03-17 19:12:55'),
(7, 1, 'GetUserInfo', '获取用户信息', '', '003', 'a:5:{s:4:"name";a:1:{i:0;s:6:"userId";}s:9:"paramType";a:1:{i:0;s:3:"int";}s:4:"type";a:1:{i:0;s:1:"Y";}s:7:"default";a:1:{i:0;s:0:"";}s:3:"des";a:1:{i:0;s:8:"用户id";}}', 'a:6:{s:9:"tableName";a:1:{i:0;s:2:"r0";}s:6:"parent";a:1:{i:0;s:1:"1";}s:4:"name";a:1:{i:0;s:8:"username";}s:9:"paramType";a:1:{i:0;s:6:"string";}s:7:"default";a:1:{i:0;s:0:"";}s:3:"des";a:1:{i:0;s:12:"用户名称";}}', 'GET', 1, '2016-03-17 19:14:17');

-- --------------------------------------------------------

--
-- 表的结构 `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_czech_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- 转存表中的数据 `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1458024066),
('m140506_102106_rbac_init', 1458024093);

-- --------------------------------------------------------

--
-- 表的结构 `modify_logs`
--

CREATE TABLE IF NOT EXISTS `modify_logs` (
  `id` int(32) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `editTime` datetime NOT NULL,
  `content` text COLLATE utf8_czech_ci NOT NULL,
  `apiId` int(30) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `modify_logs`
--

INSERT INTO `modify_logs` (`id`, `userId`, `editTime`, `content`, `apiId`) VALUES
(1, 1, '2016-03-16 13:09:35', '新增接口', 4),
(2, 1, '2016-03-16 20:14:19', '新增返回字段orderNum', 4),
(3, 1, '2016-03-17 10:26:17', '添加订单金额字段', 4),
(4, 1, '2016-03-17 14:54:33', '测试', 4),
(5, 1, '2016-03-17 15:00:13', '保存了一部分信息', 4),
(6, 1, '2016-03-17 15:12:55', '添加提交订单接口', 6),
(7, 1, '2016-03-17 15:17:40', '完善提交订单接口', 6),
(8, 1, '2016-03-17 15:20:13', '修改订单编号', 6),
(9, 1, '2016-03-17 19:12:55', '添加订单金额字段order_sum', 6),
(10, 1, '2016-03-17 19:14:17', '添加新接口', 7);

-- --------------------------------------------------------

--
-- 表的结构 `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `projectId` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `projectName` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `projectHost` varchar(80) COLLATE utf8_czech_ci NOT NULL,
  `discribe` text COLLATE utf8_czech_ci,
  PRIMARY KEY (`projectId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='项目表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `project`
--

INSERT INTO `project` (`projectId`, `projectName`, `projectHost`, `discribe`) VALUES
(1, '消费保', 'http://ibona.f3322.net:8088/XiaoFeiBao/', '测试接口'),
(2, '百港汇', 'http://m.bganghui.com/index.php/Admin/Interface/', '');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `auth_key`, `password_reset_token`) VALUES
(1, 'admin', '123456', '', ''),
(2, 'demo', 'demo', '', '');

--
-- 限制导出的表
--

--
-- 限制表 `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- 限制表 `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
