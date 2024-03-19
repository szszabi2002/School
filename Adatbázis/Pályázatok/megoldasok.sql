-- A feladatok megoldására elkészített SQL parancsokat illessze be a feladat sorszáma után!


-- 1. feladat:
CREATE DATABASE palyazatok
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

-- 3. feladat:
ALTER TABLE szamla 
  ADD CONSTRAINT FK_szamla_palyazat_id FOREIGN KEY (palyazatId)
    REFERENCES palyazat(id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE szamla 
  ADD CONSTRAINT FK_szamla_koltsegtipus_id FOREIGN KEY (koltsegtipusId)
    REFERENCES koltsegtipus(id) ON DELETE NO ACTION ON UPDATE NO ACTION;

-- 4. feladat:
UPDATE szamla
 SET szamla.koltsegtipusId = 'A8'
WHERE szamla.id = 512

-- 5. feladat:
INSERT INTO koltsegtipus VALUE ('A10','Humánerőforrás-fejlesztés')

-- 6. feladat:
SELECT
  *
FROM szamla
WHERE szamla.koltsegtipusId = 'C1'
AND szamla.ertek > 100000

-- 7. feladat:
SELECT
  szamla.szamlaszam,
  szamla.datum,
  szamla.ertek
FROM szamla
WHERE szamla.koltsegtipusId = 'A7'
ORDER BY szamla.ertek DESC
LIMIT 5

-- 8. feladat:
SELECT
  koltsegtipus.megnevezes,
  SUM(szamla.ertek) AS `elszamolt osszeg`,
  COUNT(szamla.koltsegtipusId) AS `szamlak szama`
FROM szamla
  INNER JOIN koltsegtipus
    ON szamla.koltsegtipusId = koltsegtipus.id
GROUP BY koltsegtipus.megnevezes
ORDER BY `elszamolt osszeg` DESC

-- 9. feladat:
SELECT
  palyazat.id AS palyazat,
  palyazat.tervezetA + palyazat.tervezetC AS keret,
  SUM(szamla.ertek) / (palyazat.tervezetA + palyazat.tervezetC) * 100 AS allapot
FROM szamla
  INNER JOIN palyazat
    ON szamla.palyazatId = palyazat.id
GROUP BY szamla.palyazatId