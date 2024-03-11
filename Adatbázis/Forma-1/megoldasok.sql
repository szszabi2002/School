-- Active: 1707118294076@@127.0.0.1@3306@forma1_13i_gy2
/*A feladatok megoldására elkészített SQL parancsokat illessze be a feladat sorszáma után!*/
/*1. feladat:*/
CREATE DATABASE forma1_13I_gy2 DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;

/*3. feladat:*/
CREATE INDEX pilotaIndex ON pilotak (pnev)
/*4. feladat:*/
ALTER TABLE pilotak
ADD FOREIGN KEY (csapat) REFERENCES csapatok (csazon);

ALTER TABLE eredmenyek
ADD FOREIGN KEY (pilota) REFERENCES pilotak (pazon)
ADD FOREIGN KEY (nagydij) REFERENCES versenyek (vkod)
/*5. feladat:*/
DELETE FROM versenyek WHERE vnev = 'Német Nagydíj'
/*6. feladat:*/
UPDATE versenyek
SET
    hely = 'Sao Paulo'
WHERE
    vnev = 'Brazil Nagydíj'
/*7. feladat:*/
SELECT pnev, COUNT(*) AS 'gyozelmek'
FROM pilotak
    INNER JOIN eredmenyek ON pilotak.pazon = eredmenyek.pilota
WHERE
    celpoz = 1
GROUP BY
    pnev
/*8. feladat:*/
SELECT vnev, kor * hossz / 1000 as tav FROM versenyek ORDER BY 2 DESC
/*9. feladat:*/

SELECT pnev, szev, csnev, MIN(celpoz) AS legjobb
FROM pilotak
    INNER JOIN csapatok ON csazon = csapat
    INNER JOIN eredmenyek ON pazon = pilota
GROUP BY pilota
ORDER BY 2 DESC
LIMIT 3