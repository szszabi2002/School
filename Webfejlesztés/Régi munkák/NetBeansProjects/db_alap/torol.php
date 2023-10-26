<?php

include 'adatkapcsolat.php';
//print_r($_GET);
$id = $_GET['id'];

try {
    $sql = "DELETE FROM employees WHERE id=$id";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

header('Location: index.php');

