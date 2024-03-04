CREATE TABLE `etel` (
  `nev` varchar(29) DEFAULT NULL,
  `id` int(3) NOT NULL,
  `kategoriaid` int(1) DEFAULT NULL,
  `felirdatum` date DEFAULT NULL,
  `elsodatum` date DEFAULT NULL
);

CREATE TABLE `hasznalt` (
  `mennyiseg` double DEFAULT NULL,
  `egyseg` varchar(11) DEFAULT NULL,
  `etelid` int(3) DEFAULT NULL,
  `hozzavaloid` int(3) DEFAULT NULL
);

CREATE TABLE `hozzavalo` (
  `id` int(3) NOT NULL,
  `nev` varchar(28) DEFAULT NULL
);

CREATE TABLE `kategoria` (
  `id` int(1) NOT NULL,
  `nev` varchar(10) DEFAULT NULL
);

ALTER TABLE `etel`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `hozzavalo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `kategoria`
  ADD PRIMARY KEY (`id`);