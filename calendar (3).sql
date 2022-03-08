-- phpMyAdmin SQL Dump
-- version 4.9.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 08 Mar 2022, 20:42
-- Wersja serwera: 5.7.33-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `calendar`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Calendars`
--

CREATE TABLE `Calendars` (
  `Cal_ID` int(11) NOT NULL,
  `Name` text COLLATE utf8_polish_ci NOT NULL,
  `Description` text COLLATE utf8_polish_ci NOT NULL,
  `Owner` int(11) NOT NULL,
  `Time_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Calendars`
--

INSERT INTO `Calendars` (`Cal_ID`, `Name`, `Description`, `Owner`, `Time_added`) VALUES
(2, 'Testowy kalendarz', '\r\nTestowy kalendarz\r\n\r\n', 1, '2022-02-16 17:01:11'),
(3, 'Testowy kalendarz', '<p>Test</p>', 1, '2022-02-16 17:06:18'),
(4, 'Testowy kalendarz', '<p>Test</p>', 1, '2022-02-16 17:07:13'),
(5, 'Test 2', '<p>ttt</p>', 1, '2022-02-16 17:10:30'),
(7, 'Kal1', '<p>XDDD</p>', 1, '2022-02-24 18:22:10'),
(8, 'XDDD2', '<p>XDD</p>', 1, '2022-02-24 20:54:25'),
(9, 'XDDD', '<p>123</p>', 1, '2022-02-26 13:20:58'),
(10, '3213', '<p>321</p>', 1, '2022-03-08 20:14:26'),
(11, '321XDD', '<p>321</p>', 1, '2022-03-08 20:14:47'),
(12, '321', '<p>321</p>', 1, '2022-03-08 20:17:04'),
(13, '321XDDDD', '<p>321</p>', 1, '2022-03-08 20:19:15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Calendars_perm`
--

CREATE TABLE `Calendars_perm` (
  `Cal_ID` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Selected` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Calendars_perm`
--

INSERT INTO `Calendars_perm` (`Cal_ID`, `User_id`, `Selected`) VALUES
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(7, 5, 0),
(7, 6, 0),
(10, 1, 0),
(11, 1, 0),
(12, 1, 0),
(13, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events`
--

CREATE TABLE `events` (
  `ID` int(11) NOT NULL,
  `title` text COLLATE utf8_polish_ci NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `color` int(11) NOT NULL DEFAULT '1',
  `user_add` int(11) NOT NULL DEFAULT '0',
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `mode` int(11) NOT NULL DEFAULT '0',
  `calendar_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `events`
--

INSERT INTO `events` (`ID`, `title`, `content`, `color`, `user_add`, `time_start`, `time_end`, `mode`, `calendar_id`) VALUES
(1, 'Test', 'zawartos', 1, 1, '2022-01-29 02:00:00', '2022-01-29 12:00:00', 0, 0),
(2, 'Test', 'zawartos', 1, 1, '2022-01-29 02:00:00', '2022-01-29 12:00:00', 0, 0),
(3, 'Test', 'zawartos', 1, 1, '2022-01-29 02:00:00', '2022-01-29 12:00:00', 0, 0),
(4, 'Test', 'zawartos', 1, 1, '2022-01-29 02:00:00', '2022-01-29 12:00:00', 0, 0),
(5, 'Test', 'zawartos', 1, 1, '2022-01-29 02:00:00', '2022-01-29 12:00:00', 0, 0),
(6, '12 ', 'X', 1, 1, '2022-01-29 01:00:00', '2022-01-29 15:00:00', 0, 0),
(7, '12 ', 'X', 1, 1, '2022-01-29 01:00:00', '2022-01-29 15:00:00', 0, 0),
(8, '213', 'X', 1, 1, '2022-01-29 01:00:00', '2022-01-29 04:00:00', 0, 0),
(9, '12', 'X', 1, 1, '2022-01-29 03:00:00', '2022-01-29 15:00:00', 0, 0),
(10, '12321', 'X', 1, 1, '2022-01-29 03:00:00', '2022-01-29 15:00:00', 0, 0),
(11, '12312', 'X', 1, 1, '2022-01-29 02:00:00', '2022-01-29 15:00:00', 0, 0),
(12, '123', 'X', 1, 1, '2022-01-29 01:00:00', '2022-01-29 04:00:00', 0, 0),
(13, '145', 'X', 1, 1, '2022-01-29 02:00:00', '2022-01-29 15:00:00', 0, 0),
(14, '14', 'X', 1, 1, '2022-01-29 01:00:00', '2022-01-29 15:00:00', 0, 0),
(15, '145', 'X', 1, 1, '2022-01-29 01:00:00', '2022-01-29 15:00:00', 0, 0),
(16, '312', 'X', 1, 1, '2022-01-29 01:00:00', '2022-01-29 04:00:00', 0, 0),
(17, 'Test', 'zawartos', 1, 1, '2022-01-29 02:00:00', '2022-01-29 12:00:00', 0, 0),
(18, '14', 'X', 1, 1, '2022-01-29 01:00:00', '2022-01-29 15:00:00', 0, 0),
(19, '250', 'X', 1, 1, '2022-01-03 01:00:00', '2022-01-17 02:00:00', 0, 0),
(20, '250', 'X', 1, 1, '2022-01-24 15:00:00', '2022-01-24 16:00:00', 0, 0),
(21, '350', 'X', 1, 1, '2022-01-25 01:00:00', '2022-01-25 04:00:00', 0, 0),
(22, '12', 'X', 1, 1, '2022-01-31 01:00:00', '2022-01-31 03:00:00', 0, 0),
(23, 'TEST XDF', 'X', 1, 1, '2022-02-01 01:00:00', '2022-01-01 02:00:00', 0, 0),
(24, '321', 'X', 1, 1, '2022-01-31 00:00:00', '2022-01-31 00:30:00', 0, 0),
(25, '21', 'X', 1, 1, '2022-02-01 01:00:00', '2022-01-01 03:00:00', 0, 0),
(26, '22222SSSO', 'X', 1, 1, '2022-02-02 01:00:00', '2022-02-02 03:00:00', 0, 0),
(27, 'COOOOOXD', 'X', 1, 1, '2022-01-31 04:00:00', '2022-01-31 05:00:00', 0, 0),
(28, 'XDDDDDD', 'X', 1, 1, '2022-02-01 01:00:00', '2022-02-01 02:00:00', 0, 0),
(29, '12', 'X', 1, 1, '2022-02-02 01:00:00', '2022-02-02 02:00:00', 0, 0),
(30, '12', 'X', 1, 1, '2022-03-05 01:00:00', '2022-02-05 02:00:00', 0, 0),
(31, '13', 'X', 1, 1, '2022-02-05 01:00:00', '2022-02-05 03:00:00', 0, 0),
(32, '123', '<p>Test tego co moze byc XDD</p><p><br></p><p><strong>Test, dziala?</strong></p>', 3, 1, '2022-02-10 03:00:00', '2022-02-10 15:00:00', 0, 0),
(33, 'COO', '<p>XDD</p>', 2, 1, '2022-02-07 15:00:00', '2022-02-11 16:00:00', 0, 0),
(34, '12', '<p>12</p>', 1, 1, '2022-02-11 01:00:00', '2022-02-11 03:00:00', 0, 1),
(35, '14', '<p><br></p>', 4, 1, '2022-02-07 01:00:00', '2022-02-07 02:00:00', 0, 1),
(36, '13', '<p>XD</p>', 6, 1, '2022-02-11 03:00:00', '2022-02-11 07:00:00', 0, 1),
(37, '1290', '<p><br></p>', 5, 1, '2022-02-12 01:00:00', '2022-02-11 02:00:00', 0, 1),
(38, '12', '<p>12</p>', 5, 1, '2022-02-12 01:00:00', '2022-02-11 02:00:00', 0, 1),
(39, '12', '<p><br></p>', 5, 1, '2022-02-12 01:00:00', '2022-02-12 02:00:00', 0, 1),
(40, '13', '<p><br></p>', 1, 1, '2022-02-12 03:00:00', '2022-02-11 04:00:00', 0, 1),
(41, '1231', '<p>XDD?</p>', 2, 1, '2022-02-12 03:00:00', '2022-02-12 04:00:00', 0, 1),
(42, '12', '<p>XD</p>', 4, 1, '2022-02-07 15:00:00', '2022-02-12 16:00:00', 0, 1),
(43, 'TR', '<p>12</p>', 1, 1, '2022-02-12 15:00:00', '2022-02-12 16:00:00', 0, 1),
(44, '12XDD', '<p>12</p>', 1, 1, '2022-02-12 01:00:00', '2022-02-12 03:00:00', 3, 1),
(45, '1', '<p><br></p>', 3, 1, '2022-02-08 01:00:00', '2022-02-08 02:00:00', 1, 1),
(46, 'RPTE-1', '<p>XD dziala reapet ?</p>', 4, 1, '2022-02-12 15:00:00', '2022-02-12 16:00:00', 5, 1),
(47, '12', '<p>1 day cal</p>', 1, 1, '2022-02-12 01:00:00', '2022-02-12 02:00:00', 1, 1),
(48, '12', '<p><br></p>', 1, 1, '2022-02-12 01:00:00', '2022-02-12 02:00:00', 1, 1),
(49, 'Tst12', '<p>TESt add day</p>', 6, 1, '2022-02-12 05:00:00', '2022-02-12 06:00:00', 1, 1),
(50, 'Kal nowy', '<p>Kal nowy</p>', 3, 1, '2022-02-24 15:00:00', '2022-02-24 16:00:00', 1, 1),
(67, 'CO dzinie ', '<p>every day</p>', 6, 1, '2022-03-01 15:00:00', '2022-03-01 16:00:00', 5, 7),
(68, 'co tydzien', '<p><br></p>', 4, 1, '2022-03-01 01:00:00', '2022-03-01 02:00:00', 2, 7),
(69, 'CO mieisac', '<p><br></p>', 5, 1, '2022-03-01 04:00:00', '2022-03-01 06:00:00', 3, 7),
(70, 'cos daleko', '<p>cos daleko i co dzinnie</p>', 2, 1, '2022-03-16 15:00:00', '2022-03-16 16:00:00', 5, 7),
(71, '123', '<p><br></p>', 4, 1, '2022-03-01 15:00:00', '2022-03-04 16:00:00', 1, 7),
(72, '321', '<p>213</p>', 1, 1, '2022-03-03 15:00:00', '2022-03-03 16:00:00', 1, 7),
(73, 'Dbdhdjdnd', '<p>Snejejejebe</p>', 4, 1, '2021-12-14 15:00:00', '2022-03-28 16:00:00', 1, 7),
(74, '321', '<p>123</p>', 6, 1, '2022-03-08 03:00:00', '2022-03-13 16:00:00', 1, 7),
(75, '132', '<p>321</p>', 1, 1, '2022-03-07 01:00:00', '2022-03-19 03:00:00', 1, 7),
(76, 'Czy jest 6', '<p>Jest 6 ?</p>', 4, 1, '2022-03-07 01:00:00', '2022-03-16 04:00:00', 6, 7),
(77, 'czy jest 1', '<h1>jest 1 ?</h1>', 2, 1, '2022-03-07 01:00:00', '2022-03-07 03:00:00', 1, 7),
(78, '6 ver 2', '<p>6 ver 2</p>', 1, 1, '2022-03-21 15:00:00', '2022-03-31 16:00:00', 6, 7),
(79, '321', '<p>321</p>', 1, 1, '2022-03-08 15:00:00', '2022-03-08 16:00:00', 1, 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Images`
--

CREATE TABLE `Images` (
  `ID` int(11) NOT NULL,
  `Path` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Images`
--

INSERT INTO `Images` (`ID`, `Path`) VALUES
(1, '/images/1.png'),
(2, '/images/2.png'),
(3, '/images/3.png'),
(4, '/images/4.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sessions`
--

CREATE TABLE `sessions` (
  `User_id` int(11) NOT NULL,
  `User_agent` text COLLATE utf8_polish_ci NOT NULL,
  `User_ip` text COLLATE utf8_polish_ci NOT NULL,
  `Ses_id` text COLLATE utf8_polish_ci NOT NULL,
  `Last_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL,
  `Force_pass` tinyint(1) NOT NULL DEFAULT '0',
  `Name` text COLLATE utf8_polish_ci NOT NULL,
  `Login` text COLLATE utf8_polish_ci NOT NULL,
  `Password` text COLLATE utf8_polish_ci NOT NULL,
  `Image_id` int(11) NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `Rank` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`ID`, `Force_pass`, `Name`, `Login`, `Password`, `Image_id`, `email`, `Rank`) VALUES
(1, 1, 'RatajX12', 'root', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 4, 'ratajx1@gmail.com', 2),
(4, 0, 'rooot', 'rooot', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 1, '1', 2),
(5, 1, 'RatajX1231', 'RatajX1231', 'b742348563ca4ffe5c3949c668d3f43363ceffbdc178464cc1e0aacfa8cf7f8c', 1, 'ratajx1@gmail.com', 1),
(6, 1, 'XRatajX1231', 'XRatajX1231', 'b742348563ca4ffe5c3949c668d3f43363ceffbdc178464cc1e0aacfa8cf7f8c', 1, 'ratajx1@gmail.com', 1),
(7, 0, 'XatrarXX', 'XatrarXX', '9aaa685bd44a5b2cf8934231c3a3c473aa78a4acdd4c6d08d39452909b2925d0', 1, 'XatrarXX@wpwp.pl', 2),
(8, 0, 'Are_yoo_seee', 'Are_yoo_seee', 'bf098b8dd2fc1e42990efdd5964b71dbb45995dc2719c55cc9192e5f9ea77d40', 1, 'aresee@wp.pl', 1),
(9, 0, '123', '123', '24bcef0f1514a358f1da4fe9dcc14e69d5704fe704d96c982c13cb1fd9cebda0', 1, '321@wp.pl', 1),
(10, 0, '321', '321', 'f1b0a1b1bf99a0e49986c10ccf4e52dadeaa8d5de56bd2c7ffa15b6839fbb203', 1, '321@wp.pl', 1),
(11, 0, '1234', '1234', '293a3081b2f2f0bf2cfef6837ba8e12ae13938d3c9145271b3ca20b1a0a450bd', 1, '321@wp.pl', 1),
(12, 0, '21345123', '21345123', '17826b8135d41aaccadebac981b2f7323a6ed5ebabaa7cabb5fb9812e9533fdd', 1, '321@wp.pl', 1),
(13, 0, 'dsadsada', 'dsadsada', 'bb98b79c82c957c5642e0a93d0865aa0c2865a11d334aaad009536b23b2e5873', 1, '321@wp.pl', 1),
(14, 0, 'dfsafasfsa', 'dfsafasfsa', '130628e9c1c3d40d474d977755f5afb100e1282544bdfa289dd66894c01f94c8', 1, '321@wp.pl', 2),
(15, 0, 'dsadsadsa', 'dsadsadsa', 'c15fad6bbaa8b84dbaedce83afec2ace50534d69f65999a6850a078ca8588402', 1, '321@wp.pl', 1),
(16, 0, '321312', '321312', '33345d406a336cb1e17eac1497f54c2f7442018b54a5a9ec12a96a22bf09127f', 1, '3213123', 1),
(17, 0, 'DragonSlayer', 'DragonSlayer', '9ae144bf7138f0fe49c574bb97efac0e05e926ed0e6927a0ee752b6f5553e3db', 1, 'ratajx1@gmail.com', 2),
(18, 0, 'Xastar', 'Xastar', '9dee6b215c5837ffe3ffa2ff64314d27a9952c195bbbb4b5b215e7995f89fb67', 1, 'ratajx1@gmail.com', 1),
(19, 0, 'Xareowa', 'Xareowa', 'eca7ad46a4928d81a29fbd51349e795ce067d83c017755fb24188ac282ac9136', 1, '321@321.pl', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `Calendars`
--
ALTER TABLE `Calendars`
  ADD PRIMARY KEY (`Cal_ID`);

--
-- Indeksy dla tabeli `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `Images`
--
ALTER TABLE `Images`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `Calendars`
--
ALTER TABLE `Calendars`
  MODIFY `Cal_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT dla tabeli `Images`
--
ALTER TABLE `Images`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
