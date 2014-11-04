-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.32 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных yiitest
CREATE DATABASE IF NOT EXISTS `yiitest` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `yiitest`;


-- Дамп структуры для таблица yiitest.repo_likes
CREATE TABLE IF NOT EXISTS `repo_likes` (
  `ip` char(50) NOT NULL,
  `repo_id` int(11) NOT NULL,
  PRIMARY KEY (`ip`,`repo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yiitest.repo_likes: ~6 rows (приблизительно)
DELETE FROM `repo_likes`;
/*!40000 ALTER TABLE `repo_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `repo_likes` ENABLE KEYS */;


-- Дамп структуры для таблица yiitest.user_likes
CREATE TABLE IF NOT EXISTS `user_likes` (
  `ip` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `repo_id` int(11) NOT NULL,
  PRIMARY KEY (`ip`,`user_id`,`repo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yiitest.user_likes: ~6 rows (приблизительно)
DELETE FROM `user_likes`;
/*!40000 ALTER TABLE `user_likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_likes` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
