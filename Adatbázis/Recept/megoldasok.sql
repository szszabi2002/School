-- Active: 1707118294076@@127.0.0.1@3306@recept_13i_gy2
/*1. feladat: Hozzon létre a lokális SQL szerveren recept néven adatbázist! Az adatbázis alapértelmezett rendezési sorrendje a magyar szabályok szerinti legyen! Ha az Ön által választott SQL szervernél nem alapértelmezés az UTF-8 kódolás, akkor azt is állítsa be alapértelmezettnek az adatbázis létrehozásánál! */
CREATE DATABASE recept_13I_gy2
DEFAULT CHARACTER SET utf8
COLLATE utf8_hungarian_ci;


/*3. feladat: A hasznalt táblához adjon hozzá id néven új mezőt, amely az elsődleges kulcs lesz! */
ALTER TABLE hasznalt
ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY FIRST;


/*4. feladat: A táblák között hozza létre az ábra szerinti kapcsolatokat!*/
Alter TABLE etel
ADD FOREIGN KEY (kategoriaid) REFERENCES kategoria(id);
ALTER TABLE hasznalt
ADD FOREIGN KEY (etelid) REFERENCES etel(id),
ADD FOREIGN KEY (hozzavaloid) REFERENCES hozzavalo(id)


/*5. feladat: Készítsen lekérdezést, amely ábécé sorrendben felsorolja az 1994 előtt kipróbált ételek nevét! */
SELECT nev
FROM   etel
WHERE felirdatum < '1994.00.00'
ORDER BY 1

SELECT nev
FROM   etel
WHERE YEAR(felirdatum) < 1994
ORDER BY 1


/*6. feladat: Készítsen lekérdezést, amely megadja, hogy Tamás mikor készített először tésztát! */
SELECT
  etel.elsodatum
FROM etel
  INNER JOIN kategoria
    ON etel.kategoriaid = kategoria.id
WHERE kategoria.nev = 'tészta'
AND etel.elsodatum IS NOT NULL
ORDER BY etel.elsodatum
LIMIT 1

SELECT
  MIN(etel.elsodatum)
FROM etel
  INNER JOIN kategoria
    ON etel.kategoriaid = kategoria.id
WHERE kategoria.nev = 'tészta'

/*7. feladat: Vegyen fel egy új, logikai típusú mezőt nemvolt néven az etel táblába!*/



/*Frissítse a tábla adatait úgy, hogy a nemvolt mezőnek igaz értéket ad, ha Tamás az adott ételt még soha nem készítette el, egyébként hamisat! */



/*8. feladat: Készítsen lekérdezést, amely megadja, hogy Tamás melyik évben jegyezte fel a legtöbb ételt és mennyit! */



/*9. feladat: Készítsen lekérdezést, amely megadja azon levesek és főzelékek nevét, amelyeket Tamás a feljegyzéstől számított két héten belül kipróbált! */



/*10. feladat: Tamás számára piros betűs ünnep, ha egy-egy ételt először készít, s erről az évfordulón jó szívvel megemlékszik az étel ismételt elkészítésével. Készítsen lekérdezést, amely megadja, hogy a mai napon, azaz a lekérdezés futtatásának napján mely ételek készítésének van „évfordulója”! */



/*11. feladat: Egyesek azt mondják, hogy a són kívül a pirospaprikát használják a legtöbb ételhez. Listázza ki azon hozzávalók nevét, amelyeket a Tamás által feljegyzett ételek közül többhöz használnak, mint a pirospaprikát! A lekérdezés a sót ne jelenítse meg! */



/*12. feladat: Készítsen lekérdezést, amely felsorolja azon levesek nevét, amelyek készítéséhez sem pirospaprika, sem valamilyen hagyma nem szükséges! */
