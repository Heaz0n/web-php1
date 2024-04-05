-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 04 2024 г., 11:03
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php8`
--

-- --------------------------------------------------------

--
-- Структура таблицы `captcha`
--

CREATE TABLE `captcha` (
  `id` int NOT NULL,
  `value1` int NOT NULL,
  `value2` int NOT NULL,
  `operation` enum('+','-','*','/') COLLATE utf8mb4_general_ci NOT NULL,
  `result` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `captcha`
--

INSERT INTO `captcha` (`id`, `value1`, `value2`, `operation`, `result`) VALUES
(1, 9, 2, '/', 5),
(2, 4, 7, '/', 1),
(3, 4, 6, '+', 10),
(4, 1, 1, '*', 1),
(5, 1, 9, '/', 0),
(6, 1, 4, '+', 5),
(7, 10, 8, '/', 1),
(8, 8, 4, '*', 32),
(9, 5, 10, '*', 50),
(10, 1, 10, '/', 0),
(11, 7, 9, '+', 16),
(12, 5, 4, '/', 1),
(13, 1, 4, '-', -3),
(14, 9, 10, '-', -1),
(15, 1, 1, '*', 1),
(16, 9, 10, '/', 1),
(17, 1, 1, '/', 1),
(18, 1, 6, '-', -5),
(19, 7, 9, '+', 16),
(20, 6, 10, '-', -4),
(21, 9, 1, '+', 10),
(22, 2, 5, '*', 10),
(23, 7, 6, '*', 42),
(24, 8, 7, '*', 56),
(25, 4, 5, '+', 9),
(26, 6, 3, '-', 3),
(27, 2, 6, '*', 12),
(28, 10, 10, '*', 100),
(29, 2, 3, '-', -1),
(30, 9, 3, '*', 27),
(31, 4, 6, '+', 10),
(32, 6, 4, '*', 24),
(33, 2, 8, '-', -6),
(34, 4, 2, '-', 2),
(35, 2, 1, '/', 2),
(36, 9, 2, '-', 7),
(37, 3, 7, '+', 10),
(38, 10, 2, '-', 8),
(39, 6, 3, '*', 18),
(40, 10, 7, '/', 1),
(41, 4, 4, '/', 1),
(42, 9, 8, '-', 1),
(43, 5, 9, '*', 45),
(44, 8, 7, '/', 1),
(45, 3, 4, '+', 7),
(46, 1, 5, '*', 5),
(47, 8, 8, '-', 0),
(48, 3, 4, '-', -1),
(49, 10, 4, '-', 6),
(50, 1, 10, '/', 0),
(51, 9, 7, '/', 1),
(52, 9, 8, '+', 17),
(53, 5, 5, '*', 25),
(54, 6, 1, '/', 6),
(55, 2, 3, '*', 6),
(56, 1, 3, '-', -2),
(57, 2, 8, '/', 0),
(58, 10, 4, '-', 6),
(59, 2, 2, '*', 4),
(60, 6, 9, '-', -3),
(61, 2, 6, '+', 8),
(62, 1, 2, '/', 1),
(63, 9, 4, '+', 13),
(64, 4, 10, '/', 0),
(65, 3, 6, '-', -3),
(66, 8, 7, '*', 56),
(67, 2, 5, '+', 7),
(68, 5, 10, '-', -5),
(69, 1, 5, '/', 0),
(70, 9, 3, '-', 6),
(71, 2, 9, '*', 18),
(72, 10, 10, '-', 0),
(73, 6, 10, '+', 16),
(74, 6, 6, '+', 12),
(75, 4, 9, '-', -5),
(76, 10, 6, '+', 16),
(77, 5, 4, '+', 9),
(78, 7, 3, '/', 2),
(79, 8, 1, '+', 9),
(80, 8, 5, '/', 2),
(81, 7, 4, '/', 2),
(82, 5, 4, '-', 1),
(83, 3, 9, '-', -6),
(84, 9, 7, '/', 1),
(85, 6, 8, '/', 1),
(86, 5, 9, '*', 45),
(87, 2, 9, '-', -7),
(88, 1, 8, '+', 9),
(89, 6, 4, '*', 24),
(90, 8, 1, '+', 9),
(91, 6, 5, '*', 30);

-- --------------------------------------------------------

--
-- Структура таблицы `object_captcha`
--

CREATE TABLE `object_captcha` (
  `id` int NOT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `object_captcha`
--

INSERT INTO `object_captcha` (`id`, `image_name`, `category`) VALUES
(1, 'apple.png', 'Фрукт'),
(2, 'car.png', 'Транспорт'),
(3, 'book.png', 'Книга');

-- --------------------------------------------------------

--
-- Структура таблицы `text_captcha`
--

CREATE TABLE `text_captcha` (
  `id` int NOT NULL,
  `captcha_text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `text_captcha`
--

INSERT INTO `text_captcha` (`id`, `captcha_text`, `created_at`) VALUES
(1, 'fKyChj', '2024-04-04 07:37:29'),
(2, 'Gz6lc2', '2024-04-04 07:37:38'),
(3, 'IgXSZK', '2024-04-04 07:37:40'),
(4, '9jVrSP', '2024-04-04 07:37:41'),
(5, 'pcGzbj', '2024-04-04 07:37:51'),
(6, 'BOB4BL', '2024-04-04 07:37:53'),
(7, '3yBoac', '2024-04-04 07:37:55'),
(8, 'LtB8LL', '2024-04-04 07:39:52'),
(9, 'aXuDoQ', '2024-04-04 07:39:53'),
(10, 'BRXS1l', '2024-04-04 07:39:54'),
(11, 'KdgPTj', '2024-04-04 07:40:00'),
(12, 'x8xlSh', '2024-04-04 07:40:40'),
(13, 'w9Thj6', '2024-04-04 07:40:46'),
(14, 'cR5i0n', '2024-04-04 07:40:47');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `object_captcha`
--
ALTER TABLE `object_captcha`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `text_captcha`
--
ALTER TABLE `text_captcha`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `captcha`
--
ALTER TABLE `captcha`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT для таблицы `object_captcha`
--
ALTER TABLE `object_captcha`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `text_captcha`
--
ALTER TABLE `text_captcha`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
