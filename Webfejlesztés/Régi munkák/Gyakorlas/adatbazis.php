<?php
$server = "localhost";
$database = "debrecen";
$username = "root";
$password = "";
$dns = "mysql:host=" . $server . ";dbname=" . $database;
$dbc = new PDO($dns, $username, $password);
if ($dbc) {
    echo "Sikeres kapcsolódás";
}
