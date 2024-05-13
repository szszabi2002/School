/*2*/
SELECT
  csapat.nev
FROM csapat
WHERE csapat.nev LIKE '#%'

/*3*/
SELECT
  feladatsor.nevado
FROM feladatsor
WHERE LENGTH(feladatsor.nevado) - LENGTH(REPLACE(feladatsor.nevado, ' ', '')) = 1

/*4*/
SELECT
  feladatsor.nevado
FROM feladatsor
WHERE MONTH(feladatsor.kituzes) >= 12
AND MONTH(feladatsor.hatarido) <= 1

/*5*/


/*6*/


/*7*/


/*8*/


/*9*/


/*10*/


/*11*/