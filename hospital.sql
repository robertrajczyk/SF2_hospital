/*
Navicat MySQL Data Transfer

Source Server         : moje
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : hospital

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2015-03-19 23:58:54
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `equipments`
-- ----------------------------
DROP TABLE IF EXISTS `equipments`;
CREATE TABLE `equipments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `producer` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `typ` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `numbersr` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `numberinw` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `dateofreview` timestamp NULL DEFAULT NULL,
  `wardid` bigint(20) DEFAULT NULL,
  `inserteduser` bigint(20) DEFAULT NULL,
  `inserteddate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_eq_w` (`wardid`),
  CONSTRAINT `FK_eq_w` FOREIGN KEY (`wardid`) REFERENCES `wards` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipments
-- ----------------------------
INSERT INTO `equipments` VALUES ('2', 'bbb', 'nn', 'nb', '23423', '423423', '2012-01-19 18:18:00', '4', null, '2015-03-19 12:49:30');
INSERT INTO `equipments` VALUES ('3', 'vvv', 'bbbb', 'vb', '1232', '34234', '2011-01-19 19:17:00', '1', null, '2015-03-19 12:53:20');

-- ----------------------------
-- Table structure for `equipment_breakdowns`
-- ----------------------------
DROP TABLE IF EXISTS `equipment_breakdowns`;
CREATE TABLE `equipment_breakdowns` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_of_accident` timestamp NULL DEFAULT NULL,
  `description_damage` text CHARACTER SET utf8,
  `date_of_dispatch` timestamp NULL DEFAULT NULL,
  `data_recovery` timestamp NULL DEFAULT NULL,
  `service_data` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `warranty` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `costs` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `comments` text,
  `equipment` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_e_b` (`equipment`),
  CONSTRAINT `FK_e_b` FOREIGN KEY (`equipment`) REFERENCES `equipments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipment_breakdowns
-- ----------------------------
INSERT INTO `equipment_breakdowns` VALUES ('2', '2014-03-02 00:00:00', 'asdasd', '2012-01-02 00:01:00', null, 'asd', 'asda', '100zł', 'asd', '2');
INSERT INTO `equipment_breakdowns` VALUES ('3', '2011-02-01 00:01:00', 'ssss', '2010-02-18 18:17:00', null, 'as', 'as', 'asa', 'sas', '3');

-- ----------------------------
-- Table structure for `equipment_reviews`
-- ----------------------------
DROP TABLE IF EXISTS `equipment_reviews`;
CREATE TABLE `equipment_reviews` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(255) CHARACTER SET utf8 NOT NULL,
  `reviewdate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `description` text CHARACTER SET utf8,
  `equipment` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_eq_rew` (`equipment`),
  CONSTRAINT `FK_eq_rew` FOREIGN KEY (`equipment`) REFERENCES `equipments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of equipment_reviews
-- ----------------------------
INSERT INTO `equipment_reviews` VALUES ('3', 'ddd2', '2010-03-01 00:00:00', null, '2');
INSERT INTO `equipment_reviews` VALUES ('4', 'ccc', '2010-01-01 00:00:00', 'ccc', '2');

-- ----------------------------
-- Table structure for `payment_details`
-- ----------------------------
DROP TABLE IF EXISTS `payment_details`;
CREATE TABLE `payment_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of payment_details
-- ----------------------------
INSERT INTO `payment_details` VALUES ('140', '{\"PAYMENTREQUEST_0_CURRENCYCODE\":\"GBP\",\"L_PAYMENTREQUEST_0_AMT0\":80,\"L_PAYMENTREQUEST_0_QTY0\":1,\"L_PAYMENTREQUEST_0_NAME0\":\"Happy Tree. Tree Hello\",\"L_PAYMENTREQUEST_0_DESC0\":\"Hello\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":5,\"PAYMENTREQUEST_0_ITEMAMT\":80,\"PAYMENTREQUEST_0_AMT\":85,\"RETURNURL\":\"http:\\/\\/localhost\\/app_dev.php\\/payment\\/capture\\/Hai6-d1KuxBa0C6r7-Kx7khbr0HXBMCV95LVNlQ-IV0\",\"CANCELURL\":\"http:\\/\\/localhost\\/app_dev.php\\/payment\\/capture\\/Hai6-d1KuxBa0C6r7-Kx7khbr0HXBMCV95LVNlQ-IV0\",\"INVNUM\":140}');
INSERT INTO `payment_details` VALUES ('141', '{\"PAYMENTREQUEST_0_CURRENCYCODE\":\"GBP\",\"L_PAYMENTREQUEST_0_AMT0\":\"80.00\",\"L_PAYMENTREQUEST_0_QTY0\":\"1\",\"L_PAYMENTREQUEST_0_NAME0\":\"Happy Tree. Tree Hello\",\"L_PAYMENTREQUEST_0_DESC0\":\"Hello\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":\"5.00\",\"PAYMENTREQUEST_0_ITEMAMT\":\"80.00\",\"PAYMENTREQUEST_0_AMT\":\"85.00\",\"RETURNURL\":\"http:\\/\\/localhost\\/app_dev.php\\/payment\\/capture\\/ks60HayU8DdTd9RBruPgVwiTGWcRZQMm01u6OhooZlM\",\"CANCELURL\":\"http:\\/\\/localhost\\/app_dev.php\\/payment\\/capture\\/ks60HayU8DdTd9RBruPgVwiTGWcRZQMm01u6OhooZlM\",\"INVNUM\":141,\"PAYMENTREQUEST_0_PAYMENTACTION\":\"Sale\",\"TOKEN\":\"EC-57A33711J7179040B\",\"TIMESTAMP\":\"2014-10-07T08:32:24Z\",\"CORRELATIONID\":\"40bbd1ee64634\",\"ACK\":\"Success\",\"VERSION\":\"65.1\",\"BUILD\":\"13243702\",\"BILLINGAGREEMENTACCEPTEDSTATUS\":\"0\",\"CHECKOUTSTATUS\":\"PaymentActionNotInitiated\",\"CURRENCYCODE\":\"GBP\",\"AMT\":\"85.00\",\"ITEMAMT\":\"80.00\",\"SHIPPINGAMT\":\"5.00\",\"HANDLINGAMT\":\"0.00\",\"TAXAMT\":\"0.00\",\"INSURANCEAMT\":\"0.00\",\"SHIPDISCAMT\":\"0.00\",\"L_NAME0\":\"Happy Tree. Tree Hello\",\"L_QTY0\":\"1\",\"L_TAXAMT0\":\"0.00\",\"L_AMT0\":\"80.00\",\"L_DESC0\":\"Hello\",\"L_ITEMWEIGHTVALUE0\":\"   0.00000\",\"L_ITEMLENGTHVALUE0\":\"   0.00000\",\"L_ITEMWIDTHVALUE0\":\"   0.00000\",\"L_ITEMHEIGHTVALUE0\":\"   0.00000\",\"PAYMENTREQUEST_0_HANDLINGAMT\":\"0.00\",\"PAYMENTREQUEST_0_TAXAMT\":\"0.00\",\"PAYMENTREQUEST_0_INSURANCEAMT\":\"0.00\",\"PAYMENTREQUEST_0_SHIPDISCAMT\":\"0.00\",\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\":\"false\",\"L_PAYMENTREQUEST_0_TAXAMT0\":\"0.00\",\"L_PAYMENTREQUEST_0_ITEMWEIGHTVALUE0\":\"   0.00000\",\"L_PAYMENTREQUEST_0_ITEMLENGTHVALUE0\":\"   0.00000\",\"L_PAYMENTREQUEST_0_ITEMWIDTHVALUE0\":\"   0.00000\",\"L_PAYMENTREQUEST_0_ITEMHEIGHTVALUE0\":\"   0.00000\",\"PAYMENTREQUESTINFO_0_ERRORCODE\":\"0\"}');
INSERT INTO `payment_details` VALUES ('142', '{\"PAYMENTREQUEST_0_CURRENCYCODE\":\"GBP\",\"L_PAYMENTREQUEST_0_AMT0\":\"80.00\",\"L_PAYMENTREQUEST_0_QTY0\":\"1\",\"L_PAYMENTREQUEST_0_NAME0\":\"Happy Tree. Tree kicia\",\"L_PAYMENTREQUEST_0_DESC0\":\"kicia\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":\"5.00\",\"PAYMENTREQUEST_0_ITEMAMT\":\"80.00\",\"PAYMENTREQUEST_0_AMT\":\"85.00\",\"RETURNURL\":\"http:\\/\\/localhost\\/payment\\/capture\\/m4QH10XDmaIkcNVaqdfXqD0hRJR9Z-KnmGvpbd0m_4k\",\"CANCELURL\":\"http:\\/\\/localhost\\/payment\\/capture\\/m4QH10XDmaIkcNVaqdfXqD0hRJR9Z-KnmGvpbd0m_4k\",\"INVNUM\":142,\"PAYMENTREQUEST_0_PAYMENTACTION\":\"Sale\",\"TOKEN\":\"EC-9CA32861SX401871J\",\"TIMESTAMP\":\"2014-10-13T19:20:07Z\",\"CORRELATIONID\":\"567063abe847f\",\"ACK\":\"Success\",\"VERSION\":\"65.1\",\"BUILD\":\"13298800\",\"BILLINGAGREEMENTACCEPTEDSTATUS\":\"0\",\"CHECKOUTSTATUS\":\"PaymentActionNotInitiated\",\"CURRENCYCODE\":\"GBP\",\"AMT\":\"85.00\",\"ITEMAMT\":\"80.00\",\"SHIPPINGAMT\":\"5.00\",\"HANDLINGAMT\":\"0.00\",\"TAXAMT\":\"0.00\",\"INSURANCEAMT\":\"0.00\",\"SHIPDISCAMT\":\"0.00\",\"L_NAME0\":\"Happy Tree. Tree kicia\",\"L_QTY0\":\"1\",\"L_TAXAMT0\":\"0.00\",\"L_AMT0\":\"80.00\",\"L_DESC0\":\"kicia\",\"L_ITEMWEIGHTVALUE0\":\"   0.00000\",\"L_ITEMLENGTHVALUE0\":\"   0.00000\",\"L_ITEMWIDTHVALUE0\":\"   0.00000\",\"L_ITEMHEIGHTVALUE0\":\"   0.00000\",\"PAYMENTREQUEST_0_HANDLINGAMT\":\"0.00\",\"PAYMENTREQUEST_0_TAXAMT\":\"0.00\",\"PAYMENTREQUEST_0_INSURANCEAMT\":\"0.00\",\"PAYMENTREQUEST_0_SHIPDISCAMT\":\"0.00\",\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\":\"false\",\"L_PAYMENTREQUEST_0_TAXAMT0\":\"0.00\",\"L_PAYMENTREQUEST_0_ITEMWEIGHTVALUE0\":\"   0.00000\",\"L_PAYMENTREQUEST_0_ITEMLENGTHVALUE0\":\"   0.00000\",\"L_PAYMENTREQUEST_0_ITEMWIDTHVALUE0\":\"   0.00000\",\"L_PAYMENTREQUEST_0_ITEMHEIGHTVALUE0\":\"   0.00000\",\"PAYMENTREQUESTINFO_0_ERRORCODE\":\"0\"}');
INSERT INTO `payment_details` VALUES ('143', '{\"PAYMENTREQUEST_0_CURRENCYCODE\":\"GBP\",\"L_PAYMENTREQUEST_0_AMT0\":82,\"L_PAYMENTREQUEST_0_QTY0\":1,\"L_PAYMENTREQUEST_0_NAME0\":\"Happy Tree. Balloons 123456\",\"L_PAYMENTREQUEST_0_DESC0\":\"123456\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":5,\"PAYMENTREQUEST_0_ITEMAMT\":82,\"PAYMENTREQUEST_0_AMT\":87,\"RETURNURL\":\"http:\\/\\/localhost\\/payment\\/capture\\/0tn2_1HZ8X6Xmza4f3Q_CaVMwsSDlKRytzwU3k8klhA\",\"CANCELURL\":\"http:\\/\\/localhost\\/payment\\/capture\\/0tn2_1HZ8X6Xmza4f3Q_CaVMwsSDlKRytzwU3k8klhA\",\"INVNUM\":143}');
INSERT INTO `payment_details` VALUES ('144', '{\"PAYMENTREQUEST_0_CURRENCYCODE\":\"GBP\",\"L_PAYMENTREQUEST_0_AMT0\":\"82.00\",\"L_PAYMENTREQUEST_0_QTY0\":\"1\",\"L_PAYMENTREQUEST_0_NAME0\":\"Happy Tree. Balloons 123456\",\"L_PAYMENTREQUEST_0_DESC0\":\"123456\",\"PAYMENTREQUEST_0_SHIPPINGAMT\":\"5.00\",\"PAYMENTREQUEST_0_ITEMAMT\":\"82.00\",\"PAYMENTREQUEST_0_AMT\":\"87.00\",\"RETURNURL\":\"http:\\/\\/localhost\\/payment\\/capture\\/AQICtNVScp430Qc-uQPIijUeao9ha16A4hDpHBoXwR0\",\"CANCELURL\":\"http:\\/\\/localhost\\/payment\\/capture\\/AQICtNVScp430Qc-uQPIijUeao9ha16A4hDpHBoXwR0\",\"INVNUM\":144,\"PAYMENTREQUEST_0_PAYMENTACTION\":\"Sale\",\"TOKEN\":\"EC-50X2503120466324J\",\"TIMESTAMP\":\"2014-10-28T20:15:27Z\",\"CORRELATIONID\":\"90b1cdd689935\",\"ACK\":\"Success\",\"VERSION\":\"65.1\",\"BUILD\":\"13517841\",\"BILLINGAGREEMENTACCEPTEDSTATUS\":\"0\",\"CHECKOUTSTATUS\":\"PaymentActionCompleted\",\"EMAIL\":\"robertrajczyk-facilitator@gmail.com\",\"PAYERID\":\"E8LKEUKC5N8V4\",\"PAYERSTATUS\":\"verified\",\"BUSINESS\":\"facilitator account\'s Test Store\",\"FIRSTNAME\":\"facilitator\",\"LASTNAME\":\"account\",\"COUNTRYCODE\":\"US\",\"SHIPTONAME\":\"facilitator account\'s Test Store\",\"SHIPTOSTREET\":\"1 Main St\",\"SHIPTOCITY\":\"San Jose\",\"SHIPTOSTATE\":\"CA\",\"SHIPTOZIP\":\"95131\",\"SHIPTOCOUNTRYCODE\":\"US\",\"SHIPTOCOUNTRYNAME\":\"United States\",\"ADDRESSSTATUS\":\"Confirmed\",\"CURRENCYCODE\":\"GBP\",\"AMT\":\"87.00\",\"ITEMAMT\":\"82.00\",\"SHIPPINGAMT\":\"5.00\",\"HANDLINGAMT\":\"0.00\",\"TAXAMT\":\"0.00\",\"INSURANCEAMT\":\"0.00\",\"SHIPDISCAMT\":\"0.00\",\"L_NAME0\":\"Happy Tree. Balloons 123456\",\"L_QTY0\":\"1\",\"L_TAXAMT0\":\"0.00\",\"L_AMT0\":\"82.00\",\"L_DESC0\":\"123456\",\"L_ITEMWEIGHTVALUE0\":\"   0.00000\",\"L_ITEMLENGTHVALUE0\":\"   0.00000\",\"L_ITEMWIDTHVALUE0\":\"   0.00000\",\"L_ITEMHEIGHTVALUE0\":\"   0.00000\",\"PAYMENTREQUEST_0_HANDLINGAMT\":\"0.00\",\"PAYMENTREQUEST_0_TAXAMT\":\"0.00\",\"PAYMENTREQUEST_0_INSURANCEAMT\":\"0.00\",\"PAYMENTREQUEST_0_SHIPDISCAMT\":\"0.00\",\"PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED\":\"false\",\"PAYMENTREQUEST_0_SHIPTONAME\":\"facilitator account\'s Test Store\",\"PAYMENTREQUEST_0_SHIPTOSTREET\":\"1 Main St\",\"PAYMENTREQUEST_0_SHIPTOCITY\":\"San Jose\",\"PAYMENTREQUEST_0_SHIPTOSTATE\":\"CA\",\"PAYMENTREQUEST_0_SHIPTOZIP\":\"95131\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE\":\"US\",\"PAYMENTREQUEST_0_SHIPTOCOUNTRYNAME\":\"United States\",\"PAYMENTREQUEST_0_ADDRESSSTATUS\":\"Confirmed\",\"L_PAYMENTREQUEST_0_TAXAMT0\":\"0.00\",\"L_PAYMENTREQUEST_0_ITEMWEIGHTVALUE0\":\"   0.00000\",\"L_PAYMENTREQUEST_0_ITEMLENGTHVALUE0\":\"   0.00000\",\"L_PAYMENTREQUEST_0_ITEMWIDTHVALUE0\":\"   0.00000\",\"L_PAYMENTREQUEST_0_ITEMHEIGHTVALUE0\":\"   0.00000\",\"PAYMENTREQUESTINFO_0_ERRORCODE\":\"0\",\"SUCCESSPAGEREDIRECTREQUESTED\":\"false\",\"INSURANCEOPTIONSELECTED\":\"false\",\"SHIPPINGOPTIONISDEFAULT\":\"false\",\"PAYMENTINFO_0_TRANSACTIONID\":\"1EE45399DV627584M\",\"PAYMENTINFO_0_TRANSACTIONTYPE\":\"cart\",\"PAYMENTINFO_0_PAYMENTTYPE\":\"instant\",\"PAYMENTINFO_0_ORDERTIME\":\"2014-10-28T20:15:25Z\",\"PAYMENTINFO_0_AMT\":\"87.00\",\"PAYMENTINFO_0_TAXAMT\":\"0.00\",\"PAYMENTINFO_0_CURRENCYCODE\":\"GBP\",\"PAYMENTINFO_0_PAYMENTSTATUS\":\"Pending\",\"PAYMENTINFO_0_PENDINGREASON\":\"multicurrency\",\"PAYMENTINFO_0_REASONCODE\":\"None\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITY\":\"Eligible\",\"PAYMENTINFO_0_PROTECTIONELIGIBILITYTYPE\":\"ItemNotReceivedEligible,UnauthorizedPaymentEligible\",\"PAYMENTINFO_0_ERRORCODE\":\"0\",\"PAYMENTINFO_0_ACK\":\"Success\",\"PAYMENTREQUEST_0_TRANSACTIONID\":\"1EE45399DV627584M\",\"PAYMENTREQUESTINFO_0_TRANSACTIONID\":\"1EE45399DV627584M\",\"PAYMENTREQUEST_0_TRANSACTIONTYPE\":\"cart\",\"PAYMENTREQUEST_0_PAYMENTTYPE\":\"instant\",\"PAYMENTREQUEST_0_ORDERTIME\":\"2014-10-28T20:15:25Z\",\"PAYMENTREQUEST_0_PAYMENTSTATUS\":\"Pending\",\"PAYMENTREQUEST_0_PENDINGREASON\":\"multicurrency\",\"PAYMENTREQUEST_0_REASONCODE\":\"None\"}');

-- ----------------------------
-- Table structure for `payment_token`
-- ----------------------------
DROP TABLE IF EXISTS `payment_token`;
CREATE TABLE `payment_token` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `details` text,
  `after_url` varchar(255) DEFAULT NULL,
  `target_url` varchar(255) DEFAULT NULL,
  `payment_name` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of payment_token
-- ----------------------------
INSERT INTO `payment_token` VALUES ('219', 'C:30:\"Payum\\Core\\Model\\Identificator\":66:{a:2:{i:0;i:140;i:1;s:38:\"Acme\\HappyBundle\\Entity\\PaymentDetails\";}}', null, 'http://localhost/app_dev.php/account/acme_payment_done?payum_token=7dJLzmWFKh3MLFRHmy2z2eAfRYeAsXhNN50Sw0IfI2k', 'paypal_express_checkout_and_doctrine_orm', '7dJLzmWFKh3MLFRHmy2z2eAfRYeAsXhNN50Sw0IfI2k');
INSERT INTO `payment_token` VALUES ('220', 'C:30:\"Payum\\Core\\Model\\Identificator\":66:{a:2:{i:0;i:140;i:1;s:38:\"Acme\\HappyBundle\\Entity\\PaymentDetails\";}}', 'http://localhost/app_dev.php/account/acme_payment_done?payum_token=7dJLzmWFKh3MLFRHmy2z2eAfRYeAsXhNN50Sw0IfI2k', 'http://localhost/app_dev.php/payment/capture/Hai6-d1KuxBa0C6r7-Kx7khbr0HXBMCV95LVNlQ-IV0', 'paypal_express_checkout_and_doctrine_orm', 'Hai6-d1KuxBa0C6r7-Kx7khbr0HXBMCV95LVNlQ-IV0');
INSERT INTO `payment_token` VALUES ('221', 'C:30:\"Payum\\Core\\Model\\Identificator\":66:{a:2:{i:0;i:141;i:1;s:38:\"Acme\\HappyBundle\\Entity\\PaymentDetails\";}}', null, 'http://localhost/app_dev.php/account/acme_payment_done?payum_token=Ifo2DdM6v-gN5bCeDRs8K1xyKwP8LDkOFyXSoV2M3Gs', 'paypal_express_checkout_and_doctrine_orm', 'Ifo2DdM6v-gN5bCeDRs8K1xyKwP8LDkOFyXSoV2M3Gs');
INSERT INTO `payment_token` VALUES ('222', 'C:30:\"Payum\\Core\\Model\\Identificator\":66:{a:2:{i:0;i:142;i:1;s:38:\"Acme\\HappyBundle\\Entity\\PaymentDetails\";}}', null, 'http://localhost/de/account/acme_payment_done?payum_token=mBrTSyiIEx8d4QCiFLuoyyGH3sdOKnur68gB7dEVZD0', 'paypal_express_checkout_and_doctrine_orm', 'mBrTSyiIEx8d4QCiFLuoyyGH3sdOKnur68gB7dEVZD0');
INSERT INTO `payment_token` VALUES ('223', 'C:30:\"Payum\\Core\\Model\\Identificator\":66:{a:2:{i:0;i:143;i:1;s:38:\"Acme\\HappyBundle\\Entity\\PaymentDetails\";}}', null, 'http://localhost/en/account/acme_payment_done?payum_token=-CMoKp5vUBVGvR81h-gl7yPrAK0_N7fCXNfyjPB67NA', 'paypal_express_checkout_and_doctrine_orm', '-CMoKp5vUBVGvR81h-gl7yPrAK0_N7fCXNfyjPB67NA');
INSERT INTO `payment_token` VALUES ('224', 'C:30:\"Payum\\Core\\Model\\Identificator\":66:{a:2:{i:0;i:143;i:1;s:38:\"Acme\\HappyBundle\\Entity\\PaymentDetails\";}}', 'http://localhost/en/account/acme_payment_done?payum_token=-CMoKp5vUBVGvR81h-gl7yPrAK0_N7fCXNfyjPB67NA', 'http://localhost/payment/capture/0tn2_1HZ8X6Xmza4f3Q_CaVMwsSDlKRytzwU3k8klhA', 'paypal_express_checkout_and_doctrine_orm', '0tn2_1HZ8X6Xmza4f3Q_CaVMwsSDlKRytzwU3k8klhA');
INSERT INTO `payment_token` VALUES ('225', 'C:30:\"Payum\\Core\\Model\\Identificator\":66:{a:2:{i:0;i:144;i:1;s:38:\"Acme\\HappyBundle\\Entity\\PaymentDetails\";}}', null, 'http://localhost/en/account/acme_payment_done?payum_token=dLC6RhjTB-OgDG2crd0iwEMQ-xIEoPANmEDa8nMlSq4', 'paypal_express_checkout_and_doctrine_orm', 'dLC6RhjTB-OgDG2crd0iwEMQ-xIEoPANmEDa8nMlSq4');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `roles` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `salt` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pass` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lang` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `active` int(11) DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Robert2', '0pF0Li/Bz1N58HrLmGBQJUOhqfvPUY2WXVBIkZ6C/X/XawzH2/i7ybGlQeLVvNl8yzOZjRUnygvXjRnwo+BD1w==', 'ROLE_ADMIN', 'bbb09343f010e0a023aaeaccfa031b63', 'Robert2', null, 'robert.rajczyk@polcode.pl', null, '1', null);
INSERT INTO `users` VALUES ('2', 'user', 'okR4l7FpD3rOMAZjnyN1EORQvjH+JD2OobTQgIGtUmSDhuP7DprMMRiZIt6bTkAE5ESioC6DT7tI1K+clt+fqA==', 'ROLE_USER', '1504d2b516d78a38bdd06a003f3bcb3f', 'userpass', null, null, null, '1', null);
INSERT INTO `users` VALUES ('24', 'xxx', '7Imj8iHG6zNs6SuIEDGA4+QBE2S+q+6QZHp0+oPzaMoSzG3ZhE1uJAv8xnj3WVrwZs8jZhu5X38ylg1cQGy2rg==', 'ROLE_USER', 'fd036ebcc13a9c238a8bf5939c40b829', 'xxx', null, null, null, '1', null);

-- ----------------------------
-- Table structure for `users_to_wards`
-- ----------------------------
DROP TABLE IF EXISTS `users_to_wards`;
CREATE TABLE `users_to_wards` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) NOT NULL,
  `wardid` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_u_w` (`userid`),
  KEY `FK_u_w2` (`wardid`),
  CONSTRAINT `FK_u_w` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  CONSTRAINT `FK_u_w2` FOREIGN KEY (`wardid`) REFERENCES `wards` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users_to_wards
-- ----------------------------
INSERT INTO `users_to_wards` VALUES ('2', '1', '2');
INSERT INTO `users_to_wards` VALUES ('6', '1', '4');
INSERT INTO `users_to_wards` VALUES ('7', '1', '1');
INSERT INTO `users_to_wards` VALUES ('8', '2', '4');
INSERT INTO `users_to_wards` VALUES ('9', '24', '1');
INSERT INTO `users_to_wards` VALUES ('10', '24', '2');

-- ----------------------------
-- Table structure for `wards`
-- ----------------------------
DROP TABLE IF EXISTS `wards`;
CREATE TABLE `wards` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `wardname` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wards
-- ----------------------------
INSERT INTO `wards` VALUES ('1', 'Ogólny');
INSERT INTO `wards` VALUES ('2', 'Wewnętrzny');
INSERT INTO `wards` VALUES ('4', 'Pediatria');
