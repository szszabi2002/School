<?php

$dbname = '';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = '';

$dsn = "mysql:host=" . $dbhost . ";dbname=" . $dbname;
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];


function test_data($data) {
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}