<!DOCTYPE html>
<?php
foreach ($_SERVER as $key => $value) {
    echo "$key : $value <br>";
}


//Root mappa lekérése
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "$DOCUMENT_ROOT";
$HOME = $DOCUMENT_ROOT . "/fajlok/adatok.txt" . "<br>";
echo "$HOME";

//Fájl megnyitása
$adatok = fopen('adatok.txt', "rw") or die("A fájl nem elérhető!");

//Tömb amibe beletöltöm az adatokat
$rows = [];


//Eggyesével beletölteni a fájl tartalmait
$counter = 0;
while (!feof($adatok)) {
    $rows[$counter] = explode(",", fgets($adatok));
    $counter++;
}
foreach ($rows as $elem) {
    foreach ($elem as $ertek) {
        echo "$ertek <br>";
    }
}


//Beletölti az egész fájl tartalmát egy Arraybe
$rows = file('adatok.txt');
$rows_seperated = [];
$counter = 0;
foreach ($rows as $elem) {
    $rows_seperated[$counter] = $elem;
    $counter++;
}

?>