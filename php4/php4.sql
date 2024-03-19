-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 19 2024 г., 13:30
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
-- База данных: `php4`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `likes` int DEFAULT '0',
  `views` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `path`, `size`, `name`, `likes`, `views`) VALUES
(1, 'uploads/65f83ef9c7b631.89538000.jpg', 56340, 'unnamed.jpg', 0, 0),
(2, 'uploads/65f83f02b1a985.35771321.jpg', 56340, 'unnamed.jpg', 0, 0),
(3, 'uploads/65f83f04c76a52.18713145.jpg', 56340, 'unnamed.jpg', 0, 0),
(4, 'images\\pic1.jpg', 0, 'pic1.jpg', 0, 0),
(5, 'images\\pic2.jpg', 0, 'pic2.jpg', 0, 0),
(6, 'images\\pic3.jpg', 0, 'pic3.jpg', 0, 0),
(7, 'images\\pic4.jpg', 0, 'pic4.jpg', 0, 0),
(8, 'uploads/65f8470a3b3a26.56066008.png', 22164, 'logo.png', 0, 0),
(9, 'uploads/65f84fdc55efd2.37268847.png', 681317, '1682895792_polinka-top-p-krisa-iz-robloksa-kartinki-krasivo-2.png', 0, 0),
(10, 'uploads/65f85007072644.28903221.jpg', 66364, 'pic6.jpg', 0, 0),
(11, 'images\\pic5.jpg', 0, 'pic5.jpg', 0, 0),
(12, 'images\\pic6.jpg', 0, 'pic6.jpg', 0, 0),
(13, 'images\\pic7.jpg', 0, 'pic7.jpg', 0, 0),
(14, 'images\\pic8.jpg', 0, 'pic8.jpg', 0, 0),
(15, 'uploads/65f850b35cd324.52155632.jpg', 76997, 'pic5.jpg', 0, 0),
(16, 'uploads/65f850d2808fb4.20143106.png', 0, '569264943_5466970_up.png', 0, 0),
(17, 'uploads/65f851d24fb543.07790308.jpg', 236048, 'pic4.jpg', 0, 0),
(18, 'uploads/65f854fd2a7a29.99700109.png', 0, '569264943_5466970_up.png', 0, 0),
(19, 'uploads/65f85577a370b4.04959451.png', 681317, 'pic10.png', 0, 0),
(20, 'uploads/65f855e49d1109.17109035.jpg', 56340, 'pic1.jpg', 0, 0),
(21, 'uploads/65f8562660c721.77827363.jpg', 76997, 'pic5.jpg', 0, 0),
(22, 'uploads/65f8566aabcf61.58247454.jpg', 181072, 'pic8.jpg', 0, 0),
(23, 'images65f857764180f6.72593415.jpg', 236048, 'pic11.jpg', 0, 0),
(24, 'images//65f857a9d1f395.30672004.jpg', 236048, '65f857764180f6.72593415.jpg', 0, 0),
(25, 'images//65f857d190cae0.57214090.png', 22164, 'logo.png', 0, 0),
(26, 'images//65f963e90303d3.35803920.png', 681317, '1682895792_polinka-top-p-krisa-iz-robloksa-kartinki-krasivo-2.png', 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
