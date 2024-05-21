/*2*/
SELECT csapat.nev
FROM csapat
WHERE
    csapat.nev LIKE  '#%'

/*3*/
SELECT feladatsor.nevado
FROM feladatsor
WHERE
    LENGTH(feladatsor.nevado) - LENGTH(
        REPLACE (feladatsor.nevado, ' ', '')
    ) = 1

/*4*/
SELECT feladatsor.nevado
FROM feladatsor
WHERE
    MONTH(feladatsor.kituzes) >= 12
    AND MONTH(feladatsor.hatarido) <= 1

/*5*/
SELECT csapat.nev, SUM(megoldas.pontszam) AS osszpont
FROM
    feladat
    INNER JOIN megoldas ON megoldas.feladatid = feladat.id
    INNER JOIN csapat ON megoldas.csapatid = csapat.id
GROUP BY
    csapat.nev
ORDER BY osszpont DESC

/*6*/
SELECT feladatsor.nevado, feladatsor.ag, SUM(feladat.pontszam) AS osszpontszam
FROM feladatsor
    JOIN feladat ON feladatsor.id = feladat.feladatsorid
GROUP BY
    feladatsor.id,
    feladatsor.nevado,
    feladatsor.ag
HAVING
    osszpontszam != 150

/*7*/
SELECT DISTINCT
    csapat.nev
FROM
    csapat
    JOIN megoldas ON csapat.id = megoldas.csapatid
    JOIN feladat ON megoldas.feladatid = feladat.id
WHERE
    megoldas.pontszam = feladat.pontszam

/*8*/
SELECT
    feladatsor.nevado,
    COUNT(*) AS nem_beadott_feladatok_szama
FROM feladatsor
    JOIN feladat ON feladatsor.id = feladat.feladatsorid
WHERE
    NOT EXISTS (
        SELECT *
        FROM megoldas
        WHERE
            megoldas.feladatid = feladat.id
            AND megoldas.csapatid = (
                SELECT id
                FROM csapat
                WHERE
                    nev = '#win'
            )
    )
GROUP BY
    feladatsor.id,
    feladatsor.nevado;

/*9*/
SELECT nevado
FROM feladatsor
WHERE
    ag = 'irodalom'
    AND MONTH(kituzes) = MONTH(hatarido)
    AND YEAR(kituzes) = YEAR(hatarido);

/*10*/
SELECT TOP 1 nevado
FROM feladatsor
ORDER BY DATEDIFF(hatarido, kituzes) ASC;

/*11*/
SELECT f1.nevado, f1.kituzes
FROM feladatsor f1
    JOIN feladatsor f2 ON DATEDIFF(f1.kituzes, f2.hatarido) = 1;

#Tárólt eljárás létrehozása
DELIMITER $$

CREATE PROCEDURE `kezdetuCsapat2`(IN elsoKarakter CHAR)
BEGIN
    SELECT csapat.nev 
    FROM csapat 
    WHERE csapat.nev LIKE CONCAT(elsoKarakter, '\#%');
END$$

DELIMITER ;

