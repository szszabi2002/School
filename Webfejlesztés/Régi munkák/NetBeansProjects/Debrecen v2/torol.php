<?php

include 'kapcsolat.php';
//print_r($_GET);
$id = $_GET['id'];

try {
    $sql = "DELETE FROM adatok WHERE id='$id'";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

header('Location: index.php');