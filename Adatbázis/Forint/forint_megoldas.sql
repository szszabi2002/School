-- Active: 1706598324977@@127.0.0.1@3306@forint
/*1*/
CREATE DATABASE forint CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
/*3*/
ALTER TABLE akod ADD FOREIGN KEY (femid) REFERENCES anyag (femid);

ALTER TABLE erme ADD FOREIGN KEY (ermeid) REFERENCES akod (ermeid);

ALTER TABLE tkod ADD FOREIGN KEY (ermeid) REFERENCES erme (ermeid)

ALTER TABLE tkod
ADD FOREIGN KEY (tervezoid) REFERENCES tervezo (tid);

/*4*/
SELECT erme.cimlet, erme.tomeg
FROM akod
    INNER JOIN anyag ON akod.femid = anyag.femid
    INNER JOIN erme ON erme.ermeid = akod.ermeid
WHERE
    anyag.femnev = 'Ezüst'
    /*5*/
SELECT DISTINCT
    tervezo.nev
FROM tkod
    INNER JOIN tervezo ON tkod.tervezoid = tervezo.tid
    INNER JOIN erme ON tkod.ermeid = erme.ermeid
WHERE
    erme.bevonas IS NULL
    /*6*/
SELECT erme.cimlet, YEAR(erme.kiadas)
FROM erme
WHERE
    erme.bevonas IS NOT NULL
ORDER BY datediff(erme.kiadas, erme.bevonas)
LIMIT 1
    /*7*/

SELECT erme.cimlet, erme.tomeg * erme.darab / 1000 AS `Össztömeg (kg)`
FROM akod
    INNER JOIN anyag ON akod.femid = anyag.femid
    INNER JOIN erme ON erme.ermeid = akod.ermeid
ORDER BY erme.tomeg DESC
LIMIT 1
    /*8*/

SELECT tervezo.nev, COUNT(erme.ermeid) AS `Érmék száma`
FROM tkod
    INNER JOIN erme ON tkod.ermeid = erme.ermeid
    INNER JOIN tervezo ON tkod.tervezoid = tervezo.tid
GROUP BY
    tervezo.nev
ORDER BY `Érmék száma` DESC
    /*9*/

SELECT erme.cimlet, tervezo.nev, erme.kiadas
FROM tkod
    INNER JOIN erme ON tkod.ermeid = erme.ermeid
    INNER JOIN tervezo ON tkod.tervezoid = tervezo.tid
WHERE
    erme.kiadas <= '1999.12.31'
    AND (
        erme.bevonas >= '1996.01.01'
        OR erme.bevonas IS NULL
    )
    /*10*/

SELECT cimlet, kiadas
FROM tkod
    INNER JOIN erme ON tkod.ermeid = erme.ermeid
    INNER JOIN tervezo ON tkod.tervezoid = tervezo.tid
WHERE
    cimlet != 200
    AND nev = (
        SELECT tervezo.nev
        FROM tkod
            INNER JOIN erme ON tkod.ermeid = erme.ermeid
            INNER JOIN tervezo ON tkod.tervezoid = tervezo.tid
        WHERE
            erme.cimlet = 200
    )
    /*11*/

SELECT erme.cimlet, erme.kiadas
FROM akod
    INNER JOIN anyag ON akod.femid = anyag.femid
    INNER JOIN erme ON erme.ermeid = akod.ermeid
WHERE
    akod.femid != (
        SELECT femid
        FROM anyag
        WHERE
            anyag.femnev = 'Nikkel'
    )
ORDER BY 1
    /*Alternatív*/

SELECT erme.cimlet, erme.kiadas
FROM erme
WHERE ermeid NOT IN(
        SELECT akod.ermeid
        FROM anyag
            INNER JOIN akod ON akod.femid = anyag.femid
            INNER JOIN erme ON erme.ermeid = akod.ermeid
        WHERE
            anyag.femnev = 'Nikkel'
    )