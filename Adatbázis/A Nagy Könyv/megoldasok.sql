-- Active: 1706598324977@@127.0.0.1@3306@nagykonyv_szsz
-- A feladatok megoldására elkészített SQL parancsokat illessze be a feladat sorszáma után!


-- 1. feladat:
CREATE DATABASE nagykonyv_SzSz
CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

-- 3. feladat:
SELECT DISTINCT
  szerzo.nemzetiseg
FROM szerzo
WHERE NOT szerzo.nemzetiseg = 'Magyar'
--szerzo.nemzetiseg != 'Magyar'

-- 4. feladat:
SELECT
  szerzo.nev,
  2005 - szerzo.szulEv AS kor
FROM szerzo
WHERE szerzo.halEv IS NULL

-- 5. feladat:
SELECT
  szerzo.nev,
  MIN(konyv.helyezes) AS legjobb
FROM konyv
  INNER JOIN szerzo
    ON konyv.szerzoId = szerzo.id
WHERE szerzo.nemzetiseg = 'Magyar'
GROUP BY szerzo.nev --szerzo.id
ORDER BY 2

/*SELECT
  szerzo.nev,
  MIN(konyv.helyezes) AS legjobb
FROM konyv k
  INNER JOIN szerzo sz
    ON konyv.szerzoId = szerzo.id
WHERE szerzo.nemzetiseg = 'Magyar'
GROUP BY szerzo.nev --szerzo.id
ORDER BY 2*/

-- 6. feladat:
SELECT
  szerzo.nev,
  COUNT(konyv.cim) AS konyvek
FROM konyv
  INNER JOIN szerzo
    ON konyv.szerzoId = szerzo.id
GROUP BY szerzo.nev
ORDER BY konyvek DESC, szerzo.nev