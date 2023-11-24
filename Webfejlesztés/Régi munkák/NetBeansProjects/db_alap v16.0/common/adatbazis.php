<?php

include 'adatkapcsolat.php';

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

function getValues($dbc, $table, $fields) {
    try {
        $fieldList = "";
        foreach ($fields as $field) {
            $fieldList .= $field . ", ";
        }
        $fieldList = substr($fieldList, 0, strlen($fieldList) - 2);
        $sql = "SELECT $fieldList FROM $table;";
        //echo $sql;
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getTraceAsString();
    }
    $name = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    return $name;
}
