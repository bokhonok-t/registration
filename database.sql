-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 02 2015 г., 18:17
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `regist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `login` varchar(30) NOT NULL,
  `pass` varchar(33) NOT NULL,
  `photo` text NOT NULL,
  `reg_date` date NOT NULL,
  `last_act` date NOT NULL,
  `salt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Дамп данных таблицы `User`
--

INSERT INTO `User` (`id`, `f_name`, `l_name`, `date_of_birth`, `address`, `phone`, `email`, `login`, `pass`, `photo`, `reg_date`, `last_act`, `salt`) VALUES
(71, 'Таня', 'Бохонок', '2015-08-19', 'твое сердце', '+38050263578', 'tanyusha-b95@rambler.ru', 'mika1995', 'cae2cbb525d1527fa5ec3197ea2706fb', 'img/profiles/12.jpg', '2015-08-23', '2015-08-23', 649),
(72, 'Влад', 'Симанков', '2015-08-03', 'мое сердце', '321654', 'simm25@gmail.com', 'simm25', '4e2fdb5fb02b400d5d8861b320e6279b', 'img/profiles/PHWuQHrToqA.jpg', '2015-08-23', '2015-08-23', 814),
(73, 'Никита', 'Нагаткин', '2015-08-25', 'ул. Новые друзья', '2323', 'forgot@about.you', 'nikkk', 'd6602d37f424910a61a2aedea5246bad', 'img/profiles/P1010360.JPG', '2015-08-23', '2015-08-23', 502),
(74, 'Владимир', 'Кучеренко', '2015-08-19', 'пустые надежды', '654646', 'teddy@loves.me', 'teddy', 'c6a77267f7f2d6f406ca30985946a65a', 'img/profiles/TANYA - WIN_20150624_213159.JPG', '2015-08-23', '2015-08-23', 611),
(75, 'Вика', 'Вигриян', '2015-08-25', 'рядом', '5468753', 'vihrian@gmail.ru', 'ginger', 'b640000cf9de40643e9e4276fc571b96', 'img/profiles/DSCF2465.JPG', '2015-08-26', '2015-08-26', 427),
(76, 'Игорь', 'Постриган', '2015-08-19', 'мажорсити', '124578', 'iam@richb.itch', 'igorigor', 'b13b154929d3960fce99d9286be058bb', 'img/profiles/P1010105.JPG', '2015-08-26', '2015-08-26', 701);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
