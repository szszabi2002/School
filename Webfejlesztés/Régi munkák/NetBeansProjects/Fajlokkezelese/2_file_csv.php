<?php

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT']; /* az apache alapértelmezett gyökérkönyvtára
  pl.: D:/xampp/htdocs */
//fájl beolvasása soronként

$fmut2 = fopen("$DOCUMENT_ROOT/fajlokkezelese/adatok.txt", "r+");
if (!$fmut2) {
    echo "HIBA: a fájl nem nyitható meg!!!<br>";
    fclose($fmut2);
}

//$fmut = fopen("$DOCUMENT_ROOT/fajlokkezelese/adatok.txt", "r+") or die("A fájl nem nyitható meg!");




$sor = 0;
$sorok = [];
while (!feof($fmut2)) {
    $sorok[$sor] = fgetcsv($fmut2);
    print_r($sorok[$sor]);
    echo "<br>";
    $sor++;
}
fclose($fmut2);

$fmut3 = fopen("$DOCUMENT_ROOT/fajlokkezelese/adatok2.txt", "w+");
print_r($sorok);
@fputcsv($fmut3, $sorok[0], ';', '"');

fseek($fmut3, 1500);
fputcsv($fmut3, [1, 2, 3, 4]);

fclose($fmut3);

echo "<hr><hr>"
?>

