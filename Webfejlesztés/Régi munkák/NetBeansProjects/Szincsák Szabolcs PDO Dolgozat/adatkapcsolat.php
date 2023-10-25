<?php
$host = 'localhost';
$db = 'pizzéria';
$user = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$db";
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $dbc = new PDO($dsn, $user, $password, $options);                      
} catch (PDOException $exc) {
    echo "Kapcsolódási hiba:" . $exc->getMessage();
}
?>