/*2*/
SELECT
  uralkodo.nev,
  uralkodo.ragnev,
  uralkodo.szul
FROM kiralyok.uralkodo
ORDER BY uralkodo.szul


/*3*/
SELECT
  uralkodo.nev,
  hivatal.mettol,
  hivatal.meddig
FROM kiralyok.uralkodo
  INNER JOIN kiralyok.uralkodohaz
    ON uralkodo.uhaz_az = uralkodohaz.azon
  INNER JOIN kiralyok.hivatal
    ON hivatal.uralkodo_az = uralkodo.azon
WHERE uralkodohaz.nev LIKE "Árpád-ház"
ORDER BY 2


/*4*/
SELECT
  uralkodo.nev
FROM kiralyok.uralkodo
  INNER JOIN kiralyok.hivatal
    ON hivatal.uralkodo_az = uralkodo.azon
WHERE hivatal.koronazas < hivatal.mettol


/*5*/



/*6*/



/*7*/



/*8*/



/*9*/