/*a*/
CREATE DATABASE hamburger_13I_2cs_dolgozat
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;

/*b*/
ALTER TABLE rendeles 
  ADD CONSTRAINT FK_rendeles_felhasznalo_id FOREIGN KEY (felhasznaloId)
    REFERENCES felhasznalo(id) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE rendeleselem 
  ADD CONSTRAINT FK_rendeleselem_rendeles_id FOREIGN KEY (rendelesId)
    REFERENCES rendeles(id) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE rendeleselem 
  ADD CONSTRAINT FK_rendeleselem_menutetel_id FOREIGN KEY (menutetelId)
    REFERENCES menutetel(id) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE menutetel 
  ADD CONSTRAINT FK_menutetel_etelkategoria_id FOREIGN KEY (etelkatId)
    REFERENCES etelkategoria(id) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*1. Hány olyan felhasználó van az adatbázisban, akinek a keresztneve ’B’ betűvel kezdődik?*/
SELECT
  COUNT(felhasznalo.nev) AS db
FROM felhasznalo
WHERE felhasznalo.nev LIKE "% B%"

/*2. Melyik a legdrágább rendelhető étel?*/
SELECT
  menutetel.ar
FROM menutetel
ORDER BY menutetel.ar DESC
LIMIT 1

/*3. Ki(k) rendeltek abból az ételből, amiből a legkevesebb fogyott?*/
SELECT DISTINCT
    felhasznalo.nev
FROM
    rendeleselem
    INNER JOIN rendeles ON rendeleselem.rendelesId = rendeles.id
    INNER JOIN felhasznalo ON rendeles.felhasznaloId = felhasznalo.id
    INNER JOIN menutetel ON rendeleselem.menutetelId = menutetel.id
WHERE
    rendeleselem.rendelesId = (
        SELECT rendeleselem.rendelesId
        FROM
            rendeleselem
            INNER JOIN rendeles ON rendeleselem.rendelesId = rendeles.id
            INNER JOIN felhasznalo ON rendeles.felhasznaloId = felhasznalo.id
            INNER JOIN menutetel ON rendeleselem.menutetelId = menutetel.id
        GROUP BY
            felhasznalo.nev
        ORDER BY SUM(mennyiseg)
        LIMIT 1
    )

/*Legkevesebb rendelt étel rendelés id-ja*/
SELECT
  rendeleselem.rendelesId
FROM rendeleselem
  INNER JOIN rendeles
    ON rendeleselem.rendelesId = rendeles.id
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN menutetel
    ON rendeleselem.menutetelId = menutetel.id
GROUP BY felhasznalo.nev
ORDER BY SUM(mennyiseg)
LIMIT 1

/*4. Melyik ételből volt a legtöbb bevétele és mennyi a hamburgerezőnek?*/
SELECT 
  menutetel.nev,
  SUM(rendeleselem.mennyiseg * menutetel.ar)
FROM rendeleselem
  INNER JOIN rendeles
    ON rendeleselem.rendelesId = rendeles.id
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN menutetel
    ON rendeleselem.menutetelId = menutetel.id
GROUP BY felhasznalo.nev
ORDER BY 2 DESC
LIMIT 1

/*5. Melyek   azok   a   felhasználók   akik   összesen   többet   költöttek   30.000Ft-nál   a   rendeléseik során?*/
SELECT 
  felhasznalo.nev
FROM rendeleselem
  INNER JOIN rendeles
    ON rendeleselem.rendelesId = rendeles.id
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN menutetel
    ON rendeleselem.menutetelId = menutetel.id
GROUP BY felhasznalo.nev
HAVING SUM(rendeleselem.mennyiseg * menutetel.ar) > 30000

/*6. Melyik ételkategória ’Katona Vince’ kedvence?*/
SELECT 
  etelkategoria.nev
FROM rendeleselem
  INNER JOIN rendeles
    ON rendeleselem.rendelesId = rendeles.id
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN menutetel
    ON rendeleselem.menutetelId = menutetel.id
  INNER JOIN etelkategoria
    ON menutetel.etelkatId = etelkategoria.id
WHERE felhasznalo.nev = 'Katona Vince'
GROUP BY menutetel.nev
ORDER BY COUNT(etelkategoria.nev) DESC
LIMIT 1

/*7. A nap melyik órájában rendelték a legtöbb desszertet?*/
SELECT 
  HOUR(idopont)
FROM rendeleselem
  INNER JOIN rendeles
    ON rendeleselem.rendelesId = rendeles.id
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN menutetel
    ON rendeleselem.menutetelId = menutetel.id
  INNER JOIN etelkategoria
    ON menutetel.etelkatId = etelkategoria.id
WHERE etelkategoria.nev = 'desszert'
GROUP BY HOUR(idopont)
ORDER BY COUNT(HOUR(idopont)) DESC
LIMIT 1

/*8. Ki rendelte a legtöbb hamburgert?*/
SELECT 
  felhasznalo.nev,
  SUM(mennyiseg)
FROM rendeleselem
  INNER JOIN rendeles
    ON rendeleselem.rendelesId = rendeles.id
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN menutetel
    ON rendeleselem.menutetelId = menutetel.id
  INNER JOIN etelkategoria
    ON menutetel.etelkatId = etelkategoria.id
WHERE etelkategoria.nev = 'hamburger'
GROUP BY felhasznalo.nev
ORDER BY 2 DESC, 1

/*9. Melyik kategóriához tartozik a legtöbb étel?*/
SELECT 
  etelkategoria.nev,
  COUNT(menutetel.nev)
FROM rendeleselem
  RIGHT JOIN menutetel
    ON rendeleselem.menutetelId = menutetel.id
  INNER JOIN etelkategoria
    ON menutetel.etelkatId = etelkategoria.id
GROUP BY etelkategoria.nev
ORDER BY 2 DESC
LIMIT 1

/*10. Mely(ek) az(ok) a felhasználó(k) aki(k) a legtöbb ételkategóriából rendeltek?*/
SELECT DISTINCT
  felhasznalo.nev,
  SUM(mennyiseg),
  etelkategoria.nev
FROM rendeleselem
  INNER JOIN rendeles
    ON rendeleselem.rendelesId = rendeles.id
  INNER JOIN felhasznalo
    ON rendeles.felhasznaloId = felhasznalo.id
  INNER JOIN menutetel
    ON rendeleselem.menutetelId = menutetel.id
  INNER JOIN etelkategoria
    ON menutetel.etelkatId = etelkategoria.id
GROUP BY etelkategoria.nev, felhasznalo.nev
ORDER BY 2 DESC, etelkategoria.nev, felhasznalo.nev
