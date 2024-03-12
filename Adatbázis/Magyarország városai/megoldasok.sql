/*A feladatok megoldására elkészített SQL parancsokat illessze be a feladat sorszáma után!*/

/*1. feladat:*/
CREATE DATABASE varosok
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

/*2. feladat:*/
Use varosok

CREATE TABLE varostipus(
    id INT PRIMARY KEY,
    vtip VARCHAR(40)
);
CREATE TABLE megye(
    id INT PRIMARY KEY,
    mnev VARCHAR(40)
);
CREATE TABLE varos(
    id INT,
    vnev VARCHAR(40),
    vtipid INT,
    megyeid INT,
    jaras VARCHAR(20),
    kisterseg VARCHAR(20),
    nepesseg INT,
    terulet REAL,
    PRIMARY KEY (id, vtipid, megyeid)
);
ALTER TABLE varos ADD FOREIGN KEY (vtipid) REFERENCES varostipus(id);
ALTER TABLE varos ADD FOREIGN KEY (megyeid) REFERENCES megye(id);

/*3. feladat:*/
SELECT
  varos.vnev
FROM varos
WHERE varos.vnev LIKE '%vásár%'
/*4. feladat:*/
SELECT
  varos.vnev,
  varos.nepesseg,
  varos.terulet
FROM varos
WHERE varos.terulet > 400
ORDER BY varos.nepesseg DESC

/*5. feladat:*/
SELECT
  varos.vnev,
  varos.nepesseg
FROM varos
  INNER JOIN megye
    ON varos.megyeid = megye.id
WHERE varos.nepesseg > 15000
AND megye.mnev = 'Fejér'

/*6. feladat:*/
SELECT
  varostipus.vtip AS `Város típusa`,
  COUNT(varos.vtipid) AS `Városok száma`,
  SUM(varos.nepesseg) AS Népesség
FROM varos
  INNER JOIN megye
    ON varos.megyeid = megye.id
  INNER JOIN varostipus
    ON varos.vtipid = varostipus.id
WHERE varostipus.vtip NOT LIKE 'Főváros'
GROUP BY varostipus.vtip

/*7. feladat:*/
SELECT
  megye.mnev,
  COUNT(varos.id) AS db
FROM varos
  INNER JOIN megye
    ON varos.megyeid = megye.id
WHERE varos.jaras NOT LIKE varos.kisterseg
GROUP BY megye.mnev
HAVING COUNT(varos.id) > 8
ORDER BY db DESC