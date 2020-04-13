-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 13 2020 г., 11:55
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sdesc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `title_event` varchar(50) DEFAULT NULL,
  `event` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `checked_sms`
--

CREATE TABLE `checked_sms` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `sms_key` int(11) DEFAULT NULL,
  `key_time` bigint(15) UNSIGNED DEFAULT NULL,
  `user_ip` bigint(13) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `comm_id` int(11) NOT NULL,
  `ti_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comm_text` varchar(255) DEFAULT NULL,
  `comm_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_info`
--

CREATE TABLE `personal_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `f_name` varchar(200) DEFAULT NULL,
  `l_name` varchar(200) DEFAULT NULL,
  `m_name` varchar(200) DEFAULT NULL,
  `inn` bigint(13) UNSIGNED DEFAULT NULL,
  `mobile_phone` bigint(11) UNSIGNED DEFAULT NULL,
  `ip` bigint(11) UNSIGNED DEFAULT NULL,
  `tab_num` int(10) DEFAULT NULL,
  `company_post` varchar(200) DEFAULT NULL,
  `region` int(8) DEFAULT NULL,
  `date_password` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `personal_info`
--

INSERT INTO `personal_info` (`id`, `user_id`, `f_name`, `l_name`, `m_name`, `inn`, `mobile_phone`, `ip`, `tab_num`, `company_post`, `region`, `date_password`) VALUES
(1, 1, 'Денис', 'Рыков', 'Игорьевич', 951025351348, 7710515252, 168430280, 16435, '16', 5006, '2020-03-16 09:35:32'),
(2, 2, 'Мария', 'Рыкова', 'Александровна', 970723351689, 7764970723, 531172805, 16436, '16', 5006, '2020-03-16 09:35:32');

-- --------------------------------------------------------

--
-- Структура таблицы `pm`
--

CREATE TABLE `pm` (
  `id` bigint(20) NOT NULL,
  `id2` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`) VALUES
(1, 'Пользователь', NULL),
(2, 'Роль 2', NULL),
(3, 'Роль 3', NULL),
(4, 'Роль 4', NULL),
(5, 'Администратор', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

CREATE TABLE `tickets` (
  `ti_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '1',
  `text` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT 1,
  `priority` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  `ti_accept` int(11) DEFAULT NULL,
  `ti_date` date DEFAULT NULL,
  `ti_email` varchar(50) DEFAULT NULL,
  `ti_phone` varchar(16) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`ti_id`, `title`, `text`, `user_id`, `owner_id`, `priority`, `status`, `ti_accept`, `ti_date`, `ti_email`, `ti_phone`) VALUES
(1, 'test', '', 1, 1, 1, 1, NULL, '2020-04-13', 'drycov@gmail.com', '7710515252');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_timeline`
--

CREATE TABLE `ticket_timeline` (
  `tm_id` int(11) NOT NULL,
  `ti_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event` varchar(255) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `status`, `role`) VALUES
(1, 'MRykova', 'DRycov@gmail.com', '$2y$10$GOmPZX.VWURKk6vkKSWIL.QDLT7vcKOLwN4sk02Wa8eW1zJTYGIBC', 1, '5'),
(2, 'MRykova', 'MRykova@gmail.com', '$2y$10$GOmPZX.VWURKk6vkKSWIL.QDLT7vcKOLwN4sk02Wa8eW1zJTYGIBC', 1, '1');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `checked_sms`
--
ALTER TABLE `checked_sms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comm_id`);

--
-- Индексы таблицы `personal_info`
--
ALTER TABLE `personal_info`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ti_id`);

--
-- Индексы таблицы `ticket_timeline`
--
ALTER TABLE `ticket_timeline`
  ADD PRIMARY KEY (`tm_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `checked_sms`
--
ALTER TABLE `checked_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `personal_info`
--
ALTER TABLE `personal_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `ticket_timeline`
--
ALTER TABLE `ticket_timeline`
  MODIFY `tm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
