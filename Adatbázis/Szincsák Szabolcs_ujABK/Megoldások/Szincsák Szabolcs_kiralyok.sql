/*2*/
SELECT uralkodo.nev, uralkodo.ragnev, uralkodo.szul
FROM kiralyok.uralkodo
ORDER BY uralkodo.szul

/*3*/
SELECT uralkodo.nev, hivatal.mettol, hivatal.meddig
FROM kiralyok.uralkodo
    INNER JOIN kiralyok.uralkodohaz ON uralkodo.uhaz_az = uralkodohaz.azon
    INNER JOIN kiralyok.hivatal ON hivatal.uralkodo_az = uralkodo.azon
WHERE
    uralkodohaz.nev LIKE "Árpád-ház"
ORDER BY 2

/*4*/
SELECT uralkodo.nev
FROM kiralyok.uralkodo
    INNER JOIN kiralyok.hivatal ON hivatal.uralkodo_az = uralkodo.azon
WHERE
    hivatal.koronazas < hivatal.mettol

/*5*/
SELECT COUNT(*)
FROM kiralyok.uralkodo
    INNER JOIN kiralyok.hivatal ON hivatal.uralkodo_az = uralkodo.azon
WHERE
    hivatal.mettol >= 1601
    AND hivatal.meddig <= 1700

/*6*/
SELECT uralkodo.nev, 
    (hivatal.meddig - hivatal.mettol) + 1
FROM kiralyok.uralkodo
    INNER JOIN kiralyok.hivatal ON hivatal.uralkodo_az = uralkodo.azon
ORDER BY 2 DESC
LIMIT 1

/*7*/
SELECT
  uralkodo.nev,
  hivatal.mettol - uralkodo.szul AS 'Uralkodási Év'
FROM kiralyok.uralkodo
  INNER JOIN kiralyok.hivatal
    ON hivatal.uralkodo_az = uralkodo.azon
HAVING `Uralkodási Év` < 15
ORDER BY 2 

/*8*/


/*9*/

