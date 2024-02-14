/*1. feladat*/
CREATE DATABASE mbt
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

/*3. feladat*/
ALTER TABLE kapcsolo
ADD FOREIGN KEY (telekid)
REFERENCES telek(id),
ADD FOREIGN KEY (nyersanyagid)
REFERENCES nyersanyag(id);

/*4. feladat*/
SELECT telepules, muvmod FROM telek
WHERE allapot = 'S'
ORDER BY muvmod, telepules;

/*5. feladat*/
SELECT DISTINCT nev FROM
telek INNER JOIN kapcsolo
ON telek.id = kapcsolo.telekid
INNER JOIN nyersanyag
ON kapcsolo.nyersanyagid = nyersanyag.id
WHERE fedoszint < 0 AND fekuszint < 0;

/*6. feladat*/
SELECT telepules, fedoszint, fekuszint FROM
telek INNER JOIN kapcsolo
ON telek.id = kapcsolo.telekid
INNER JOIN nyersanyag
ON kapcsolo.nyersanyagid = nyersanyag.id
WHERE nev LIKE '%dolomit%';
/*7. feladat*/
SELECT telepules, nev,
 fedoszint-fekuszint as 'vastagsag'
FROM
telek INNER JOIN kapcsolo
ON telek.id = kapcsolo.telekid
INNER JOIN nyersanyag
ON kapcsolo.nyersanyagid = nyersanyag.id
ORDER BY vastagsag DESC
LIMIT 3;

/*8. feladat*/
SELECT telepules, nev FROM
telek INNER JOIN kapcsolo
ON telek.id = kapcsolo.telekid
INNER JOIN nyersanyag
ON kapcsolo.nyersanyagid = nyersanyag.id
WHERE fedoszint >= 450 AND fekuszint <= 550;

/*9. feladat*/
SELECT  nev, COUNT(telekid) as 'db' FROM
kapcsolo INNER JOIN nyersanyag
ON kapcsolo.nyersanyagid = nyersanyag.id
GROUP BY nyersanyag.id
ORDER BY db DESC
LIMIT 1;

/*10. feladat*/
SELECT DISTINCT telepules FROM telek
WHERE telepules NOT IN 
SELECT DISTINCT telepules FROM telek
WHERE allapot != 'B';


/*Hol van nem bezárt bánya?*/
SELECT DISTINCT telepules FROM telek
WHERE allapot != 'B';




