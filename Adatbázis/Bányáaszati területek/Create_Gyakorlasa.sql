CREATE DATABASE banyaaszatiteruletek
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

USE banyaaszatiteruletek
/*Telek tábla létrehozása*/
CREATE TABLE telek (
    id INT /*NOT NULL (Fölösleges a PRIMARY KEY miatt) UNIQUE*/ PRIMARY KEY,
    telepules VARCHAR(30), 
    muvmod  ENUM('külfejtés','mélyművelés','mélyfúrás','külfejtés és mélyművelés'), 
    allapot /*CHAR(1) vagy*/ ENUM("M","S","T","B"),
    fedoszint DOUBLE(10,2),
    fekuszint DOUBLE(10,2)
    /*PRIMARY KEY(id)*/
);
CREATE TABLE kapcsolo (
    telekid INT,
    nyersanyagid INT,
    CONSTRAINT PRIMARY KEY (telekid,nyersanyagid)
     
);

CREATE TABLE nyersanyag(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(26)
);

ALTER TABLE kapcsolo ADD FOREIGN  KEY (telekid) REFERENCES telek(id);
ALTER TABLE kapcsolo ADD FOREIGN  KEY (nyersanyagid) REFERENCES nyersanyag(id);