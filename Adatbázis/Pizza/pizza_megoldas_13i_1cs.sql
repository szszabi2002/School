-- Active: 1706598324977@@127.0.0.1@3306@pizza_13i_2cs
/*Adatbázis létrehozása*/
CREATE DATABASE pizza_13_2cs DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;

/*Kapcsolatok létrehozása - DDL*/
ALTER TABLE rendeles ADD FOREIGN KEY (fazon) REFERENCES futar (fazon);

ALTER TABLE rendeles ADD FOREIGN KEY (vazon) REFERENCES vevo (vazon);

/*vagy*/
ALTER TABLE rendeles
ADD FOREIGN KEY (fazon) REFERENCES futar (fazon),
ADD FOREIGN KEY (vazon) REFERENCES vevo (vazon);

ALTER TABLE tetel
ADD FOREIGN KEY (razon) REFERENCES rendeles (razon),
ADD FOREIGN KEY (pazon) REFERENCES pizza (pazon);

/*Lekérdezések*/

/* 1.	Hogy hívják az egyes pizzafutárokat?*/
SELECT DISTINCT fnev FROM futar;

/* 2.	Milyen pizzák közül lehet rendelni, és mennyibe kerülnek?*/
SELECT pnev, par FROM pizza
/* 3.	Mennyibe kerül átlagosan egy pizza?*/
SELECT AVG(pizza.par) FROM pizza
/* 4.	Mely pizzák olcsóbbak 1000 Ft-nál?*/
SELECT pnev FROM pizza WHERE par < 1000
/* 5.	Ki szállította házhoz az első (egyes sorszámú) rendelést?*/
SELECT futar.fnev
FROM rendeles
    INNER JOIN futar ON rendeles.fazon = futar.fazon
WHERE
    rendeles.razon = 1
/* 6.	Kik rendeltek pizzát délelőtt?*/
SELECT vevo.vnev
FROM rendeles
    INNER JOIN vevo ON rendeles.vazon = vevo.vazon
WHERE
    rendeles.ido <= '12:00:00'
/* 7.	Milyen pizzákat evett Szundi? */
SELECT DISTINCT
    pizza.pnev
FROM
    rendeles
    INNER JOIN vevo ON rendeles.vazon = vevo.vazon
    INNER JOIN tetel ON tetel.razon = rendeles.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
WHERE
    vevo.vnev = 'Szundi'
/* 8.	Ki szállított házhoz Tudornak? */
SELECT futar.fnev
FROM rendeles
    INNER JOIN futar ON rendeles.fazon = futar.fazon
    INNER JOIN vevo ON rendeles.vazon = vevo.vazon
WHERE
    vevo.vnev = 'Tudor'
/* 9.	Az egyes rendelések alkalmával, ki kinek szállított házhoz?*/
SELECT futar.fnev, vevo.vnev
FROM rendeles
    INNER JOIN futar ON rendeles.fazon = futar.fazon
    INNER JOIN vevo ON rendeles.vazon = vevo.vazon
GROUP BY
    vevo.vnev,
    futar.fnev
/*10.	Mennyit költött pizzára Morgó?*/
select SUM(par * db)
from rendeles
    inner join pizza_13i_2cs.vevo v on rendeles.vazon = v.vazon
    inner join pizza_13i_2cs.tetel t on rendeles.razon = t.razon
    inner join pizza_13i_2cs.pizza p on t.pazon = p.pazon
WHERE
    vnev = 'Morgó'
/*11.	Hány alkalommal rendelt Sorrento pizzát Vidor?*/
SELECT COUNT(*) AS alkalom
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
    INNER JOIN pizza ON tetel.pazon = pizza.pazon
WHERE
    vnev = 'Vidor'
    AND pnev = 'Sorrento';

/*12.	Hány pizzát evett Hapci? */
SELECT SUM(db)
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
    INNER JOIN tetel ON rendeles.razon = tetel.razon
WHERE 
    vnev = 'Hapci';

/*13.	Hányszor rendelt pizzát Szende?*/
SELECT COUNT(*)
FROM
    vevo
    INNER JOIN rendeles ON vevo.vazon = rendeles.vazon
WHERE 
    vnev = 'Szende';

/*14.	Hány darab Hawaii pizza fogyott összesen?*/
SELECT
  COUNT(tetel.db) AS 'Hawaii pizza db'
FROM tetel
  INNER JOIN pizza
    ON tetel.pazon = pizza.pazon
WHERE pizza.pnev = 'Hawaii'

/*Helyes*/
SELECT
  pizza.pnev,
  IFNULL(SUM(tetel.db),0) AS 'Hawaii pizza db'
FROM tetel
  RIGHT OUTER JOIN pizza
    ON tetel.pazon = pizza.pazon
WHERE pizza.pnev = 'Hawaii'
GROUP BY pizza.pnev