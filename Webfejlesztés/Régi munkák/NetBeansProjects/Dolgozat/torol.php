<?php

include 'adatbazis.php';
//print_r($_GET);
$id = $_GET['ID'];

try {
    $sql = "DELETE FROM autok WHERE rendszam=$id";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

header('Location: index.php');

