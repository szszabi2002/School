<?php

include 'kapcsolat.php';
$id = $_GET['ID'];
$name = $_GET['name'];
try {
    $sql = "DELETE FROM leiras WHERE muvek_ID = '$id'";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
try {
    $sql = "DELETE FROM muvek WHERE ID='$id'";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

header("Location:megjelenites.php?name=$name");
?>