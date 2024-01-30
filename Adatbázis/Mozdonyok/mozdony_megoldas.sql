/*1*/
CREATE DATABASE mozdony_SzSz
COLLATE "utf8_hungarian_ci"

/*2*/
SELECT
  mozdony.Sorozat,
  mozdony.Psz,
  mozdony.Gyart_ev,
  mozdony.Allagba,
  mozdony.Tipus
FROM mozdony
WHERE mozdony.Tulaj = 'GySEV'
ORDER BY 4 DESC

/*3*/
UPDATE mozdony
set Gyarto = "Ganz MÁV"
WHERE mozdony.Gyarto = 'GANZ'

/*4*/
SELECT
  mozdony.Sorozat,
  mozdony.Gyarto,
  COUNT(*) AS db
FROM mozdony
GROUP BY mozdony.Sorozat,
         mozdony.Gyarto