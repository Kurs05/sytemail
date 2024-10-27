-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Окт 27 2024 г., 21:18
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mysite`
--
CREATE DATABASE IF NOT EXISTS `mysite` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `mysite`;

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `sender_id` int NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `receiver_id` int NOT NULL,
  `topic` text NOT NULL,
  `is_read` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `message`, `created_at`, `receiver_id`, `topic`, `is_read`) VALUES
(2, 9, 'куку', '2024-10-13 17:33:17', 10, '', 1),
(5, 9, 'mmf', '2024-10-15 15:53:39', 9, '', 1),
(7, 9, 'rfmnrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', '2024-10-16 18:16:16', 10, 'nmfffffffffffffffffffffffffffffffffmfmnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 1),
(8, 10, 'wkrlmrkfffffrmkffffffffffffffffffffffffffmkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', '2024-10-18 17:37:47', 9, 'frokrfkoofkor', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `page_id` smallint NOT NULL,
  `page_alias` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_meta_d` varchar(255) NOT NULL,
  `page_meta_k` varchar(255) NOT NULL,
  `page_h1` varchar(255) NOT NULL,
  `page_s_desc` text NOT NULL,
  `page_content` text NOT NULL,
  `page_publish` char(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='таблица предназначена для страниц сайта';

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Kursisdedinsaid', 'frklrf@ef.ry', '$2y$10$iVHldLFwV2p9eVlDU0E.rebgvDH3j331ybiBVnLWhF3oyb5Lzipy.', '2024-10-07 09:17:26'),
(2, 'Kursisdedinsaid', 'frklrf@ef.ry', '$2y$10$0oc7MmwzIoibgSe/ZarFsOSHH4.mPukpZ0undw8uRDim.Sibxi05G', '2024-10-07 09:18:02'),
(3, 'Kursisdedinsaid', 'frklrf@ef.ry', '$2y$10$ILhAuXDLoCw6IkXn/JpyA.FDJMfeyh.xL6i2Wlvm7TPkAzZ9IJqou', '2024-10-07 09:18:11'),
(4, 'Kursisdedinsaid', 'u2hfbsidubffb@dfjhb.com', '$2y$10$Gm4tnn0e7cjCuDOyo.1JPO37Q9nhgr0f40.U4jBOsZlnfwyH0MaiS', '2024-10-07 09:20:03'),
(5, 'Kursisdedinsaid', 'ffrffr@gh.tr', '$2y$10$e.EgRbXWyRk9iUFKr1khmeVHo/z4D7u.mS95CtUGgyIxC9/p.nmOq', '2024-10-07 09:30:10'),
(6, 'Kursisdedinsaid', 'hjjh@grg.rt', '$2y$10$IFqU.vp0/.aWrNMxOgEGzeMpqFR7xFSERNHB25WCMsiFcC9ybzyi2', '2024-10-07 09:42:49'),
(7, 'Kursisdedinsaid', 'kmmrmkf@frl.rt', '$2y$10$1T4tmsQeQvkw6G8zSKB5e.RpBqb7cTd0bdyt0nwu4FILYH7O3y5jS', '2024-10-07 09:46:04'),
(8, 'Kursisdedinsaid', 'emr@fe.fr', '$2y$10$5tvMGiDXroZKkZ.l2FW2O.gqQOplzqvSizh56aOH/Q/gALWYYZHga', '2024-10-07 09:46:20'),
(9, 'Kurs', 'krkrkke@edu', '$2y$10$2ZFDfwPPMKCw4DtquMVsQehoFWBBqKI55HKy3G73vPEAvkn.mbQOa', '2024-10-13 17:26:29'),
(10, 'VladSosi', 'ddnd@edu', '$2y$10$A24sBoXha288Jp.6w5x.aO4QQH8tsRUejBpa1yZME/rVQG92FOfSC', '2024-10-13 17:27:08');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_ID` (`sender_id`),
  ADD KEY `receiver_ID` (`receiver_id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` smallint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
