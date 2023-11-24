<!DOCTYPE html>
<?php
include 'kozos/adatbazis.php';
//print_r($_GET);
$id = $_GET['ID'];

try {
    $sql = "SELECT autok.rendszam AS Rendszám, autok.tipus AS Típus, autok.kategoria AS Kategória, autok.vasarlasdatuma AS `Vásárlás dátuma`, autok.ar AS Ár, autok.futott_km AS `Futtot km`, autok.allapot AS Állapot FROM autok WHERE rendszam='$id'";
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
        <link rel="stylesheet" href="kozos/css/bootstrap.min.css">
    <link rel="stylesheet" href="kozos/css/style.css">
    <script src="kozos/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="adatok">
        <h4>Autók adatai</h4>
        <ul class="list-group">
            <?php foreach ($adatok[0] as $kulcs => $ertek) : ?>
                <li class="list-group-item"><?= $kulcs ?> : <?= $ertek; ?></li>
            <?php endforeach; ?>
            <a href="index.php"><span class="btn btn-secondary btn-m btn-block list-group-item">Vissza</span></a>
            <a href="torol.php?ID=<?php $adatok['rendszam']?>"><span class="btn btn-secondary btn-m btn-block list-group-item">Törlés</span></a>
        </ul>
        </div>
    </body>
</html>
