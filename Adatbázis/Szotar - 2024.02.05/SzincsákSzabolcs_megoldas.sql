-- Active: 1707118294076@@127.0.0.1@3306@szotar
/*1.*/
CREATE DATABASE szotar CHARACTER SET utf8 COLLATE utf8_hungarian_ci;

/*2*/
SELECT szolista.angol, szolista.magyar
FROM szolista
WHERE
    szolista.helyes >= 150
    OR szolista.helytelen <= 5
    /*3*/

SELECT szolista.angol, szolista.magyar
FROM szolista
WHERE
    szolista.angol SOUNDS LIKE szolista.magyar
    /*4*/

SELECT `angol`, AVG(`helyes` + `helytelen`)
FROM `szolista`
WHERE
    `angol` LIKE 'a%'
GROUP BY
    `angol`;
/*5.*/
SELECT `angol`, `felvetel`
FROM `szolista`
WHERE
    `angol` LIKE 'warp'
ORDER BY 2
LIMIT 1;
/*6.*/
SELECT szolista.angol, szolista.magyar
FROM szolista
WHERE
    szolista.angol SOUNDS LIKE szolista.magyar
/*7. Csak lekérdezés!!!*/
SELECT `angol`, `magyar`
FROM `szolista`
WHERE (`helyes` - `helytelen`) > 100;