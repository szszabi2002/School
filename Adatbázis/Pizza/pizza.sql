-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Feb 26. 08:23
-- Kiszolgáló verziója: 10.4.21-MariaDB
-- PHP verzió: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `pizza_13i_2cs`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pfutar`
--

CREATE TABLE `futar` (
  `fazon` int(3) NOT NULL DEFAULT 0,
  `fnev` varchar(25) COLLATE latin2_hungarian_ci NOT NULL DEFAULT '',
  `ftel` varchar(12) COLLATE latin2_hungarian_ci NOT NULL DEFAULT ''
);

--
-- A tábla adatainak kiíratása `pfutar`
--

INSERT INTO `futar` (`fazon`, `fnev`, `ftel`) VALUES
(1, 'Hurrikán', '123456'),
(2, 'Gyalogkakukk', '666666'),
(3, 'Gömbvillám', '888888'),
(4, 'Szélvész', '258369'),
(5, 'Imperial', '987654');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ppizza`
--

CREATE TABLE `pizza` (
  `pazon` int(3) NOT NULL DEFAULT 0,
  `pnev` varchar(15) COLLATE latin2_hungarian_ci NOT NULL DEFAULT '',
  `par` int(4) NOT NULL DEFAULT 0
);

--
-- A tábla adatainak kiíratása `ppizza`
--

INSERT INTO `pizza` (`pazon`, `pnev`, `par`) VALUES
(1, 'Capricciosa', 900),
(2, 'Frutti di Mare', 1100),
(3, 'Hawaii', 780),
(4, 'Vesuvio', 890),
(5, 'Sorrento', 990);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `prendeles`
--

CREATE TABLE `rendeles` (
  `razon` int(8) NOT NULL DEFAULT 0,
  `vazon` int(6) NOT NULL DEFAULT 0,
  `fazon` int(3) NOT NULL DEFAULT 0,
  `datum` date DEFAULT NULL,
  `ido` time NOT NULL
);

--
-- A tábla adatainak kiíratása `prendeles`
--

INSERT INTO `rendeles` (`razon`, `vazon`, `fazon`, `datum`, `ido`) VALUES
(1, 4, 2, '2010-10-01', '13:15:00'),
(2, 7, 2, '2010-10-01', '14:17:00'),
(3, 1, 1, '2010-10-02', '11:07:00'),
(4, 5, 2, '2010-10-02', '14:55:00'),
(5, 2, 3, '2010-10-02', '15:27:00'),
(6, 4, 2, '2010-10-03', '15:58:00'),
(7, 6, 2, '2010-10-04', '11:44:00'),
(8, 7, 4, '2010-10-04', '12:11:00'),
(9, 1, 5, '2010-10-04', '14:33:00'),
(10, 3, 5, '2010-10-04', '18:04:00'),
(11, 2, 1, '2010-10-05', '16:38:00'),
(12, 5, 2, '2010-10-05', '17:02:00'),
(13, 6, 2, '2010-10-06', '12:17:00'),
(14, 4, 3, '2010-10-06', '13:21:00'),
(15, 1, 4, '2010-10-06', '15:05:00'),
(16, 2, 5, '2010-10-06', '15:59:00'),
(17, 7, 2, '2010-10-06', '18:44:00'),
(18, 3, 2, '2010-10-07', '12:01:00'),
(19, 4, 5, '2010-10-07', '13:44:00'),
(20, 1, 1, '2010-10-07', '17:25:00'),
(21, 5, 3, '2010-10-08', '14:29:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ptetel`
--

CREATE TABLE `tetel` (
  `razon` int(8) NOT NULL DEFAULT 0,
  `pazon` int(3) NOT NULL DEFAULT 0,
  `db` int(3) NOT NULL DEFAULT 0
);

--
-- A tábla adatainak kiíratása `ptetel`
--

INSERT INTO `tetel` (`razon`, `pazon`, `db`) VALUES
(1, 1, 2),
(1, 4, 3),
(2, 2, 1),
(3, 1, 2),
(4, 1, 1),
(4, 4, 1),
(5, 2, 4),
(6, 1, 1),
(6, 4, 1),
(6, 5, 1),
(7, 5, 5),
(8, 4, 3),
(9, 2, 1),
(10, 1, 1),
(10, 4, 1),
(11, 1, 1),
(12, 2, 2),
(12, 4, 2),
(13, 4, 1),
(13, 5, 1),
(13, 2, 1),
(14, 2, 2),
(15, 1, 1),
(16, 2, 1),
(16, 4, 1),
(16, 5, 1),
(17, 1, 2),
(17, 2, 3),
(18, 1, 4),
(18, 5, 1),
(19, 1, 1),
(19, 2, 1),
(19, 4, 1),
(19, 5, 1),
(20, 5, 3),
(21, 2, 2),
(21, 4, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `pvevo`
--

CREATE TABLE `vevo` (
  `vazon` int(6) NOT NULL DEFAULT 0,
  `vnev` varchar(30) COLLATE latin2_hungarian_ci NOT NULL DEFAULT '',
  `vcim` varchar(30) COLLATE latin2_hungarian_ci NOT NULL DEFAULT ''
);

--
-- A tábla adatainak kiíratása `pvevo`
--

INSERT INTO `vevo` (`vazon`, `vnev`, `vcim`) VALUES
(1, 'Hapci', ''),
(2, 'Vidor', ''),
(3, 'Tudor', ''),
(4, 'Kuka', ''),
(5, 'Szende', ''),
(6, 'Szundi', ''),
(7, 'Morgó', '');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `pfutar`
--
ALTER TABLE `futar`
  ADD PRIMARY KEY (`fazon`);

--
-- A tábla indexei `ppizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`pazon`);

--
-- A tábla indexei `prendeles`
--
ALTER TABLE `rendeles`
  ADD PRIMARY KEY (`razon`);

--
-- A tábla indexei `pvevo`
--
ALTER TABLE `vevo`
  ADD PRIMARY KEY (`vazon`);
  
ALTER TABLE `tetel`
  ADD PRIMARY KEY (razon,pazon);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
