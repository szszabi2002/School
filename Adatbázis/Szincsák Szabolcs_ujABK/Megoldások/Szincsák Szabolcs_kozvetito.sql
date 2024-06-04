-- Active: 1706598324977@@127.0.0.1@3306@kozvetito
/*2*/
SELECT DISTINCT
  ingatlan.kozterulet
FROM ingatlan
ORDER BY ingatlan.kozterulet


/*3*/
SELECT
  ingatlan.hazszam,
  hirdetes.ar
FROM ingatlan
  INNER JOIN hirdetes
    ON hirdetes.ingatlanid = ingatlan.id
WHERE ingatlan.kozterulet LIKE "Agyagos utca"


/*4*/
SELECT
  ingatlan.kozterulet,
  hirdetes.ar * 1.5 
FROM ingatlan
  INNER JOIN hirdetes
    ON hirdetes.ingatlanid = ingatlan.id
WHERE YEAR(hirdetes.datum) = 2021
AND hirdetes.allapot LIKE "eladva"


/*5*/
SELECT
  ROUND(MAX(hirdetes.ar) / MIN(hirdetes.ar))
FROM hirdetes
WHERE hirdetes.allapot LIKE "meghirdetve"


/*6*/
SELECT DISTINCT
  ingatlan.kozterulet, 
  ingatlan.hazszam, 
  hirdetes.datum
FROM helyiseg
  INNER JOIN ingatlan
    ON helyiseg.ingatlanid = ingatlan.id
  INNER JOIN hirdetes
    ON hirdetes.ingatlanid = ingatlan.id
WHERE hirdetes.datum = (
    SELECT MIN(datum)
    FROM hirdetes
    WHERE allapot = 'meghirdetve'
    GROUP BY ingatlanid
    HAVING COUNT(*) = 1
    LIMIT 1
)



/*7*/
SELECT 
    ingatlan.kozterulet, 
    ingatlan.hazszam,
    hirdetes.ar
FROM ingatlan
    INNER JOIN hirdetes ON hirdetes.ingatlanid = ingatlan.id
WHERE
    hirdetes.id IN (
        SELECT MAX(id)
        FROM hirdetes
        GROUP BY
            ingatlanid
        HAVING
            COUNT(
                CASE
                    WHEN allapot = 'eladva' THEN 1
                END
            ) = 1
            AND MAX(
                CASE
                    WHEN allapot = 'meghirdetve' THEN ar
                END
            ) = MAX(
                CASE
                    WHEN allapot = 'eladva' THEN ar
                END
            )
    );


/*8*/
SELECT
    kozterulet,
    hazszam
FROM
    ingatlan
WHERE
    id NOT IN (
        SELECT
            id
        FROM
            helyiseg
        WHERE
            funkcio LIKE "WC"
    )
    AND id NOT IN (
        SELECT
            id
        FROM
            helyiseg
        WHERE
            funkcio LIKE "konyha"
    );


/*9*/