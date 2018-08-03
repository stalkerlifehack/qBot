sxSET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `functions_first` (
  `function` int(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `functions_first` (`function`, `time`) VALUES ('0', '1');
INSERT INTO `functions_first` (`function`, `time`) VALUES ('1', '432');
INSERT INTO `functions_first` (`function`, `time`) VALUES ('2', '654');
INSERT INTO `functions_first` (`function`, `time`) VALUES ('3', '44444');
INSERT INTO `functions_first` (`function`, `time`) VALUES ('4', '9999');
INSERT INTO `functions_first` (`function`, `time`) VALUES ('5', '9999');
INSERT INTO `functions_first` (`function`, `time`) VALUES ('6', '9999');
INSERT INTO `functions_first` (`function`, `time`) VALUES ('7', '9999');
INSERT INTO `functions_first` (`function`, `time`) VALUES ('8', '9999');
INSERT INTO `functions_first` (`function`, `time`) VALUES ('9', '9999');



CREATE TABLE IF NOT EXISTS `functions_third` (
  `function` int(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `functions_third` (`function`, `time`) VALUES ('0', '1');
INSERT INTO `functions_third` (`function`, `time`) VALUES ('1', '1');
INSERT INTO `functions_third` (`function`, `time`) VALUES ('2', '1');
INSERT INTO `functions_third` (`function`, `time`) VALUES ('3', '1');
INSERT INTO `functions_third` (`function`, `time`) VALUES ('4', '1');
INSERT INTO `functions_third` (`function`, `time`) VALUES ('5', '1');
INSERT INTO `functions_third` (`function`, `time`) VALUES ('6', '1');
INSERT INTO `functions_third` (`function`, `time`) VALUES ('7', '1');
INSERT INTO `functions_third` (`function`, `time`) VALUES ('8', '1');
INSERT INTO `functions_third` (`function`, `time`) VALUES ('9', '1');









CREATE TABLE IF NOT EXISTS `functions_second` (
  `function` int(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `functions_second` (`function`, `time`) VALUES ('0', '1');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('1', '432');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('2', '654');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('3', '44444');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('4', '9999');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('5', '1');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('6', '1');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('7', '1');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('8', '1');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('9', '1');
INSERT INTO `functions_second` (`function`, `time`) VALUES ('10', '1');

CREATE TABLE IF NOT EXISTS `functions_fourth` (
  `function` int(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('0', '1');
INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('1', '432');
INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('2', '654');
INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('3', '44444');
INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('4', '9999');
INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('5', '9999');
INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('6', '9999');
INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('7', '9999');
INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('8', '9999');
INSERT INTO `functions_fourth` (`function`, `time`) VALUES ('9', '9999');

CREATE TABLE IF NOT EXISTS `clientConnectedTime` (
  `databaseid` int(255) NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `totalVisitors` (
  `serverRunning` int(255) NOT NULL,
  `visitors` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `clanGroupClients` (
  `clientId` int(255) NOT NULL,
  `databaseId` int(255) NOT NULL,
  `channelId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `registerChannel` (
  `clientId` int(255) NOT NULL,
  `databaseId` int(255) NOT NULL,
  `time` int(255) NOT NULL,
  `cache` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `topAfkTime` (
  `databaseId` int(255) NOT NULL,
  `afkTime` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `topTimeSpent` (
  `databaseId` int(255) NOT NULL,
  `totalTime` int(255) NOT NULL,
  `lastTime` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `createPremiumChannels` (
  `index` int(255) NOT NULL,
  `channelId` int(255) NOT NULL,
  `groupId` int(255) NOT NULL,
  `databaseId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `clanGroup` (
  `channelId` int(255) NOT NULL,
  `groupId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `groupUserList` (
  `channelId` int(255) NOT NULL,
  `groupId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `groupOnline` (
  `channelId` int(255) NOT NULL,
  `groupId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `lastClientChannel` (
  `channelId` int(255) NOT NULL,
  `clientId` int(255) NOT NULL,
  `databaseId` int(255) NOT NULL,
  `date` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `clientLastConnected` (
  `lastConnected` int(255) NOT NULL,
  `awayTime` int(255) NOT NULL,
  `onlineTime` int(255) NOT NULL,
  `databaseId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `getPrivateChannel` (
  `channelId` int(255) NOT NULL,
  `dataBaseId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `afkGroup` (
  `dataBaseId` int(255) NOT NULL,
  `groupId` int(255) NOT NULL,
  `afkTime` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `topSpentAfk` (
  `dataBaseId` int(255) NOT NULL,
  `totalAfkTime` int(255) NOT NULL,
  `lastAfkTime` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `adminStatistics` (
  `adminId` int(255) NOT NULL,
  `groupAdded` int(255) NOT NULL,
  `clientWhereAdded` int(255) NOT NULL,
  `actionTime` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `recordOnline` (
  `record` int(255) NOT NULL,
  `date` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `recordOnline` (`record`, `date`) VALUES ('0', '0');

CREATE TABLE IF NOT EXISTS `clientLevels` (
  `databaseId` int(255) NOT NULL,
  `actualLevel` int(255) NOT NULL,
  `groupId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `newUserToday` (
  `databaseId` int(255) NOT NULL,
  `actualLevel` int(255) NOT NULL,
  `groupId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `advertMessage` (
  `msg` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `advertMessage` (`msg`) VALUES ('0');
