--A feladatok megoldására elkészített SQL parancsokat illessze be a feladat sorszáma után!

--1. feladat:
CREATE DATABASE beiskolazas CHARACTER SET utf8 COLLATE utf8_hungarian_ci;

--3. feladat:
ALTER TABLE `jelentkezesek`
ADD FOREIGN KEY (`tag`) REFERENCES `tagozatok` (`akod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `jelentkezesek`
ADD FOREIGN KEY (`diak`) REFERENCES `diakok` (`oktazon`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--4. feladat:

--5. feladat:
SELECT
  diakok.nev
FROM diakok
WHERE diakok.hozott >= 40
AND diakok.kpmagy + diakok.kpmat = 100
ORDER BY diakok.nev
--6. feladat:
SELECT
    t.agazat,
    COUNT(*) AS jelentkezoszam,
    MAX(d.hozott) - MIN(d.hozott) AS terjedelem
FROM
    diakok d
    INNER JOIN jelentkezesek j ON d.oktazon = j.diak
    INNER JOIN tagozatok t ON t.akod = j.tag
WHERE
    t.nyek = TRUE
    AND j.hely = 1
GROUP BY
    t.agazat
ORDER BY 2 DESC
--7. feladat: