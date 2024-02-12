-- Active: 1707118294076@@127.0.0.1@3306@mbt
/*1*/
CREATE DATABASE mbt
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;
/*3*/
ALTER TABLE kapcsolo
ADD FOREIGN KEY (telekid)
REFERENCES telek(id),
ADD FOREIGN KEY (nyersanyagid)
REFERENCES nyersanyag(id);
/*4*/
SELECT
  telek.telepules,
  telek.muvmod
FROM telek
WHERE telek.allapot = 'S'
ORDER BY telek.muvmod, telek.telepules

/*5*/
SELECT DISTINCT
  telek.telepules,
  nyersanyag.nev,
  telek.fedoszint,
  telek.fekuszint
FROM kapcsolo
  INNER JOIN telek
    ON kapcsolo.telekid = telek.id
  INNER JOIN nyersanyag
    ON kapcsolo.nyersanyagid = nyersanyag.id
WHERE telek.fedoszint <= 0
AND telek.fekuszint <= 0

/*6*/
SELECT DISTINCT
  telek.telepules,
  telek.fedoszint,
  telek.fekuszint
FROM kapcsolo
  INNER JOIN telek
    ON kapcsolo.telekid = telek.id
  INNER JOIN nyersanyag
    ON kapcsolo.nyersanyagid = nyersanyag.id
WHERE telek.allapot = 'M'
AND nyersanyag.nev LIKE '%dolomit%'

/*7*/
SELECT DISTINCT
  telek.telepules,
  telek.fedoszint - telek.fekuszint AS `ásványi nyersanyagréteg`,
  nyersanyag.nev
FROM kapcsolo
  INNER JOIN telek
    ON kapcsolo.telekid = telek.id
  INNER JOIN nyersanyag
    ON kapcsolo.nyersanyagid = nyersanyag.id
WHERE nyersanyag.nev LIKE '%kavics%'
ORDER BY `ásványi nyersanyagréteg` DESC
LIMIT 3

/*8*/
SELECT DISTINCT
  telek.telepules,
  nyersanyag.nev
FROM kapcsolo
  INNER JOIN telek
    ON kapcsolo.telekid = telek.id
  INNER JOIN nyersanyag
    ON kapcsolo.nyersanyagid = nyersanyag.id
WHERE telek.fedoszint BETWEEN 450 AND 550

/*9*/
SELECT DISTINCT
  nyersanyag.nev,
  COUNT(telek.telepules) AS db
FROM kapcsolo
  INNER JOIN telek
    ON kapcsolo.telekid = telek.id
  INNER JOIN nyersanyag
    ON kapcsolo.nyersanyagid = nyersanyag.id
GROUP BY nyersanyag.nev
ORDER BY db DESC
LIMIT 1

/*10*/
SELECT DISTINCT
  telek.telepules,
  telek.allapot
FROM kapcsolo
  INNER JOIN telek
    ON kapcsolo.telekid = telek.id
  INNER JOIN nyersanyag
    ON kapcsolo.nyersanyagid = nyersanyag.id
WHERE telek.allapot = 'B'
OR telek.allapot = 'T'
ORDER BY telek.telepules
