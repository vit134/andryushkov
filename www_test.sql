-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Июн 08 2017 г., 19:49
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

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
  `usability_raiting` float NOT NULL,
  `creativity_raiting` float NOT NULL,
  `speed_raiting` float NOT NULL,
  `alias` varchar(30) NOT NULL,
  `small_img_file` varchar(100) NOT NULL,
  `big_img_file` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sites`
--

INSERT INTO `sites` (`id`, `name`, `description`, `type`, `author`, `date_create`, `design_raiting`, `usability_raiting`, `creativity_raiting`, `speed_raiting`, `alias`, `small_img_file`, `big_img_file`) VALUES
(75, 'мой первый сайт', 'описание для первого сайта', 'landing', 'Виталий Андрюшков', '2017-06-08 14:24:56', 5, 4, 1, 8, 'moj_pervyj_sajt', '', ''),
(76, 'hello', '', 'landing', 'Виталий Андрюшков', '2017-06-08 16:43:30', 0, 0, 0, 0, 'hello', '../../uploads/hello/Chrysanthemum.jpg', '../../uploads/hello/Hydrangeas.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `site_types`
--

CREATE TABLE `site_types` (
  `id` int(10) NOT NULL,
  `type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `site_types`
--

INSERT INTO `site_types` (`id`, `type_name`) VALUES
(1, 'landing'),
(2, 'feetcher'),
(3, 'business card'),
(4, 'one page'),
(5, 'shop');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`) VALUES
(1, 'Виталий', 'Андрюшков'),
(2, 'Ксения ', 'Королева'),
(3, 'Игорь', 'Андрюшков'),
(4, 'Дмитрий ', 'Королев');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `site_types`
--
ALTER TABLE `site_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT для таблицы `site_types`
--
ALTER TABLE `site_types`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
