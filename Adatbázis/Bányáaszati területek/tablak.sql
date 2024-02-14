CREATE TABLE `kapcsolo` (
  `telekid` int(4) NOT NULL,
  `nyersanyagid` int(2) NOT NULL
);

CREATE TABLE `nyersanyag` (
  `id` int(2) NOT NULL,
  `nev` varchar(26) DEFAULT NULL
);

CREATE TABLE `telek` (
  `id` int(4) NOT NULL,
  `telepules` varchar(20) DEFAULT NULL,
  `muvmod` varchar(24) DEFAULT NULL,
  `allapot` varchar(1) DEFAULT NULL,
  `fedoszint` double DEFAULT NULL,
  `fekuszint` double DEFAULT NULL
);