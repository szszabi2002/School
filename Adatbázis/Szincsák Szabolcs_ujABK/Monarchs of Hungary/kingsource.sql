-- Creating the database

CREATE DATABASE `kings`
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;
USE `kings`;

-- reigns

CREATE TABLE `reigns` (
  `id` int(11) NOT NULL,
  `monarch_id` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `crowned` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

INSERT INTO `reigns` (`id`, `monarch_id`, `start`, `end`, `crowned`) VALUES
(1, 1, 1000, 1038, 1000),
(2, 2, 1038, 1041, 1038),
(3, 3, 1041, 1044, 1044),
(4, 2, 1044, 1046, NULL),
(5, 4, 1046, 1060, 1046),
(6, 5, 1060, 1063, 1060),
(7, 6, 1063, 1074, 1063),
(8, 7, 1074, 1077, 1075),
(9, 8, 1077, 1095, 1081),
(10, 9, 1095, 1116, 1095),
(11, 10, 1116, 1131, 1116),
(12, 11, 1131, 1141, 1131),
(13, 12, 1141, 1162, 1141),
(14, 13, 1162, 1172, 1162),
(15, 14, 1172, 1196, 1173),
(16, 15, 1196, 1204, 1194),
(17, 16, 1204, 1205, 1204),
(18, 17, 1205, 1235, 1205),
(19, 18, 1235, 1270, 1235),
(20, 19, 1270, 1272, 1270),
(21, 20, 1272, 1290, 1272),
(22, 21, 1290, 1301, 1290),
(23, 22, 1301, 1305, 1301),
(24, 23, 1305, 1307, 1305),
(25, 24, 1308, 1342, 1301),
(26, 25, 1342, 1382, 1342),
(27, 26, 1382, 1385, 1382),
(28, 27, 1385, 1386, 1385),
(29, 26, 1386, 1395, NULL),
(30, 28, 1387, 1437, 1387),
(31, 29, 1437, 1439, 1438),
(32, 30, 1440, 1457, 1440),
(33, 31, 1440, 1444, 1440),
(34, 32, 1458, 1490, 1464),
(35, 33, 1490, 1516, 1490),
(36, 34, 1516, 1526, 1508),
(37, 35, 1526, 1540, 1526),
(38, 36, 1540, 1571, NULL),
(39, 37, 1526, 1564, 1527),
(40, 38, 1564, 1576, 1563),
(41, 39, 1576, 1608, 1572),
(42, 40, 1608, 1619, 1608),
(43, 41, 1618, 1637, 1618),
(44, 42, 1637, 1657, 1625),
(45, 43, 1647, 1654, 1647),
(46, 44, 1657, 1705, 1655),
(47, 45, 1705, 1711, 1687),
(48, 46, 1711, 1740, 1712),
(49, 47, 1740, 1780, 1712),
(50, 48, 1780, 1790, NULL),
(51, 49, 1790, 1792, 1790),
(52, 50, 1792, 1835, 1792),
(53, 51, 1835, 1848, 1830),
(54, 52, 1848, 1916, 1867),
(55, 53, 1916, 1918, 1916);

-- --------------------------------------------------------

-- monarch

CREATE TABLE `monarchs` (
  `id` int(11) NOT NULL,
  `mname` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `commonname` varchar(30) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `born` int(11) NOT NULL,
  `died` int(11) NOT NULL,
  `dyn_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--

INSERT INTO `monarchs` (`id`, `mname`, `commonname`, `born`, `died`, `dyn_id`) VALUES
(1, 'Stephen I', 'Saint Stephen', 969, 1038, 1),
(2, 'Péter', 'the Venetian', 1011, 1059, 1),
(3, 'Sámuel', 'Aba Sámuel', 990, 1044, 1),
(4, 'Andrew I', 'the White', 1015, 1060, 1),
(5, 'Béla I', 'the Champion', 1015, 1063, 1),
(6, 'Solomon', NULL, 1053, 1087, 1),
(7, 'Géza I', 'Magnus', 1040, 1077, 1),
(8, 'Ladislaus I', 'Saint Ladislaus', 1040, 1095, 1),
(9, 'Coloman', 'the Learned', 1074, 1116, 1),
(10, 'Stephen II', NULL, 1101, 1131, 1),
(11, 'Béla II', 'the Blind', 1108, 1141, 1),
(12, 'Géza II', NULL, 1130, 1162, 1),
(13, 'Stephen III', NULL, 1147, 1172, 1),
(14, 'Béla III', 'the Great', 1148, 1196, 1),
(15, 'Emeric', NULL, 1174, 1204, 1),
(16, 'Ladislaus III', NULL, 1200, 1205, 1),
(17, 'Andrew II', 'the Jerosolimitan', 1176, 1235, 1),
(18, 'Béla IV', 'the Second Founder of the State', 1206, 1270, 1),
(19, 'Stephen V', NULL, 1239, 1272, 1),
(20, 'Ladislaus IV', 'the Cuman', 1262, 1290, 1),
(21, 'Andrew III', 'the Venetian', 1265, 1301, 1),
(22, 'Vencel', 'Cseh Vencel', 1289, 1306, 2),
(23, 'Ottó', 'the Bavarian', 1261, 1312, 3),
(24, 'Charles I', 'Charles Robert', 1288, 1342, 4),
(25, 'Louis I', 'the Great', 1326, 1382, 4),
(26, 'Mary I', NULL, 1371, 1395, 4),
(27, 'Charles II', 'the Short', 1345, 1386, 4),
(28, 'Sigismund', 'of Luxembourg', 1368, 1437, 5),
(29, 'Albert', 'the Magnanimous', 1397, 1439, 6),
(30, 'Ladislaus V', 'the Posthumous', 1440, 1457, 6),
(31, 'Vladislaus I', 'Vladislaus of Varna', 1424, 1444, 7),
(32, 'Matthias I', 'the Just', 1443, 1490, 8),
(33, 'Vladislaus II', 'Vladislaus Dobže', 1456, 1516, 7),
(34, 'Louis II', NULL, 1506, 1526, 7),
(35, 'John I', NULL, 1487, 1540, 9),
(36, 'John II', 'John Sigismund', 1540, 1571, 9),
(37, 'Ferdinand I', NULL, 1503, 1564, 6),
(38, 'Maximilian', NULL, 1527, 1576, 6),
(39, 'Rudolph', NULL, 1552, 1612, 6),
(40, 'Matthias II', NULL, 1557, 1619, 6),
(41, 'Ferdinand II', NULL, 1578, 1637, 6),
(42, 'Ferdinand III', NULL, 1608, 1657, 6),
(43, 'Ferdinand IV', NULL, 1633, 1654, 6),
(44, 'Leopold I', NULL, 1640, 1705, 6),
(45, 'Joseph I', NULL, 1687, 1711, 6),
(46, 'Charles III', NULL, 1685, 1740, 6),
(47, 'Mary II', 'Maria Theresa', 1717, 1780, 6),
(48, 'Joseph II', 'the Hat King', 1741, 1790, 10),
(49, 'Leopold II', NULL, 1747, 1792, 10),
(50, 'Francis I', NULL, 1768, 1835, 10),
(51, 'Ferdinand V', 'the Benign', 1793, 1875, 10),
(52, 'Joseph Francis I', NULL, 1830, 1916, 10),
(53, 'Charles IV', 'Blessed Charles', 1887, 1922, 10);

-- --------------------------------------------------------

-- dynasties

CREATE TABLE `dynasties` (
  `id` int(11) NOT NULL,
  `dname` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

INSERT INTO `dynasties` (`id`, `dname`) VALUES
(1, 'House of Árpád'),
(2, 'House of Přemyslid'),
(3, 'House of Wittelsbach'),
(4, 'House of Anjou'),
(5, 'House of Luxembourg'),
(6, 'House of Habsburg'),
(7, 'House of Jagiellon'),
(8, 'House of Hunyadi'),
(9, 'House of Zápolya'),
(10, 'House of Habsburg–Lorraine');

--
-- Indices 
--
ALTER TABLE `reigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monarch_id` (`monarch_id`);

ALTER TABLE `monarchs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dyn_id` (`dyn_id`);

ALTER TABLE `dynasties`
  ADD PRIMARY KEY (`id`);

-- Constraints
--
ALTER TABLE `reigns`
  ADD CONSTRAINT `reigns_ibfk_1` FOREIGN KEY (`monarch_id`) REFERENCES `monarchs` (`id`);
--
ALTER TABLE `monarchs`
  ADD CONSTRAINT `monarch_ibfk_1` FOREIGN KEY (`dyn_id`) REFERENCES `dynasties` (`id`);
COMMIT;

