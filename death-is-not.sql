-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 17 2021 г., 13:38
-- Версия сервера: 5.7.29
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `death-is-not`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user_log`
--

CREATE TABLE `user_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `lastName` text NOT NULL,
  `login` text NOT NULL,
  `loginHash` text NOT NULL,
  `password` text NOT NULL,
  `userHash` text,
  `privilege` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_log`
--

INSERT INTO `user_log` (`id`, `name`, `lastName`, `login`, `loginHash`, `password`, `userHash`, `privilege`) VALUES
(2, 'Владимир', 'Шарапов', 'q1zin@mail.ru', '7e4a2321b086a96b1b1a72cb242b40f3', '$2y$10$t7ND46SkNKc59J.Yaj7h7eek6Woywdra0PcVGaiZTNRFwZoXAIHhe', '2785a7e50e4a7908c34706fc813b6d91', 'admin'),
(37, 'Владимир', 'Шарапов', '2', '521cd20e43f0dbae34878969876b34fc', '$2y$10$/F709eyFrzbWZEvgD9GwDuij.XskZ5vm2QoyyfFHOUe3w0cVvCJxO', '61982d9b42e3c54a7e6b4537ebddcca9', 'user'),
(49, '22', '22', '22', 'fbb688ca8fb5020f7578f2a75e7cb04d', '$2y$10$UtN2QaVL5EWixUQwMBXtp.tbQ/vDu.azT3D84qBuST0to2oCB9mNS', '70d6337aac9bf58b7450ac2f115af954', 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `vidos`
--

CREATE TABLE `vidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `views` int(20) DEFAULT NULL,
  `content` text,
  `link` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `vidos`
--

INSERT INTO `vidos` (`id`, `views`, `content`, `link`) VALUES
(1, 1, 'Каждый год в России в дтп погибает по 20 тысяч человек. Смертность на дорогах у нас гораздо выше, чем в западных странах. Это происходит из-за того, что у нас не правильно проектируют дороги и организуют движение.', 'xR9CcmruiJg'),
(2, 2, 'Разоблачение блогера-полицейского. Действующий ли сотрудник? Какое подразделение? Почему перестал сниматься в форме?', 'S1qgxgi08iU'),
(3, 6, 'Разоблачение блогера-полицейского. Действующий ли сотрудник? Какое подразделение? Почему перестал сниматься в форме?', 'S1qgxgi08iU'),
(4, 5, 'Каждый год в России в дтп погибает по 20 тысяч человек. Смертность на дорогах у нас гораздо выше, чем в западных странах. Это происходит из-за того, что у нас не правильно проектируют дороги и организуют движение.', 'xR9CcmruiJg'),
(5, 4, 'Почему на дорогах случает все больше дтп? Одной из причин является то, что многие после автошколы не знают банальных правил дорожного движение и создают аварийные ситуации, подвергая свою жизнь и жизнь окружающих опасности.\r\n', 'O5uwx-8u7jY'),
(6, 3, 'Почему на дорогах случает все больше дтп? Одной из причин является то, что многие после автошколы не знают банальных правил дорожного движение и создают аварийные ситуации, подвергая свою жизнь и жизнь окружающих опасности.\r\n', 'O5uwx-8u7jY');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `vidos`
--
ALTER TABLE `vidos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `vidos`
--
ALTER TABLE `vidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
