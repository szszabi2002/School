<?php
$host = 'localhost';
$db = 'demo';
$user = 'root';
$password = '';
try {
    $dsn = "mysql:host=$host;dbname=$db";
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $dbc = new PDO($dsn, $user, $password, $options);
    /*if ($dbc) {
        echo 'Sikeres Kapcsolodás';
    }*/
} catch (Exception $exc) {
    echo 'Kapcsolodási hiba:' . $exc->getMessage();
}