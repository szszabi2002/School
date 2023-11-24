<?php

$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT']; /* az apache alapértelmezett gyökérkönyvtára
  pl.: D:/xampp/htdocs */

function file_get_contents_utf8($fn) {
    $content = file_get_contents($fn);
    return mb_convert_encoding($content, 'UTF-8',
            mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}

//fájl beolvasása soronként
echo file_get_contents("$DOCUMENT_ROOT/fajlokkezelese/adatok.txt") . "<br>";
echo file_get_contents_utf8("adatok.txt");

$ujsor = "5,Tóth Krisztina, Ózd , 1999.11.11.\n";
//kiírja a sztringet a fájlba a korábbi tartalmáát törli
file_put_contents("$DOCUMENT_ROOT/fajlokkezelese/adatok_putcontent.txt", $ujsor);
echo "<br><hr>" . file_get_contents("$DOCUMENT_ROOT/fajlokkezelese/adatok_putcontent.txt");
?>

