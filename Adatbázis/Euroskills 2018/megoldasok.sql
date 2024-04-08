-- A feladatok megoldására elkészített SQL parancsokat illessze be a feladat sorszáma után!


-- 1. feladat:
CREATE DATABASE euroskills
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

-- 3. feladat:
SELECT
  COUNT(versenyzo.pont) AS ermek
FROM versenyzo
WHERE versenyzo.pont >= 700

-- 4. feladat:
SELECT DISTINCT
  orszag.orszagNev
FROM versenyzo
  INNER JOIN orszag
    ON versenyzo.orszagId = orszag.id
WHERE versenyzo.szakmaId = versenyzo.orszagId = 'HU'
ORDER BY orszag.orszagNev

-- 5. feladat:
SELECT
  szakma.szakmaNev,
  COUNT(versenyzo.szakmaId) AS `versenyzok szama`
FROM versenyzo
  INNER JOIN szakma
    ON versenyzo.szakmaId = szakma.id
GROUP BY szakma.szakmaNev
ORDER BY `versenyzok szama` DESC

-- 6. feladat:
SELECT
  versenyzo.nev,
  orszag.orszagNev,
  szakma.szakmaNev,
  versenyzo.pont
FROM versenyzo
  INNER JOIN orszag
    ON versenyzo.orszagId = orszag.id
  INNER JOIN szakma
    ON versenyzo.szakmaId = szakma.id
ORDER BY versenyzo.pont DESC, versenyzo.nev
LIMIT 25
