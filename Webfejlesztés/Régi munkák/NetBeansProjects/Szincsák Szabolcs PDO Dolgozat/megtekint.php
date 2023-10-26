<!DOCTYPE html>
<html lang="hu">
<?php
include 'adatkapcsolat.php';
$id = $_GET['id'];

try {
    $sql = "SELECT * FROM pizzak WHERE ID=$id";
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
        <?php foreach ($adatok as $sor) : ?>
        <h2>Pizzéria adat feltöltő oldala - <?= $sor['nev']; ?></h2>
        <?php endforeach; ?>
    </header>
    <div id="hatterkep" class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <button class="btn btn-danger">Új Pizza rögzitése</button>
            </div>
        </div>
    </div>
    <div class="container-fluid" id="megt">
        <?php foreach ($adatok as $sor) : ?>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-1 mb-3">
            <div class="card">
                <img class="card-img-top img-fluid rounded" src="img/<?= $sor['kep']; ?>" alt="' <?= $sor['kep']; ?>">
                <div class="card-body text-left p-10">
                    <h5 class="card-title text-left"><?= $sor['nev']; ?></h5>
                    <b class="card-title text-left"><br>Feltételek:</b>
                    <p class="card-text text-left"><?= $sor['feltetek']; ?></p>
                    <p class="card-text text-left"><b>Ár: <span id="piros"> <?= $sor['ar']; ?> ft</span></b></p>
                </div>
                <a href="index.php" class="btn btn-block btn-success" id="vissza">Vissza</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <footer class="btn btn-block btn-secondary">&copy; Mekk Elek - 2021.</footer>
</body>

</html>