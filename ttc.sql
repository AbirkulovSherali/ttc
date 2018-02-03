-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 03 2015 г., 21:38
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `ttc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `moves`
--

CREATE TABLE IF NOT EXISTS `moves` (
`move_id` int(11) NOT NULL,
  `type_user` enum('user','computer') NOT NULL,
  `cell` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2898 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `count_move_user` tinyint(4) NOT NULL,
  `count_move_comp` tinyint(4) NOT NULL,
  `date` varchar(255) NOT NULL,
  `sec` int(11) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `count_move_user`, `count_move_comp`, `date`, `sec`, `img`) VALUES
(3, 'Sherali', 3, 3, '03-15-2015', 10, '1449172691.jpg'),
(5, 'marina', 4, 4, '03-15-2015', 12, '1449172956.jpg'),
(6, 'Sherali', 4, 4, '03-15-2015', 13, '1449174060.jpg'),
(8, 'Mikhail', 3, 3, '03-15-2015', 11, '1449174692.jpg'),
(9, 'Anna', 4, 4, '03-15-2015', 13, '1449174908.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `moves`
--
ALTER TABLE `moves`
 ADD PRIMARY KEY (`move_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `moves`
--
ALTER TABLE `moves`
MODIFY `move_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2898;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
