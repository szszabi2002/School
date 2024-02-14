-- A feladatok megoldására elkészített SQL parancsokat illessze be a feladat sorszáma után!


-- 1. feladat:
CREATE DATABASE tenisz
CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

-- 3. feladat:
SELECT
  COUNT(*) AS visszalepes
FROM merkozes
  INNER JOIN jatekos
    ON merkozes.jatekos1Id = jatekos.id
WHERE merkozes.jatszma1 = -1
OR merkozes.jatszma2 = -1

-- 4. feladat:
SELECT
  MIN(merkozes.kezdes) AS legkorabban,
  MAX(merkozes.kezdes) AS legkesobben
FROM merkozes
  INNER JOIN jatekos
    ON merkozes.jatekos1Id = jatekos.id
WHERE merkozes.fordulo = 'd8'

-- 5. feladat:
SELECT
  m.datum,
  j1.orszagKod,
  j1.nev AS 'egyik jatekos',
  j2.nev AS 'masik jatekos'
FROM jatekos j1
  INNER JOIN merkozes m
    ON j1.id = m.jatekos1Id
  INNER JOIN jatekos j2
    ON m.jatekos2Id = j2.id
WHERE j1.orszagKod = j2.orszagKod
ORDER BY j1.orszagKod

-- 6. feladat:
SELECT DISTINCT
  jatekos.orszagKod,
  COUNT(jatekos.id) AS letszam
FROM jatekos
GROUP BY jatekos.orszagKod
ORDER BY 2 DESC

-- 7. feladat:
SELECT
  YEAR(merkozes.datum) AS evszam,
  COUNT(*) AS '2:0 vagy 0:2'
FROM merkozes
WHERE merkozes.jatszma1 = 0
AND merkozes.jatszma2 = 2
OR merkozes.jatszma1 = 2
AND merkozes.jatszma2 = 0
GROUP BY 1
ORDER BY 1 DESC
