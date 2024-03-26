/*A feladatok megoldására elkészített SQL parancsokat illessze be a feladat sorszáma után!*/

/*1. feladat:*/
CREATE DATABASE papirgyujtes_13.I_gy2
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

/*3. feladat:*/
SELECT
  tanulok.nev,
  tanulok.osztaly,
  leadasok.idopont,
  leadasok.mennyiseg
FROM leadasok
  INNER JOIN tanulok
    ON leadasok.tanulo = tanulok.tazon
WHERE tanulok.osztaly LIKE '1%'
/*4. feladat:*/
SELECT
  leadasok.idopont,
  AVG(leadasok.mennyiseg) AS `napi atlag`
FROM leadasok
GROUP BY leadasok.idopont
/*5. feladat:*/
SELECT DISTINCT
  tanulok.osztaly
FROM leadasok
  INNER JOIN tanulok
    ON leadasok.tanulo = tanulok.tazon
WHERE leadasok.idopont = '2016.10.28'
ORDER BY tanulok.osztaly
/*6. feladat:*/
SELECT
  tanulok.osztaly,
  SUM(leadasok.mennyiseg)/10000 AS mazsa
FROM leadasok
  INNER JOIN tanulok
    ON leadasok.tanulo = tanulok.tazon
GROUP BY tanulok.osztaly
ORDER BY 2 DESC
/*7. feladat:*/
SELECT
  tanulok.nev,
  tanulok.osztaly,
  SUM(leadasok.mennyiseg) AS osszesen
FROM leadasok
  INNER JOIN tanulok
    ON leadasok.tanulo = tanulok.tazon
GROUP BY tanulok.nev
ORDER BY osszesen DESC
LIMIT 10
