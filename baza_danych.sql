-- phpMyAdmin SQL Dump
-- version 4.9.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 09 Mar 2022, 20:24
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
(1, 'Kalendarz Główny', 'Kalendarz Główny', 1, '2022-03-09 20:23:36');

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
(1, 1, 1);

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
(1, 0, 'root', 'root', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 1, '', 2);

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
  MODIFY `Cal_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `events`
--
ALTER TABLE `events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `Images`
--
ALTER TABLE `Images`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
