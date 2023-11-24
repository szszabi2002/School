<?php
include 'Registers.php';
try {
    $sql = "SELECT * FROM username";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trapland Lekérdezés</title>
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