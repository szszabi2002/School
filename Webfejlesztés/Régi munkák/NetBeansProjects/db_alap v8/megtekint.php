<!DOCTYPE html>
<?php
include 'adatkapcsolat.php';
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
        <title>Dolgozat</title>
        <link href="db_alap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="Common/css/bootstrap.rtl.min.css" type="text/css">
    </head>
    <body>
        <div class="container">
        <h4>Alkalmazottak adatai </h4>
        <ul class="list-group list-group-flush">
            <?php foreach ($adatok[0] as $kulcs => $ertek) : ?>
                <li class="list-group-item"><?= $kulcs ?> : <?= $ertek; ?></li>
            <?php endforeach; ?>
        </ul>


        <a href="index.php">Vissza </a>
        </div>
    </body>
</html>
