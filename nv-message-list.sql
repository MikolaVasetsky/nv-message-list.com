-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 02 2017 г., 00:14
-- Версия сервера: 5.7.18-0ubuntu0.17.04.1
-- Версия PHP: 7.1.5-1+deb.sury.org~zesty+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `nv-message-list`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(65000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(3, 111, 'gfdgdfgdfgdfgd 1', '2017-06-01 14:02:39', '2017-06-01 14:04:36'),
(4, 1, 'hhhhhhhhhhhhh', '2017-06-01 14:08:41', '2017-06-01 14:08:41'),
(5, 1, 'New message', '2017-06-01 14:09:36', '2017-06-01 14:09:36'),
(6, 1, 'hgfhghgdhdf', '2017-06-01 14:34:36', '2017-06-01 14:34:36'),
(7, 1, 'hvhghgddghgjdf', '2017-06-01 19:41:18', '2017-06-01 19:41:18'),
(8, 1, 'new message', '2017-06-01 19:41:28', '2017-06-01 19:41:28'),
(9, 1, 'hgdfghdfghd hdg d hgd jfg jfdg jdf', '2017-06-01 19:50:10', '2017-06-01 19:50:10'),
(10, 4, '54543543', '2017-06-01 20:15:09', '2017-06-01 20:15:09'),
(11, 4, 'hhhhhhhhhhhh', '2017-06-01 20:15:17', '2017-06-01 20:15:17'),
(12, 4, 'aaaaaaaaaaaaaaa', '2017-06-01 20:15:18', '2017-06-01 20:15:18'),
(13, 1, 'wwwwwwwwwwwwwww', '2017-06-01 20:15:20', '2017-06-01 20:15:20'),
(14, 4, 'fffffffffffffff', '2017-06-01 20:15:22', '2017-06-01 20:15:22'),
(15, 4, 'fff', '2017-06-01 20:21:23', '2017-06-01 20:21:23'),
(16, 4, 'jhgjhfhjfhjhfg', '2017-06-01 20:21:37', '2017-06-01 20:21:37'),
(17, 4, 'nbvnbvnb', '2017-06-01 20:21:42', '2017-06-01 20:21:42'),
(18, 4, 'mnbmbnm,bvn,bvn,vb', '2017-06-01 20:21:44', '2017-06-01 20:21:44'),
(19, 4, 'gsfgsdfgsdfgfsd', '2017-06-01 20:21:46', '2017-06-01 20:21:46'),
(20, 4, 'gdhgddf', '2017-06-01 20:35:39', '2017-06-01 20:35:39'),
(21, 4, 'hgfhdgd', '2017-06-01 20:47:25', '2017-06-01 20:47:25'),
(22, 4, 'hghfhf', '2017-06-01 21:13:43', '2017-06-01 21:13:43'),
(23, 4, 'nnnnnnnnnnn', '2017-06-01 21:13:56', '2017-06-01 21:13:56');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `facebook_id` varchar(255) NOT NULL,
  `facebook_token` varchar(255) NOT NULL,
  `facebook_email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `facebook_token`, `facebook_email`, `created_at`) VALUES
(1, '413413413413', 'gfdgdfgfdsgfdgdfs', 'dasdas@dsadas.da', '2017-06-01 21:06:39'),
(4, '158364688037209', 'EAABtxNIOZA0wBAI1gH5EIYKZBIDlVhqFBBNBCcnZBEbAoejBzGB27L63ZBOaZArI35JI6CrTgUj4BZAVdf6K9LXnbMZCt9EpIooEgcEV4MYj1bQySdo7ZCAo2qimZAE3yUATucZA1AQ5ok2yzE2t4t35kNnaehoLEZBotRKnGJJKMQN6AZDZD', 'nikolaj.vasetsky@gmail.com', '2017-06-01 20:47:22');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
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
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
