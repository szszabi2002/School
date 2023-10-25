<?php

include 'kapcsolat.php';
$id = $_GET['id'];

try {
    $sql = "DELETE FROM varosok WHERE id=$id";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

header('Location: index.php');