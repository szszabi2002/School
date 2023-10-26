<!DOCTYPE html>
<html lang="hu">
<?php
include 'adatkapcsolat.php';

try {
    $sql = "SELECT * FROM pizzak";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <title>Pizzéria</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h2>Pizzéria adat feltöltő oldala - Pizzák</h2>
    </header>
    <div id="hatterkep" class="container-fluid">
        <div class="row">
            <div class="col-md-2 order 0">
                <button class="btn btn-danger">Új Pizza rögzitése</button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <?php foreach ($adatok as $sor) : ?>
                    <div class="col-md-4 mt-3 mb-3">
                        <div class="card">
                            <img class="card-img-top img-fluid rounded" src="img/<?= $sor['kep']; ?>"
                                alt="' <?= $sor['kep']; ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $sor['nev']; ?></h5>
                                <a href="megtekint.php?id='<?= $sor['ID']; ?>'"
                                    class="card-link btn btn-success">Megtekint</a>
                                <a href="szerkeszt.php?id='<?= $sor['ID']; ?>'"
                                    class="card-link btn btn-success">Szerkeszt</a>
                                <a href="torol.php?id='<?= $sor['ID']; ?>'" class="card-link btn btn-success">Töröl</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <div id="hatterkep" class="container-fluid">
        <div class="row">
            <div class="col-md-2 order 2">
                <img class="img-fluid" src="img/pizzabg.jpg" alt="Pizzabg">
            </div>
        </div>
    </div>
    <footer class="btn btn-block btn-secondary">&copy; Mekk Elek - 2021.</footer>
</body>

</html>