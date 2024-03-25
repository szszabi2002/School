CREATE DATABASE notebook CHARACTER SET utf8 COLLATE utf8_hungarian_ci;

CREATE TABLE notebook.processzor (
  id INT(11) NOT NULL AUTO_INCREMENT,
  gyarto VARCHAR(255) DEFAULT NULL,
  tipus VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE notebook.oprendszer (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nev VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE notebook.gep (
  id INT(11) NOT NULL AUTO_INCREMENT,
  gyarto VARCHAR(255) DEFAULT NULL,
  tipus VARCHAR(255) DEFAULT NULL,
  kijelzo DOUBLE DEFAULT NULL,
  memoria INT(11) DEFAULT NULL,
  merevlemez INT(11) DEFAULT NULL,
  videovezerlo VARCHAR(255) DEFAULT NULL,
  ar INT(11) DEFAULT NULL,
  processzorid INT(11) NOT NULL,
  oprendszerid INT(11) NOT NULL,
  db INT(11) DEFAULT NULL,
  PRIMARY KEY (id)
);

ALTER TABLE gep 
  ADD CONSTRAINT FK_gep_oprendszer_id FOREIGN KEY (oprendszerid)
    REFERENCES oprendszer(id) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE gep 
  ADD CONSTRAINT FK_gep_processzor_id FOREIGN KEY (processzorid)
    REFERENCES processzor(id) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*2.Feladat*/

/*3.Feladat*/
/*4.Feladat*/
/*5.Feladat*/
/*6.Feladat*/
/*7.Feladat*/
/*8.Feladat*/