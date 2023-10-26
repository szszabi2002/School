<?php

include_once 'adatkapcsolat.php';

function getName($dbc, $table, $id) {
    try {
        $sql = "SELECT * FROM $table WHERE id='$id';";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getTraceAsString();
    }
    $name = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    return $name[0]['name'];
}

function getValues($dbc, $table, $fieldList) {
    try {
        $mezok = "";
        foreach ($fieldList as $field) {
            $mezok .= $field . ", ";
        }
        $mezok = substr($mezok, 0, strlen($mezok) - 2);

        $sql = "SELECT $mezok FROM $table;";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getTraceAsString();
    }
    $values = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    return $values;
}
