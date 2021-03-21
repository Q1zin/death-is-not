-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 21 2021 г., 20:24
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
  `region` text,
  `city` text,
  `privilege` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_log`
--

INSERT INTO `user_log` (`id`, `name`, `lastName`, `login`, `loginHash`, `password`, `userHash`, `region`, `city`, `privilege`) VALUES
(2, 'Владимир', 'Шарапов', 'q1zin@mail.ru', '7e4a2321b086a96b1b1a72cb242b40f3', '$2y$10$t7ND46SkNKc59J.Yaj7h7eek6Woywdra0PcVGaiZTNRFwZoXAIHhe', '2785a7e50e4a7908c34706fc813b6d91', NULL, NULL, 'admin'),
(37, 'Владимир', 'Шарапов', '2', '521cd20e43f0dbae34878969876b34fc', '$2y$10$/F709eyFrzbWZEvgD9GwDuij.XskZ5vm2QoyyfFHOUe3w0cVvCJxO', 'f228730a15dc4d1da7a91a878ddd1918', NULL, NULL, 'admin'),
(49, '22', '22', '22', 'fbb688ca8fb5020f7578f2a75e7cb04d', '$2y$10$UtN2QaVL5EWixUQwMBXtp.tbQ/vDu.azT3D84qBuST0to2oCB9mNS', '70d6337aac9bf58b7450ac2f115af954', NULL, NULL, 'user'),
(50, '23', '23', '23', '2c28578b5a4df51a4c3818af6751a753', '$2y$10$NNEBmt/LuqfC1sdtTu2QhOsf7yDm36Zq0bY.duILjix.8Z9T9J5Su', '3db875c1078e881cef845386eddc3c97', NULL, NULL, 'user'),
(51, 'wefwef', 'wefwef', 'vova.shar2016@yandex.ru', '4ec409e84d631e29848e06dba1ec7ee6', '$2y$10$poysaDzzdgZxh7F4M5xKQOWn60d2bFKohKsqgPwVjkjHmYhuzVFp2', '311bb0abb66a0d91897998b16e1fc26a', NULL, NULL, 'user'),
(52, 'ergge', 'ergerg', 'ergegr@mail.ru', '89aaa858b4efbbf9f3073534f5b01b73', '$2y$10$jx2wBBFegTcUbVbqlcHIge4ehORnZbkafVfuw80I0roiXiZwx2QnK', 'b87556802075126fc0437a1df2af17ca', NULL, NULL, 'user'),
(53, 'ergerg', 'ergerg', 'vova.shar2010@yandex.ru', '844f2d82215e23fadad6681228ab8b1c', '$2y$10$PqPn3tCtbq7QzcITVy4PCOEz3TtzorP1Ix69leA1h49OnupOL0CC2', '9864dbf8ba7796d2b0abaca0d58e714e', NULL, NULL, 'user'),
(54, 'Владимир', 'Шарапов', 'vova.shar2022@yandex.ru', '3c3ef9817b30f65bf7ef2041ca49759d', '$2y$10$m6rmw/HGB/94aHBN47.JauO2dON6Z4jxO28K3n0.MoSJ0rWHkglN2', '86d8217dbf34fe0edb7a0bf7de85ae0b', NULL, NULL, 'user'),
(55, 'купа', 'укппы', 'asdf@mail.ru', '9a49fe66973585109311d6d11a2b470d', '$2y$10$VPgTf9GLwtVi.XJZKhY.JuXapuwyFiyt3TBfiqk2Cv4BZSyR5HSeO', '27494477259ef175a7828834185ce1a5', NULL, NULL, 'user'),
(56, 'wefwef', 'wefwef', 'wef@mail.ru', '19d9820ed167022cafd54608178029ba', '$2y$10$OsuF8HoC9ZmVKdQJWVES4.kijnJ4slLM63CndB.7Fr1u78FmfH2DG', '3d2ec88aac95d3e910cd0f46b341c154', NULL, NULL, 'user'),
(57, 'zxc', 'zxc', 'zxc@mail.ru', '1de901b7ac59b314abb6b2dc76c1e774', '$2y$10$jcZvsn0DhJBXmpK8Y.7pRucRJj5G/aXpTJ70BQL5y97mCWIN34H1a', 'e639983e1b4d0d206e374e030cddefc5', NULL, NULL, 'user'),
(58, 'fgh', 'fgh', 'fgh@mail.ru', 'abd4ae3e2daa330754e0d8c852f5c2f1', '$2y$10$uz3lDPjguq4XnDhefoKUo.YE/3yCBkq8Bv5vTd3FnSSortT17ZGZ.', 'f3f350d737c6c690a9466c956a110b2b', NULL, NULL, 'user'),
(59, 'sdfasdf', 'asdfsd', 'qwe2@mail.ru', '2994f5715db5deb1643342d00a7eb3f0', '$2y$10$3HX7pmOKdyYW7CTnhmNT5esCalmPU9wc9qktA5yT4o5tdwDcaQ2Xq', '23298d84a94f3a28794fa1170c69f214', NULL, NULL, 'user'),
(60, 'Александр', 'Шарапов', 'Alex@mail.ru', '905a477c86a89a3d7f62483343c9b2e9', '$2y$10$nFZZ0kqKdakPn/z.AUaS8.5x/n/pgDl9ih/e7ObpMftWIJZIIkAlu', '6075ed68e21bc5229c97325de2eb0e84', '', '', 'user'),
(61, 'sdfsdf', 'sdfsdf', 'sdfsdf@xn--80aswg.xn--p1ai', '1bda8de218f5420ee3aedf35c4f6e788', '$2y$10$AE5jNNTFp3FUnA0v1BTeLu4qZuoUSZzq9gs8Sy8PbC1C3mCi8iB36', 'd348d32785b942db0d022b328845b410', NULL, NULL, 'user'),
(62, 'паро', 'апро', 'апро@сайт.рф', 'b4255b18842c424dcb68cec1c4253e55', '$2y$10$nae9I80/oL81zYqBEZnpqeZeRSqdsKvH/lJsh86KDr7eiYmR/n0pG', 'bef9779153e357b9c4da2a4c1c9daba2', NULL, NULL, 'user'),
(63, 'мить', 'мить', 'test2@xn--80aswg.xn--p1ai', 'a128268bae5b5e18ca232194630f6650', '$2y$10$n2sfLAQtOVN7/68s84jjoeDcJtOogEjYeqRE7N.zRWTNZg/0SO.Ie', '008876a20824a63349035e8d127224bb', NULL, NULL, 'user');

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
(1, 345345, 'Каждый год в России в дтп погибает по 20 тысяч человек. Смертность на дорогах у нас гораздо выше, чем в западных странах.', 'xR9CcmruiJg'),
(2, 2, 'Разоблачение блогера-полицейского. Действующий ли сотрудник? Какое подразделение?', 'S1qgxgi08iU'),
(5, 4, 'ТОП-5 ошибок дорожников, которые убивают людей', 'O5uwx-8u7jY'),
(9, 123, 'Спорное дтп при выезде на трассу. Как, кому и где надо уступать? Все нюансы полосы разгона.\r\n', 'Sm4_qvCjuSI'),
(10, 235, 'Разбор ошибок в выпуске Редакции про дтп\n', 'JOvFgh3zrl0'),
(11, 735, 'Турбо кольцо. Новый тип перекрестка. Как не попасть в аварию на кругу? / Обзор дтп №3\n', '2TSX0D8-PAc'),
(12, 6783, 'Нужны ли права? Можно ли пьяным? Можно ли выезжать на дороги? Разбор ПДД для электросамокатов\n', 'W0ukQWKr070'),
(13, 452, 'ТОП-6 смертельных ловушек для пешеходов. Как не погибнуть на наших дорогах?\n', 'vWJApqoukQ0'),
(14, 8362, 'Ноль смертей. Люди не должны умирать на дорогах! Как этого добиться?', 't_B__207vfc'),
(15, 2347, 'Самая полезная функция в машине. Лучше подушек безопасности! Почему так важна стабилизация ESP?\n', 'rPyO--4r7nU'),
(16, 1245, 'Никогда не пролетайте на свежий зеленый! Показываю почему. Обзор дтп №2\n\n', 'hw7HPZN5jLY'),
(17, 1245, 'Никогда не пролетайте на свежий зеленый! Показываю почему. Обзор дтп №2\n', 'wO-A9waTP2Q'),
(18, 1245, 'Бесконтактные ДТП. Кого обычно признают виновным?', 'UXfAPtK-ick'),
(19, 9938, 'Нива попала под военный Урал. Держитесь от военных подальше! / Разбор дтп №13\n', 'DlhbK63F0J0');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT для таблицы `vidos`
--
ALTER TABLE `vidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
