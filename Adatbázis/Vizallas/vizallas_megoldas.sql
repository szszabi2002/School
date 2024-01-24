/*2*/
SELECT
  meres.varos,
  meres.vizallas
FROM meres
WHERE meres.datum = '2002-12-31'

/*3*/
SELECT
  meres.varos
FROM meres
GROUP BY meres.varos
ORDER BY 1

/*3. Más megoldás*/
SELECT DISTINCT
  meres.varos
FROM meres
ORDER BY 1

/*4*/
SELECT
  COUNT(*)
FROM meres
WHERE meres.folyo = "Tisza"
AND meres.vizallas > 900

/*5*/
SELECT
  meres.datum
FROM meres
WHERE meres.varos = 'Budapest'
ORDER BY meres.vizallas DESC
LIMIT 1

/*6*/
/*Part1*/
SELECT
  meres.datum
FROM meres
WHERE meres.vizallas = 928
/*Teljes*/
SELECT
    meres.varos,
    meres.vizallas
FROM
    meres
WHERE
    meres.datum = (
        SELECT
            meres.datum
        FROM
            meres
        WHERE
            meres.vizallas = 928
    )
    AND meres.folyo = 'Duna'
