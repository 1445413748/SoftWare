/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : s78

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2018-07-18 16:25:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` char(32) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for appraises
-- ----------------------------
DROP TABLE IF EXISTS `appraises`;
CREATE TABLE `appraises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL COMMENT '订单ID',
  `goodsid` int(11) NOT NULL COMMENT '评价商品ID',
  `userid` int(11) NOT NULL COMMENT '会员ID',
  `score` tinyint(1) NOT NULL DEFAULT '1' COMMENT '好评 1  中评 2  差评 3',
  `content` text NOT NULL COMMENT '点评内容',
  `reply` text COMMENT '店铺回复',
  `replytime` datetime DEFAULT NULL,
  `images` text,
  `show` tinyint(1) DEFAULT '1' COMMENT '1显示 2不显示',
  `createtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of appraises
-- ----------------------------
INSERT INTO `appraises` VALUES ('39', '158', '27', '20', '1', '非常好的平板.流畅的不要不要的', '感谢您的好评,欢迎下次光临', '2018-07-16 14:37:04', null, '1', '2018-07-16 14:36:22');
INSERT INTO `appraises` VALUES ('40', '160', '22', '20', '1', '商品很好', '感谢您的好评', '2018-07-16 15:37:59', null, '1', '2018-07-16 15:35:16');

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT '0' COMMENT '父ID',
  `path` varchar(250) NOT NULL DEFAULT '0,' COMMENT '分类路径',
  `name` varchar(20) NOT NULL,
  `display` tinyint(1) DEFAULT '1' COMMENT '1显示 2不显示',
  PRIMARY KEY (`id`),
  UNIQUE KEY `catName` (`name`),
  KEY `catName_2` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '0', '0,', '手机', '1');
INSERT INTO `category` VALUES ('53', '0', '0,', '电脑周边', '1');
INSERT INTO `category` VALUES ('54', '0', '0,', '移动存储', '1');
INSERT INTO `category` VALUES ('55', '0', '0,', '智能设备', '1');
INSERT INTO `category` VALUES ('65', '1', '0,1,', '手机通讯', '1');
INSERT INTO `category` VALUES ('66', '53', '0,53,', '平板电脑', '1');
INSERT INTO `category` VALUES ('59', '53', '0,53,', '电脑配件', '1');
INSERT INTO `category` VALUES ('60', '54', '0,54,', 'U盘', '1');
INSERT INTO `category` VALUES ('61', '54', '0,54,', '移动硬盘', '1');
INSERT INTO `category` VALUES ('62', '55', '0,55,', '穿戴设备', '1');
INSERT INTO `category` VALUES ('63', '55', '0,55,', '智能家居', '1');

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '分类id',
  `name` varchar(255) NOT NULL COMMENT '商品名',
  `price` decimal(11,2) NOT NULL COMMENT '商品单价',
  `stock` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '库存',
  `sold` int(11) DEFAULT '0' COMMENT '已售',
  `up` tinyint(1) DEFAULT '1' COMMENT '1-上架  2-下架',
  `hot` tinyint(1) DEFAULT '2' COMMENT '1-热销  2-滞销',
  `desc` varchar(255) DEFAULT NULL COMMENT '描述',
  `addtime` datetime NOT NULL COMMENT '添加时间',
  `uptime` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('13', '65', '360手机 N7 全网通 6GB+128GB 月岩白色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1999.00', '3000', '0', '1', '1', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('14', '65', '360手机 N7 全网通 6GB+64GB 石墨黑色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1699.00', '988', '0', '1', '1', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('15', '65', '360手机 N7 全网通 6GB+128GB 石墨黑色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1899.00', '2335', '6', '1', '1', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('16', '65', '360手机 N7 全网通 6GB+128GB 月岩白色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1899.00', '3000', '0', '1', '1', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('17', '65', '【音乐套装】360手机 N6 Pro 全网通 4GB+64GB 钛泽银色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1399.00', '2999', '0', '1', '1', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('18', '65', '360手机 N6 Pro 全网通 6GB+128GB 深海蓝色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1899.00', '2999', '1', '1', '1', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('19', '65', ' 360手机 N6 全网通 4GB+64GB 燧石黑色 移动联通电信4G手机 双卡双待', '1099.00', '2998', '2', '1', '1', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('20', '65', '360手机 N6 Pro 全网通 6GB+64GB 深海蓝色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1599.00', '2998', '0', '1', '2', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('21', '65', '【碎屏险套装】360手机 N6 Pro 全网通 4GB+128GB 钛泽银色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1699.00', '2998', '0', '1', '1', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('22', '65', '【音乐套装】360手机 N6 全网通 6GB+64GB 琉璃蓝色 移动联通电信4G手机 双卡双待', '1399.00', '2984', '2', '1', '1', '', '2018-07-07 00:00:00', null);
INSERT INTO `goods` VALUES ('23', '65', '   360手机 N6 Pro 全网通 6GB+128GB 极夜黑色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1899.00', '2997', '3', '1', '1', '', '2018-07-14 00:00:00', null);
INSERT INTO `goods` VALUES ('24', '65', '【碎屏险套装】360手机 N6 Pro 全网通 6GB+128GB 钛泽银色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '1949.00', '2999', '1', '1', '1', '', '2018-07-15 00:00:00', null);
INSERT INTO `goods` VALUES ('25', '66', '   Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MPGW2CH/A）金色', '2988.00', '3000', '0', '1', '1', '', '2018-07-15 00:00:00', null);
INSERT INTO `goods` VALUES ('26', '66', 'Apple iPad mini 4 平板电脑 7.9英寸（128G WLAN版/A8芯片/Retina显示屏/Touch ID技术 MK9Q2CH）金色', '2688.00', '3000', '0', '1', '1', '', '2018-07-15 00:00:00', null);
INSERT INTO `goods` VALUES ('27', '66', '          Apple iPad Pro平板电脑 9.7 英寸（32G WLAN版/A9X芯片/Retina显示屏/Multi-Touch技术MLMN2CH）深空灰色', '4388.00', '1996', '2', '1', '1', '', '2018-07-15 00:00:00', null);
INSERT INTO `goods` VALUES ('28', '66', 'Apple iPad 平板电脑 9.7英寸（128G WLAN版/A9 芯片/Retina显示屏/Touch ID技术 MP2J2CH/A）银色', '2968.00', '1999', '0', '1', '1', '', '2018-07-15 00:00:00', null);
INSERT INTO `goods` VALUES ('29', '66', 'Apple iPad Pro平板电脑 9.7 英寸（32G WLAN版/A9X芯片/Retina显示屏/Multi-Touch技术MM172CH）玫瑰金色', '5999.00', '2000', '0', '1', '1', '', '2018-07-15 00:00:00', null);

-- ----------------------------
-- Table structure for goodsimg
-- ----------------------------
DROP TABLE IF EXISTS `goodsimg`;
CREATE TABLE `goodsimg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL COMMENT '商品id',
  `icon` varchar(30) NOT NULL COMMENT '商品图片名',
  `face` tinyint(1) DEFAULT '2' COMMENT '1-封面  2-非封面',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goodsimg
-- ----------------------------
INSERT INTO `goodsimg` VALUES ('70', '16', '201807155b4afb75bd969.jpg', '2');
INSERT INTO `goodsimg` VALUES ('20', '13', '201807075b405b665bc87.jpg', '2');
INSERT INTO `goodsimg` VALUES ('69', '16', '201807155b4afb57ba7bd.jpg', '2');
INSERT INTO `goodsimg` VALUES ('23', '14', '201807075b406afb812d6.jpg', '1');
INSERT INTO `goodsimg` VALUES ('79', '15', '201807155b4afd2040323.jpg', '1');
INSERT INTO `goodsimg` VALUES ('67', '16', '201807155b4afaf209c52.jpg', '1');
INSERT INTO `goodsimg` VALUES ('27', '18', '201807075b406de123878.jpg', '2');
INSERT INTO `goodsimg` VALUES ('28', '19', '201807075b406e29b2a20.jpg', '1');
INSERT INTO `goodsimg` VALUES ('29', '20', '201807075b406e612a333.jpg', '2');
INSERT INTO `goodsimg` VALUES ('50', '21', '201807155b4af68bc75da.jpg', '2');
INSERT INTO `goodsimg` VALUES ('31', '22', '201807075b406ee042ae0.jpg', '1');
INSERT INTO `goodsimg` VALUES ('83', '14', '201807155b4afdf032411.jpg', '2');
INSERT INTO `goodsimg` VALUES ('34', '20', '201807105b44b5331500c.jpg', '1');
INSERT INTO `goodsimg` VALUES ('59', '18', '201807155b4af8d295278.jpg', '1');
INSERT INTO `goodsimg` VALUES ('46', '22', '201807155b4af5a2d4b6e.jpg', '2');
INSERT INTO `goodsimg` VALUES ('37', '23', '201807145b49c92696a1b.jpg', '1');
INSERT INTO `goodsimg` VALUES ('40', '24', '201807155b4af3b7870d9.jpg', '2');
INSERT INTO `goodsimg` VALUES ('39', '24', '201807155b4af39cbf906.jpg', '1');
INSERT INTO `goodsimg` VALUES ('41', '24', '201807155b4af3c463d50.jpg', '2');
INSERT INTO `goodsimg` VALUES ('42', '24', '201807155b4af3cee6983.jpg', '2');
INSERT INTO `goodsimg` VALUES ('43', '23', '201807155b4af4cc14049.jpg', '2');
INSERT INTO `goodsimg` VALUES ('44', '23', '201807155b4af4d71fa59.jpg', '2');
INSERT INTO `goodsimg` VALUES ('45', '23', '201807155b4af4e120c35.jpg', '2');
INSERT INTO `goodsimg` VALUES ('47', '22', '201807155b4af5afdd328.jpg', '2');
INSERT INTO `goodsimg` VALUES ('48', '22', '201807155b4af5ba7af4e.jpg', '2');
INSERT INTO `goodsimg` VALUES ('49', '21', '201807155b4af66c46fef.jpg', '1');
INSERT INTO `goodsimg` VALUES ('51', '21', '201807155b4af6987c978.jpg', '2');
INSERT INTO `goodsimg` VALUES ('52', '21', '201807155b4af6a39bff5.jpg', '2');
INSERT INTO `goodsimg` VALUES ('53', '20', '201807155b4af7601b869.jpg', '2');
INSERT INTO `goodsimg` VALUES ('54', '20', '201807155b4af775d986e.jpg', '2');
INSERT INTO `goodsimg` VALUES ('55', '19', '201807155b4af7a7d0f28.jpg', '2');
INSERT INTO `goodsimg` VALUES ('56', '19', '201807155b4af7b6c2fef.jpg', '2');
INSERT INTO `goodsimg` VALUES ('58', '19', '201807155b4af8020fdf0.jpg', '2');
INSERT INTO `goodsimg` VALUES ('60', '18', '201807155b4af8e3a5430.jpg', '2');
INSERT INTO `goodsimg` VALUES ('61', '18', '201807155b4af8f9c31c9.jpg', '2');
INSERT INTO `goodsimg` VALUES ('62', '17', '201807155b4af94d64938.jpg', '1');
INSERT INTO `goodsimg` VALUES ('63', '17', '201807155b4af957ec38c.jpg', '2');
INSERT INTO `goodsimg` VALUES ('64', '17', '201807155b4af968272ea.jpg', '2');
INSERT INTO `goodsimg` VALUES ('66', '17', '201807155b4af9a7b1856.jpg', '2');
INSERT INTO `goodsimg` VALUES ('71', '16', '201807155b4afb8702d13.jpg', '2');
INSERT INTO `goodsimg` VALUES ('76', '15', '201807155b4afcbedc8d2.jpg', '2');
INSERT INTO `goodsimg` VALUES ('78', '15', '201807155b4afd12553df.jpg', '2');
INSERT INTO `goodsimg` VALUES ('77', '15', '201807155b4afd03e16be.jpg', '2');
INSERT INTO `goodsimg` VALUES ('80', '13', '201807155b4afd7097be7.jpg', '1');
INSERT INTO `goodsimg` VALUES ('81', '13', '201807155b4afd7eee204.jpg', '2');
INSERT INTO `goodsimg` VALUES ('82', '13', '201807155b4afd8d5b1c4.jpg', '2');
INSERT INTO `goodsimg` VALUES ('84', '14', '201807155b4afdffbc693.jpg', '2');
INSERT INTO `goodsimg` VALUES ('85', '14', '201807155b4afe0b93128.jpg', '2');
INSERT INTO `goodsimg` VALUES ('86', '25', '201807155b4aff2e19657.jpg', '1');
INSERT INTO `goodsimg` VALUES ('87', '25', '201807155b4aff39cd00f.jpg', '2');
INSERT INTO `goodsimg` VALUES ('88', '25', '201807155b4aff436b7b4.jpg', '2');
INSERT INTO `goodsimg` VALUES ('89', '26', '201807155b4affbbe5868.jpg', '1');
INSERT INTO `goodsimg` VALUES ('90', '26', '201807155b4affcf851e9.jpg', '2');
INSERT INTO `goodsimg` VALUES ('91', '26', '201807155b4affda2263f.jpg', '2');
INSERT INTO `goodsimg` VALUES ('92', '27', '201807155b4b00b6800b4.jpg', '1');
INSERT INTO `goodsimg` VALUES ('93', '27', '201807155b4b00c13fbdb.jpg', '2');
INSERT INTO `goodsimg` VALUES ('94', '27', '201807155b4b00cc1db68.jpg', '2');
INSERT INTO `goodsimg` VALUES ('95', '28', '201807155b4b0120c045a.jpg', '1');
INSERT INTO `goodsimg` VALUES ('96', '28', '201807155b4b014da1e49.jpg', '2');
INSERT INTO `goodsimg` VALUES ('97', '28', '201807155b4b015924522.jpg', '2');
INSERT INTO `goodsimg` VALUES ('98', '29', '201807155b4b02812fc77.jpg', '1');
INSERT INTO `goodsimg` VALUES ('99', '29', '201807155b4b028ea2b69.jpg', '2');
INSERT INTO `goodsimg` VALUES ('100', '29', '201807155b4b029af3b23.jpg', '2');

-- ----------------------------
-- Table structure for ordergoods
-- ----------------------------
DROP TABLE IF EXISTS `ordergoods`;
CREATE TABLE `ordergoods` (
  `ordergid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品订单id',
  `orderid` int(11) NOT NULL COMMENT '订单ID',
  `goodsname` varchar(255) DEFAULT NULL,
  `goodsid` int(11) NOT NULL COMMENT '商品id',
  `price` decimal(11,2) NOT NULL COMMENT '单价',
  `cartnum` int(11) NOT NULL COMMENT '数量',
  PRIMARY KEY (`ordergid`)
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ordergoods
-- ----------------------------
INSERT INTO `ordergoods` VALUES ('144', '158', '          Apple iPad Pro平板电脑 9.7 英寸（32G WLAN版/A9X芯片/Retina显示屏/Multi-Touch技术MLMN2CH）深空灰色', '27', '4388.00', '2');
INSERT INTO `ordergoods` VALUES ('145', '159', '   360手机 N6 Pro 全网通 6GB+128GB 极夜黑色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '23', '1899.00', '1');
INSERT INTO `ordergoods` VALUES ('146', '160', '【音乐套装】360手机 N6 全网通 6GB+64GB 琉璃蓝色 移动联通电信4G手机 双卡双待', '22', '1399.00', '2');
INSERT INTO `ordergoods` VALUES ('147', '161', '360手机 N7 全网通 6GB+128GB 石墨黑色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '15', '1899.00', '2');
INSERT INTO `ordergoods` VALUES ('148', '162', ' 360手机 N6 全网通 4GB+64GB 燧石黑色 移动联通电信4G手机 双卡双待', '19', '1099.00', '1');
INSERT INTO `ordergoods` VALUES ('149', '163', '360手机 N7 全网通 6GB+128GB 石墨黑色 移动联通电信4G手机 双卡双待 全面屏 游戏手机', '15', '1899.00', '4');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `ordernum` varchar(24) NOT NULL COMMENT '订单编号',
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL COMMENT '收货人',
  `useraddress` varchar(255) NOT NULL COMMENT '收货地址',
  `usertel` char(11) NOT NULL COMMENT '手机号码',
  `totalprice` decimal(11,2) NOT NULL COMMENT '总价',
  `ordertime` datetime NOT NULL COMMENT '下单时间',
  `orderstatus` tinyint(1) DEFAULT '2' COMMENT '1-已发货  2-未发货  3-已收货 4-已完成',
  `orderispay` tinyint(1) DEFAULT '1' COMMENT '1-已支付  2-未支付',
  `ordercancel` tinyint(1) DEFAULT '2' COMMENT '1-取消  2-未取消',
  `orderisappraise` tinyint(1) DEFAULT '1' COMMENT '1待评价 2 已评价',
  `ordermessage` varchar(255) DEFAULT NULL COMMENT '买家留言',
  PRIMARY KEY (`orderid`),
  UNIQUE KEY `orderNum` (`ordernum`)
) ENGINE=MyISAM AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('158', '1531722868270399', '20', '张旭', '安徽合肥', '13215588205', '8776.00', '2018-07-16 02:34:28', '4', '1', '2', '1', null);
INSERT INTO `orders` VALUES ('159', '1531722868252848', '20', '张旭', '安徽合肥', '13215588205', '1899.00', '2018-07-16 02:34:28', '2', '1', '2', '1', null);
INSERT INTO `orders` VALUES ('160', '1531726230732557', '20', '小张', '安徽合肥', '13216688205', '2798.00', '2018-07-16 03:30:30', '4', '1', '2', '1', null);
INSERT INTO `orders` VALUES ('161', '1531726230780870', '20', '小张', '安徽合肥', '13216688205', '3798.00', '2018-07-16 03:30:30', '2', '1', '2', '1', null);
INSERT INTO `orders` VALUES ('162', '1531726230977511', '20', '小张', '安徽合肥', '13216688205', '1099.00', '2018-07-16 03:30:30', '2', '1', '2', '1', null);
INSERT INTO `orders` VALUES ('163', '1531735941770345', '20', '小张', '安徽合肥', '13216688205', '7596.00', '2018-07-16 06:12:21', '3', '1', '2', '1', null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `tel` char(11) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT '1' COMMENT '性别: 1-男  2-女',
  `age` tinyint(3) unsigned DEFAULT NULL,
  `pwd` char(32) NOT NULL,
  `icon` varchar(40) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '状态 1-激活 2-禁用',
  `regtime` date DEFAULT NULL,
  `part` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tel` (`tel`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('26', '冯俊', '17817886565', '未知', '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', '201807035b3ba3ca1ac56.jpg', '163163@163.com', '1', '2018-07-03', null);
INSERT INTO `user` VALUES ('1', '小王', '12345678902', '上海', '1', '22', 'd2fea0cf0b25c277b3d716b3eaf17546', null, 'xiaowang@qq.com', '2', '2018-06-20', '技术部');
INSERT INTO `user` VALUES ('20', '热心观众', '13215588205', '安徽合肥', '1', '22', 'd2fea0cf0b25c277b3d716b3eaf17546', '201807165b4c73ae97eaa.jpg', '1191584486@qq.com', '1', '2018-07-03', null);
INSERT INTO `user` VALUES ('21', '陈云龙', '13215588206', '合肥', '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', null, '163163@163.com', '1', '2018-07-03', null);
INSERT INTO `user` VALUES ('22', '谢世玉', '13215588208', '江苏', '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', null, '163163@163.com', '1', '2018-07-03', null);
INSERT INTO `user` VALUES ('23', '任金杰', '13215588203', '江苏', '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', null, '163163@163.com', '1', '2018-07-03', null);
INSERT INTO `user` VALUES ('24', '秦博豪', '13215588201', '山西', '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', null, '163163@163.com', '1', '2018-07-03', null);
INSERT INTO `user` VALUES ('27', '林龙校', '13215586201', '未知', '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', null, '163163@163.com', '1', '2018-07-03', null);
INSERT INTO `user` VALUES ('28', '小李', '15585555123', '北京', '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', '201807045b3c22b7de1aa.jpg', '1234@qq.com', '1', '2018-07-04', null);
INSERT INTO `user` VALUES ('31', '小王', '17817886555', '安徽合肥', '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', '201807145b49bd23dfa9c.jpg', 'cyl163@163.com', '1', '2018-07-08', null);
INSERT INTO `user` VALUES ('30', '周方平', '15552551236', '江西', '1', '20', 'd2fea0cf0b25c277b3d716b3eaf17546', '201807095b42d8671513a.jpg', '147258@163.com', '1', '2018-07-04', null);
INSERT INTO `user` VALUES ('32', '小张', '17817886123', '北京', '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', '201807095b42d5f9c110a.jpg', '825951697@qq.com', '1', '2018-07-08', null);
INSERT INTO `user` VALUES ('37', null, '13216688205', null, '1', null, 'd2fea0cf0b25c277b3d716b3eaf17546', null, null, '1', '2018-07-16', null);

-- ----------------------------
-- Table structure for useraddress
-- ----------------------------
DROP TABLE IF EXISTS `useraddress`;
CREATE TABLE `useraddress` (
  `addressid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL COMMENT '收货人',
  `usertel` char(11) NOT NULL COMMENT '手机号码',
  `useraddress` varchar(255) NOT NULL COMMENT '收货地址',
  `zipcode` char(6) DEFAULT NULL COMMENT '邮编',
  `isdefault` tinyint(1) DEFAULT '2' COMMENT '1-默认是 2-默认否',
  `createTime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`addressid`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of useraddress
-- ----------------------------
INSERT INTO `useraddress` VALUES ('52', '20', '张旭', '13215588205', '安徽合肥', '236400', '2', null);
INSERT INTO `useraddress` VALUES ('53', '20', '小张', '13216688205', '安徽合肥', '236400', '1', null);
