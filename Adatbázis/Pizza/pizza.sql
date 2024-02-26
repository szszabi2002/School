-- phpMyAdmin SQL
-- version 2.6.1-pl3
-- http://www.phpmyadmin.net
-- PHP Verzió: 4.4.1




--   * * * * * * * * * * * * * * * * * * * * * * *
--   *                                           *
--   *   A fájl karakterkészlete: latin2  !!!    *
--   *                                           *
--   *   EZT MUSZÁJ MANUÁLISAN BEÁLLÍTANI !!!    *
--   *                                           *
--   * * * * * * * * * * * * * * * * * * * * * * *


-- 
-- Tábla szerkezet: `pfutar`
-- 

CREATE TABLE `pfutar` (
  `fazon` int(3) NOT NULL default '0',
  `fnev` varchar(25) collate latin2_hungarian_ci NOT NULL default '',
  `ftel` varchar(12) collate latin2_hungarian_ci NOT NULL default '',
  PRIMARY KEY  (`fazon`)
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

-- 
-- Tábla adatok: `pfutar`
-- 

INSERT INTO `pfutar` VALUES (1, 'Hurrikán', '123456');
INSERT INTO `pfutar` VALUES (2, 'Gyalogkakukk', '666666');
INSERT INTO `pfutar` VALUES (3, 'Gömbvillám', '888888');
INSERT INTO `pfutar` VALUES (4, 'Szélvész', '258369');
INSERT INTO `pfutar` VALUES (5, 'Imperial', '987654');

-- --------------------------------------------------------

-- 
-- Tábla szerkezet: `ppizza`
-- 

CREATE TABLE `ppizza` (
  `pazon` int(3) NOT NULL default '0',
  `pnev` varchar(15) collate latin2_hungarian_ci NOT NULL default '',
  `par` int(4) NOT NULL default '0',
  PRIMARY KEY  (`pazon`)
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

-- 
-- Tábla adatok: `ppizza`
-- 

INSERT INTO `ppizza` VALUES (1, 'Capricciosa', 900);
INSERT INTO `ppizza` VALUES (2, 'Frutti di Mare', 1100);
INSERT INTO `ppizza` VALUES (3, 'Hawaii', 780);
INSERT INTO `ppizza` VALUES (4, 'Vesuvio', 890);
INSERT INTO `ppizza` VALUES (5, 'Sorrento', 990);

-- --------------------------------------------------------

-- 
-- Tábla szerkezet: `prendeles`
-- 

CREATE TABLE `prendeles` (
  `razon` int(8) NOT NULL default '0',
  `vazon` int(6) NOT NULL default '0',
  `fazon` int(3) NOT NULL default '0',
  `datum` date DEFAULT NULL,
  `ido` VARCHAR(5),
  PRIMARY KEY  (`razon`)
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

-- 
-- Tábla adatok: `prendeles`
-- 

INSERT INTO `prendeles` VALUES ( 1, 4, 2, '2010-10-01', 13.15);
INSERT INTO `prendeles` VALUES ( 2, 7, 2, '2010-10-01', 14.17);
INSERT INTO `prendeles` VALUES ( 3, 1, 1, '2010-10-02', 11.07);
INSERT INTO `prendeles` VALUES ( 4, 5, 2, '2010-10-02', 14.55);
INSERT INTO `prendeles` VALUES ( 5, 2, 3, '2010-10-02', 15.27);
INSERT INTO `prendeles` VALUES ( 6, 4, 2, '2010-10-03', 15.58);
INSERT INTO `prendeles` VALUES ( 7, 6, 2, '2010-10-04', 11.44);
INSERT INTO `prendeles` VALUES ( 8, 7, 4, '2010-10-04', 12.11);
INSERT INTO `prendeles` VALUES ( 9, 1, 5, '2010-10-04', 14.33);
INSERT INTO `prendeles` VALUES (10, 3, 5, '2010-10-04', 18.04);
INSERT INTO `prendeles` VALUES (11, 2, 1, '2010-10-05', 16.38);
INSERT INTO `prendeles` VALUES (12, 5, 2, '2010-10-05', 17.02);
INSERT INTO `prendeles` VALUES (13, 6, 2, '2010-10-06', 12.17);
INSERT INTO `prendeles` VALUES (14, 4, 3, '2010-10-06', 13.21);
INSERT INTO `prendeles` VALUES (15, 1, 4, '2010-10-06', 15.05);
INSERT INTO `prendeles` VALUES (16, 2, 5, '2010-10-06', 15.59);
INSERT INTO `prendeles` VALUES (17, 7, 2, '2010-10-06', 18.44);
INSERT INTO `prendeles` VALUES (18, 3, 2, '2010-10-07', 12.01);
INSERT INTO `prendeles` VALUES (19, 4, 5, '2010-10-07', 13.44);
INSERT INTO `prendeles` VALUES (20, 1, 1, '2010-10-07', 17.25);
INSERT INTO `prendeles` VALUES (21, 5, 3, '2010-10-08', 14.29);

-- --------------------------------------------------------

-- 
-- Tábla szerkezet: `ptetel`
-- 

CREATE TABLE `ptetel` (
  `razon` int(8) NOT NULL default '0',
  `pazon` int(3) NOT NULL default '0',
  `db` int(3) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

-- 
-- Tábla adatok: `ptetel`
-- 

INSERT INTO `ptetel` VALUES ( 1, 1, 2);
INSERT INTO `ptetel` VALUES ( 1, 4, 3);
INSERT INTO `ptetel` VALUES ( 2, 2, 1);
INSERT INTO `ptetel` VALUES ( 3, 1, 2);
INSERT INTO `ptetel` VALUES ( 4, 1, 1);
INSERT INTO `ptetel` VALUES ( 4, 4, 1);
INSERT INTO `ptetel` VALUES ( 5, 2, 4);
INSERT INTO `ptetel` VALUES ( 6, 1, 1);
INSERT INTO `ptetel` VALUES ( 6, 4, 1);
INSERT INTO `ptetel` VALUES ( 6, 5, 1);
INSERT INTO `ptetel` VALUES ( 7, 5, 5);
INSERT INTO `ptetel` VALUES ( 8, 4, 3);
INSERT INTO `ptetel` VALUES ( 9, 2, 1);
INSERT INTO `ptetel` VALUES (10, 1, 1);
INSERT INTO `ptetel` VALUES (10, 4, 1);
INSERT INTO `ptetel` VALUES (11, 1, 1);
INSERT INTO `ptetel` VALUES (12, 2, 2);
INSERT INTO `ptetel` VALUES (12, 4, 2);
INSERT INTO `ptetel` VALUES (13, 4, 1);
INSERT INTO `ptetel` VALUES (13, 5, 1);
INSERT INTO `ptetel` VALUES (13, 2, 1);
INSERT INTO `ptetel` VALUES (14, 2, 2);
INSERT INTO `ptetel` VALUES (15, 1, 1);
INSERT INTO `ptetel` VALUES (16, 2, 1);
INSERT INTO `ptetel` VALUES (16, 4, 1);
INSERT INTO `ptetel` VALUES (16, 5, 1);
INSERT INTO `ptetel` VALUES (17, 1, 2);
INSERT INTO `ptetel` VALUES (17, 2, 3);
INSERT INTO `ptetel` VALUES (18, 1, 4);
INSERT INTO `ptetel` VALUES (18, 5, 1);
INSERT INTO `ptetel` VALUES (19, 1, 1);
INSERT INTO `ptetel` VALUES (19, 2, 1);
INSERT INTO `ptetel` VALUES (19, 4, 1);
INSERT INTO `ptetel` VALUES (19, 5, 1);
INSERT INTO `ptetel` VALUES (20, 5, 3);
INSERT INTO `ptetel` VALUES (21, 2, 2);
INSERT INTO `ptetel` VALUES (21, 4, 1);

-- --------------------------------------------------------

-- 
-- Tábla szerkezet: `pvevo`
-- 

CREATE TABLE `pvevo` (
  `vazon` int(6) NOT NULL default '0',
  `vnev` varchar(30) collate latin2_hungarian_ci NOT NULL default '',
  `vcim` varchar(30) collate latin2_hungarian_ci NOT NULL default '',
  PRIMARY KEY  (`vazon`)
) ENGINE=MyISAM DEFAULT CHARSET=latin2 COLLATE=latin2_hungarian_ci;

-- 
-- Tábla adatok: `pvevo`
-- 

INSERT INTO `pvevo` VALUES (1, 'Hapci', '');
INSERT INTO `pvevo` VALUES (2, 'Vidor', '');
INSERT INTO `pvevo` VALUES (3, 'Tudor', '');
INSERT INTO `pvevo` VALUES (4, 'Kuka', '');
INSERT INTO `pvevo` VALUES (5, 'Szende', '');
INSERT INTO `pvevo` VALUES (6, 'Szundi', '');
INSERT INTO `pvevo` VALUES (7, 'Morgó', '');
        