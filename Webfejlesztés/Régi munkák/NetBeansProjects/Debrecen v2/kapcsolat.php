<?php

//MySQl kapcsolódási adatok
$host = 'localhost';
$db = 'debrecen';
$user = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$db";                                   //adatforrás megadása
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $dbc = new PDO($dsn, $user, $password, $options);                       //adatbázis kapcsolat egy példányának létrehozása
//    if ($dbc) {
//        echo "Sikeres kapcsolódás";
//    }
} catch (PDOException $exc) {
    echo "Kapcsolódási hiba:" . $exc->getMessage();
}
