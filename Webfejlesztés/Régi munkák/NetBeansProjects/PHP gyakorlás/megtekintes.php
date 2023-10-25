<!DOCTYPE html>
<?php
include 'Database.php';
//print_r($_GET);
$id = $_GET['id'];

try {
    $sql = "SELECT * FROM employees WHERE id=$id";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DB alapok</title>
        <link href="db_alap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h4>Alkalmazottak adatai </h4>
        <ul>
            <?php foreach ($adatok[0] as $kulcs => $ertek) : ?>
                <li><?= $kulcs ?> : <?= $ertek; ?></li>
            <?php endforeach; ?>
        </ul>


        <a href="index.php">Vissza </a>
    </body>
</html>
