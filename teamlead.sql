-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 11 2019 г., 20:57
-- Версия сервера: 5.6.38
-- Версия PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `teamlead`
--

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `tarif` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `adress` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `client`, `phone`, `tarif`, `date`, `adress`) VALUES
(1, 2, '+7 (111) 111-1111', 1, 1565647261, 'вапывапывап'),
(2, 2, '+7 (111) 111-1111', 3, 1565733661, 'вмвммм'),
(3, 3, '+7 (555) 555-5555', 4, 1566424861, 'вамвамвамвам'),
(4, 4, '+7 (666) 666-6666', 3, 1565733661, 'апо'),
(5, 5, '+7 (888) 888-8888', 4, 1565128861, 'adsfgdfg'),
(6, 6, '+7 (666) 666-6888', 3, 1566338461, 'ваапвап'),
(7, 6, '+7 (666) 666-6888', 3, 1566338461, 'ваапвап'),
(8, 7, '+7 (123) 654-5885', 1, 1565647261, 'ваиваипвапва'),
(9, 8, '+7 (222) 211-1111', 4, 1566424861, 'sdvsdcxc'),
(10, 9, '+7 (653) 328-4525', 3, 1565560861, '36520.'),
(11, 4, '+7 (666) 666-6666', 1, 1566856861, 'sdvv'),
(12, 10, '+7 (666) 666-3562', 1, 1566856861, 'sdvvvv'),
(13, 2, '+7 (111) 111-1111', 3, 1566338461, 'sdf'),
(14, 4, '+7 (666) 666-6666', 4, 1565560861, 'sdf'),
(15, 4, '+7 (666) 666-6666', 3, 1567116061, 'sdc'),
(16, 4, '+7 (666) 666-6666', 1, 1566424861, 'sdfsdf'),
(17, 2, '+7 (111) 111-1111', 3, 1566338461, 'sdf');

-- --------------------------------------------------------

--
-- Структура таблицы `tarif`
--

CREATE TABLE `tarif` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `days` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tarif`
--

INSERT INTO `tarif` (`id`, `name`, `price`, `days`) VALUES
(1, 'Тариф № 1', 800, '1,3,5'),
(3, 'Тариф № 2', 2000, '2,4'),
(4, 'Тариф № 3', 3000, '6,7');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `phone`) VALUES
(2, '+7 (111) 111-1111'),
(3, '+7 (555) 555-5555'),
(4, '+7 (666) 666-6666'),
(5, '+7 (888) 888-8888'),
(6, '+7 (666) 666-6888'),
(7, '+7 (123) 654-5885'),
(8, '+7 (222) 211-1111'),
(9, '+7 (653) 328-4525'),
(10, '+7 (666) 666-3562');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tarif`
--
ALTER TABLE `tarif`
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
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
