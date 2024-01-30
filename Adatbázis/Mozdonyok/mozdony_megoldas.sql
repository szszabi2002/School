-- Active: 1706598324977@@127.0.0.1@3306@mozdony_szsz
/*1*/
CREATE DATABASE mozdony_SzSz
COLLATE "utf8_hungarian_ci"

/*2*/
SELECT
  mozdony.Sorozat,
  mozdony.Psz,
  mozdony.Gyart_ev,
  mozdony.Allagba,
  mozdony.Tipus
FROM mozdony
WHERE mozdony.Tulaj = 'GySEV'
ORDER BY 4 DESC

/*3*/
UPDATE mozdony
set Gyarto = "Ganz MÁV"
WHERE mozdony.Gyarto = 'GANZ'

/*4*/
SELECT
  mozdony.Sorozat,
  mozdony.Gyarto,
  COUNT(*) AS db
FROM mozdony
GROUP BY mozdony.Sorozat,
         mozdony.Gyarto

/*5*/
SELECT Sorozat FROM mozdony WHERE Tipus IS NULL;
/*5.a*/
SELECT Sorozat FROM mozdony WHERE Tipus = ""

UPDATE mozdony SET Tipus = NULL
WHERE `Tipus` = ""

/*6*/
SELECT
  mozdony.Tulaj,
  mozdony.Gyart_ev,
  COUNT(mozdony.Gyart_ev) AS db
FROM mozdony
WHERE mozdony.Tulaj = "Máv"
GROUP BY mozdony.Gyart_ev
ORDER BY db DESC
LIMIT 1

/*7*/
SELECT
  mozdony.Sorozat,
  mozdony.Psz,
  Year(mozdony.Allagba) AS 'állagba vétel éve'
FROM mozdony
WHERE MONTH(Allagba) = 12 AND DAY(Allagba) = 31

/*a*/
SELECT
  mozdony.Sorozat,
  mozdony.Psz,
  Year(mozdony.Allagba) AS 'állagba vétel éve'
FROM mozdony
WHERE `Allagba` LIKE '%-12-31'
