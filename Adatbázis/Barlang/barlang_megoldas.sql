/*2.Feladat*/
SELECT
  barlang.nev
FROM barlang
WHERE barlang.melyseg > 100
ORDER BY barlang.nev

/*2. mélység is és a szerinti rendezve*/
SELECT
  barlang.nev
FROM barlang
WHERE barlang.melyseg > 100
ORDER BY 2 ASC 

/*3*/
SELECT
  barlang.nev
FROM barlang
WHERE barlang.nev LIKE "%lyuk%"
OR barlang.nev LIKE "%zsomboly%"
OR barlang.nev LIKE "%lik%"
ORDER BY barlang.nev 

/*Listázzuk ki az 'A' kezdőbetűs barlang*/
SELECT
  barlang.nev
FROM barlang
WHERE barlang.nev LIKE "a%"

/*Melyik barlangba van leglább 4 db 'A' betű*/
SELECT
  barlang.nev
FROM barlang
WHERE barlang.nev LIKE "%a%a%a%a%"

/*Melyik barlang nevébe nem szerepel a "barlng szó"*/
SELECT
  barlang.nev
FROM barlang
WHERE barlang.nev NOT LIKE "%barlang%"

/*4*/
SELECT
  barlang.telepules AS Telepűlés,
  COUNT(barlang.nev) AS "Barlangok száma"
FROM barlang
GROUP BY barlang.telepules
ORDER BY DB DESC

/*4. Bonus*/
SELECT
  barlang.telepules AS Telepűlés,
  COUNT(barlang.nev) AS `Barlangok száma`
FROM barlang
GROUP BY barlang.telepules
HAVING COUNT(barlang.nev) > 10
ORDER BY 2 DESC

/*5*/
SELECT
  barlang.nev,
  barlang.hossz
FROM barlang
ORDER BY barlang.hossz DESC
LIMIT 1

/*6 nem teljesen jó*/
SELECT barlang.nev FROM barlang 
WHERE telepules = 'Miskolc' AND 
nev != 'Fecske-lyuk'

/*6*/
SELECT
    barlang.nev
FROM
    barlang
WHERE
    telepules = (
        SELECT
            telepules
        FROM
            barlang
        WHERE
            nev = 'Fecske-lyuk'
    )
    AND nev != 'Fecske-lyuk'
/*7*/
SELECT
  barlang.nev,
  (barlang.melyseg - barlang.magassag)
FROM barlang
WHERE barlang.melyseg <> 0
AND ABS(barlang.melyseg - barlang.magassag) <= 1