#
# SQL Export
# Created by Querious (201069)
# Created: 1 February 2020 08.46.36 GMT+7
# Encoding: Unicode (UTF-8)
#


SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


DROP TABLE IF EXISTS `oauth_users`;
DROP TABLE IF EXISTS `oauth_scopes`;
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
DROP TABLE IF EXISTS `oauth_jwt`;
DROP TABLE IF EXISTS `oauth_clients`;
DROP TABLE IF EXISTS `oauth_authorization_codes`;
DROP TABLE IF EXISTS `oauth_access_tokens`;


CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  `id_token` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`authorization_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) NOT NULL,
  `client_secret` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `grant_types` varchar(80) DEFAULT NULL,
  `scope` varchar(4000) DEFAULT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `oauth_scopes` (
  `scope` varchar(80) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `oauth_users` (
  `username` varchar(80) NOT NULL,
  `password` varchar(80) DEFAULT NULL,
  `first_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT NULL,
  `scope` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `oauth_access_tokens` WRITE;
ALTER TABLE `oauth_access_tokens` DISABLE KEYS;
INSERT INTO `oauth_access_tokens` (`access_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES 
	('15e9e1ad07a0f6e37a2cceb0b7cbaa7ea723a8a8','testclient',NULL,'2020-02-01 09:40:43',NULL),
	('e9ba03b709dc9500981f79e68dc7d91548534022','testclient',NULL,'2020-02-01 09:42:13',NULL);
ALTER TABLE `oauth_access_tokens` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `oauth_authorization_codes` WRITE;
ALTER TABLE `oauth_authorization_codes` DISABLE KEYS;
ALTER TABLE `oauth_authorization_codes` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `oauth_clients` WRITE;
ALTER TABLE `oauth_clients` DISABLE KEYS;
INSERT INTO `oauth_clients` (`client_id`, `client_secret`, `redirect_uri`, `grant_types`, `scope`, `user_id`) VALUES 
	('testclient','testsecret',NULL,NULL,NULL,NULL);
ALTER TABLE `oauth_clients` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `oauth_jwt` WRITE;
ALTER TABLE `oauth_jwt` DISABLE KEYS;
ALTER TABLE `oauth_jwt` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `oauth_refresh_tokens` WRITE;
ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS;
ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `oauth_scopes` WRITE;
ALTER TABLE `oauth_scopes` DISABLE KEYS;
ALTER TABLE `oauth_scopes` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `oauth_users` WRITE;
ALTER TABLE `oauth_users` DISABLE KEYS;
ALTER TABLE `oauth_users` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


