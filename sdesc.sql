-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 03 2020 г., 12:38
-- Версия сервера: 5.7.26
-- Версия PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `title_event` varchar(50) DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_to` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `subject` varchar(100) CHARACTER SET latin1 NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `respond` int(11) NOT NULL DEFAULT '0',
  `sender_open` enum('y','n') CHARACTER SET latin1 NOT NULL DEFAULT 'y',
  `receiver_open` enum('y','n') CHARACTER SET latin1 NOT NULL DEFAULT 'n',
  `sender_delete` enum('y','n') CHARACTER SET latin1 NOT NULL DEFAULT 'n',
  `receiver_delete` enum('y','n') CHARACTER SET latin1 NOT NULL DEFAULT 'n',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_info`
--

DROP TABLE IF EXISTS `personal_info`;
CREATE TABLE IF NOT EXISTS `personal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `date_password` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `personal_info`
--

INSERT INTO `personal_info` (`id`, `user_id`, `f_name`, `l_name`, `m_name`, `inn`, `mobile_phone`, `ip`, `tab_num`, `company_post`, `region`, `date_password`) VALUES
(1, 1, 'Денис', 'Рыков', 'Игорьевич', 951025351348, 8710515252, 3232235806, 16435, '16', 5006, '2020-03-16 09:35:32'),
(2, 2, 'Георгий', 'Колмаков', 'Александрович', 951025351348, 8710515252, 3232235806, 16435, '16', 5006, '2020-03-16 09:35:32');

-- --------------------------------------------------------

--
-- Структура таблицы `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `ti_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '1',
  `text` varchar(255) NOT NULL DEFAULT '1',
  `user_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT '1',
  `priority` int(1) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `ti_accept` int(11) DEFAULT NULL,
  `ti_date` date DEFAULT NULL,
  `ti_email` varchar(50) DEFAULT NULL,
  `ti_phone` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`ti_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tickets`
--

INSERT INTO `tickets` (`ti_id`, `title`, `text`, `user_id`, `owner_id`, `priority`, `status`, `ti_accept`, `ti_date`, `ti_email`, `ti_phone`) VALUES
(1, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 1, 2, 1, 1, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(2, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 2, 1, 2, 2, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(3, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 2, 1, 5, 2, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(4, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 1, 2, 3, 3, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(5, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 2, 1, 4, 4, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(6, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 1, 2, 5, 1, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(7, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 2, 1, 1, 2, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(8, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 1, 2, 2, 3, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(9, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 2, 1, 3, 4, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(10, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 1, 2, 4, 1, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300'),
(11, 'Проверка работы системы', 'В данном примере с помощью команды group by строки группируются по возрасту и для каждой группы через запятую выводятся имена работников с таким возрастом:', 1, 2, 1, 3, NULL, '2020-03-26', 'Rykov_D@zashita.railways.kz', '87233760300');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket_timeline`
--

DROP TABLE IF EXISTS `ticket_timeline`;
CREATE TABLE IF NOT EXISTS `ticket_timeline` (
  `tm_id` int(11) NOT NULL AUTO_INCREMENT,
  `ti_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event` varchar(255) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`tm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `ticket_timeline`
--

INSERT INTO `ticket_timeline` (`tm_id`, `ti_id`, `user_id`, `event`, `event_id`, `date`) VALUES
(1, 1, 1, 'Создание', 1, '2020-01-15 12:25:20'),
(2, 1, 3, 'Назначен исполнитель', 2, '2020-01-15 12:25:20'),
(3, 2, 2, 'Создание', 1, '2020-01-15 12:33:41'),
(4, 2, 3, 'Назначен исполнитель', 2, '2020-01-15 12:33:41'),
(5, 1, 1, 'Тикет закрыт!', 5, '2020-01-15 14:45:49'),
(6, 2, 1, 'Тикет закрыт!', 5, '2020-01-15 15:46:14'),
(7, 1, 1, 'Тикет возобновлен!', 1, '2020-01-15 15:50:44'),
(8, 1, 1, 'Тикет закрыт!', 5, '2020-01-15 15:50:48');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(1) DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `status`, `role`) VALUES
(1, 'Rykov_D@zashita.railways.kz', '$2y$10$GOmPZX.VWURKk6vkKSWIL.QDLT7vcKOLwN4sk02Wa8eW1zJTYGIBC', 1, '5'),
(2, 'Kolmakov_G@ktzh.railways.kz', '$2y$10$GOmPZX.VWURKk6vkKSWIL.QDLT7vcKOLwN4sk02Wa8eW1zJTYGIBC', 1, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `m_name` varchar(50) DEFAULT NULL,
  `phone` text,
  `ip` int(10) UNSIGNED DEFAULT NULL,
  `date_password` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `f_name`, `l_name`, `m_name`, `phone`, `ip`, `date_password`) VALUES
(1, 1, 'Денис', 'Рыков', 'Игорьевич', '+77710515252', 4294967295, '2020-03-16 09:35:32');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
