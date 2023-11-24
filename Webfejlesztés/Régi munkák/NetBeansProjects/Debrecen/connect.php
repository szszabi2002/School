<?php

$dbname = 'debrecen';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = '';

$dsn = "mysql:host=" . $dbhost . ";dbname=" . $dbname;
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$dbc = new PDO($dsn, $dbuser, $dbpassword, $options);

function test_data($data)
{
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}
