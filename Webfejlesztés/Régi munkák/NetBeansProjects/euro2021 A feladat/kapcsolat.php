<?php

$dbhost = 'localhost';
$dbname = 'euro2021';
$dbuser = 'root';
$dbpassword = '';

try {
    $dsn = "mysql:host=" . $dbhost . ";dbname=" . $dbname;                                 //adatforrás megadása
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $dbc = new PDO($dsn, $dbuser, $dbpassword, $options);                       //adatbázis kapcsolat egy példányának létrehozása
    /*if ($dbc) {
        echo "Sikeres kapcsolódás";
    }*/
} catch (PDOException $exc) {
    echo "Kapcsolódási hiba:" . $exc->getMessage();
}

function test_data($data)
{
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}
