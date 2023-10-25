<?php

/*
 * 1. lépés: fájlok elérése
 */
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT']; /* az apache alapértelmezett gyökérkönyvtára pl.: D:/xampp/htdocs */

echo '$_SERVER["DOCUMENT_ROOT"] -->  ' . $DOCUMENT_ROOT . "<br><hr> ";

/* $_SERVER tömb elemeinek kiiratása */
//foreach ($_SERVER as $kulcs => $ertek) {
//    echo "$kulcs : $ertek <br>";


/*
 * 2.lépés  -fájlkezelő létrehozása + megnyitási módok
 */

$fh1 = fopen("adatok.txt", "rw") or die("A fájl nem nyitható meg!");
$fh2 = fopen("$DOCUMENT_ROOT/Fajlokkezelese/adatok.txt", "r");

/*
 * 3 lépés:  fájl beolvasása soronként
 */

$sorok = []; //sorokat tároló tömb
$j = 0;      //sorszámláló
while (!feof($fh1)) {
    //echo $sorok[$j] = fgets($fh1) . "<br>";
    $sorok[$j] = explode(',', fgets($fh1));
    echo "<b>$j. sor:</b> " . tombtostr($sorok[$j]) . "<br>";
    $j++;
    ;
}

//Tömb elemeinek stringként történő kiíratása
function tombtostr($tomb) {
    $tombstr = "";
    foreach ($tomb as $key => $value) {
        $tombstr .= " $key: $value |";
    }
    $tombstr = substr($tombstr, 0, strlen($tombstr) - 2);
    return $tombstr;
}

/*
 * 4. lépés: Fájlkezelő lezárása - fájl nem hagyunk nyitva
 */
echo "<hr><br>";
fclose($fh1);
fclose($fh2);

var_dump($sorok);
echo "<hr><br>";

/*
 * 5. lépés: fájl beolvasása karakterenként és kiaratása
 */
$fh3 = fopen("adatok.txt", "rw") or die("A fájl nem nyitható meg!");
$adatok = [];
$i = 0;
while (!feof($fh3)) {
    $adatok[$i] = fgetc($fh3);
    echo $adatok[$i];
    $i++;
}
//var_dump($adatok);
echo "<br>Karakterek száma: $i <hr><br>";
fclose($fh3);

/*
 *  6. Lépés: fájl beolvasása karakterenként és kiratása
 *
 * notepad++ spec karakterek megjelenítése \n\r "új sor + kocsi vissza"
 */

$fh4 = fopen("adatok.txt", "rw") or die("A fájl nem nyitható meg!");
$k = 0;
while (!feof($fh4)) {
    $kar = fgetc($fh4);
    if (($kar == "\n") || ( $kar == "\r")) {
        echo "<br>";
    } else {
        echo $kar;
        $k++;
    }
}
echo "<br>Karakterek száma: $k <hr><br>";
echo "<hr><br>";
fclose($fh4);

/*
 * 7. lépés fájlműveletek olvasás, írás, hozzáfűzés
 */
//$fh5 = fopen("adatok_1.txt", "c") or die("A fájl nem nyitható meg!");
//$result = fputs($fh5, "***Ezt irtuk a fajlba!\r\n");
//fseek($fh5, 93);
//fputs($fh5, " a +infot ");
//fclose($fh5);
?>

