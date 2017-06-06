-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Июн 06 2017 г., 22:21
-- Версия сервера: 5.5.42
-- Версия PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `www_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sites`
--

CREATE TABLE `sites` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `type` varchar(20) NOT NULL,
  `author` varchar(20) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `design_raiting` float NOT NULL,
  `alias` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sites`
--

INSERT INTO `sites` (`id`, `name`, `description`, `type`, `author`, `date_create`, `design_raiting`, `alias`) VALUES
(1, 'site1', 'descr site1', 'landing', 'andryushkov vitaliy', '2011-03-18 13:00:00', 3.45, '/site1'),
(12, '12', 'asd', 'asd', 'asdadasd', '2017-06-06 09:12:00', 2, 'asdasd'),
(13, 'asd', 'asd', 'asd', 'asd', '2017-06-16 09:12:00', 12, 'asdasdasdasd'),
(15, 'asf', 'sdf', 'sdf', 'sdf', '0000-00-00 00:00:00', 12, ''),
(16, 'asf', 'sdf', 'sdf', 'sdf', '0000-00-00 00:00:00', 12, ''),
(17, 'asf', 'sdf', 'sdf', 'sdf', '0000-00-00 00:00:00', 12, ''),
(18, 'asf', 'sdf', 'sdf', 'sdf', '0000-00-00 00:00:00', 12, ''),
(19, 'asf', 'sdf', 'sdf', 'sdf', '0000-00-00 00:00:00', 12, ''),
(20, 'add new site', 'asdasd', '', '', '0000-00-00 00:00:00', 0, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
