/*A feladatok megoldására elkészített SQL parancsokat illessze be a feladat sorszáma után!*/

/*1. feladat:*/
CREATE DATABASE ostermelo
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

/*2. feladat:*/
USE ostermelo

CREATE TABLE ostermelo.gyumolcslevek (
  id INT(11) NOT NULL AUTO_INCREMENT,
  gynev VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)

CREATE TABLE ostermelo.partnerek (
  id INT(11) NOT NULL AUTO_INCREMENT,
  kontakt VARCHAR(255) DEFAULT NULL,
  telepules VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
)

CREATE TABLE ostermelo.kiszallitasok (
  sorsz INT(11) NOT NULL AUTO_INCREMENT,
  gyumleid INT(11) NOT NULL,
  partnerid INT(11) NOT NULL,
  datum DATE DEFAULT NULL,
  karton INT(11) DEFAULT NULL,
  PRIMARY KEY (sorsz, gyumleid, partnerid)
)

ALTER TABLE kiszallitasok 
  ADD CONSTRAINT FK_kiszallitasok_partnerek_id FOREIGN KEY (partnerid)
    REFERENCES partnerek(id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE kiszallitasok 
  ADD CONSTRAINT FK_kiszallitasok_gyumolcslevek_id FOREIGN KEY (gyumleid)
    REFERENCES gyumolcslevek(id) ON DELETE NO ACTION ON UPDATE NO ACTION;


/*3. feladat:*/
SELECT DISTINCT
  partnerek.telepules
FROM partnerek
ORDER BY partnerek.telepules
/*4. feladat:*/

SELECT DISTINCT
  partnerek.telepules,
  COUNT(kiszallitasok.karton) AS alkalmak
FROM kiszallitasok
  INNER JOIN partnerek
    ON kiszallitasok.partnerid = partnerek.id
WHERE partnerek.telepules = 'Vác'
GROUP BY partnerek.telepules
/*5. feladat:*/

/*6. feladat:*/

/*7. feladat:*/

