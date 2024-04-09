-- Active: 1706598324977@@127.0.0.1@3306@hamburger_13i_2cs
/*10*/
CREATE DATABASE hamburger
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

/*12*/
SELECT
  menutetel.*
FROM menutetel
WHERE menutetel.ar = 2500

/*13*/
UPDATE menutetel
  SET ar = 2300
WHERE menutetel.nev = 'Grill pizza 32cm'

/*14*/
SELECT
  felhasznalo.nev AS vendeg_nev,
  COUNT(rendeles.id) AS rendeles_db
FROM rendeles
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN rendeleselem
    ON rendeleselem.rendelesId = rendeles.id
GROUP BY felhasznalo.nev
ORDER BY rendeles_db DESC
LIMIT 9

/*15*/
INSERT INTO menutetel (nev, ar, etelkatId)
VALUES ("Boston Tészta", 2200, 3)

/*16*/
SELECT
  rendeles.id AS "rendeles_azon",
  rendeleselem.id AS "rendelesem_azon",
  menutetel.nev AS "menutetel_nev"
FROM rendeles
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN rendeleselem
    ON rendeleselem.rendelesId = rendeles.id
    INNER JOIN menutetel
    ON rendeleselem.menutetelId = menutetel.id
WHERE felhasznalo.nev = "Balázs Flóra"

/*17*/
SELECT
  felhasznalo.nev AS "felhasznalo_nev",
  SUM((rendeleselem.mennyiseg * menutetel.ar)+ (rendeleselem.mennyiseg * menutetel.ar)*0.10) AS "osszesen"
FROM rendeles
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN rendeleselem
    ON rendeleselem.rendelesId = rendeles.id
INNER JOIN menutetel
ON rendeleselem.menutetelId = menutetel.id
GROUP BY felhasznalo.nev
ORDER BY 2 DESC
LIMIT 1