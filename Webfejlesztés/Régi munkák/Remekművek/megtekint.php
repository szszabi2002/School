<!DOCTYPE html>
<?php
include 'kapcsolat.php';
$id = $_GET['ID'];
$name = $_GET['name'];
try {
    $sql = "SELECT * FROM muvek WHERE ID='$id'";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);

try {
    $sql = "SELECT * FROM leiras WHERE muvek_ID = '$id'";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
$leiras = $utasitas->fetchAll(PDO::FETCH_ASSOC);


foreach ($adatok as $key => $value) {
    $ID = $value['ID'];
    $Tipus = $value['tipus'];
    $Orszag = $value['orszag'];
    $Telepules = $value['telepules'];
    $Nev = $value['nev'];
    $Kepek = $value['kepek'];
}
foreach ($leiras as $key => $value) {
    $ID = $value['ID'];
    $Forras = $value['forras'];
    $Leiras = $value['leiras'];
    $Terkep = $value['terkep'];
    $Megepites_eve = $value['megepites_eve'];
}

try {
    $sql = "SELECT * FROM felhasznalok;";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
$users = $utasitas->fetchAll(PDO::FETCH_ASSOC);

$privilege = 0;
foreach ($users as $row) {
    if ($row['felhasznalonev'] == $name) {
        $privilege =  $row['jogosultsag'];
        break;
    }
}
?>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leírás</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stilus.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<body>
    <header>
        <span style="font-size: 18px; font-weight: bold	;">Remekművek</span>
        <span style="float: right;"><a href="index.php" class="btn btn-sm btn-info">Kijelentkezés</a> Felhasználó: <?= $name ?></span>
    </header>
    <div class="row m-3">
        <div class="col-2" style="text-align: center;">

        </div>
        <div id="container" class="col-8">
            <div class="row">
                <div class="ml-auto mr-auto col-8 mt-3 mb-3">
                    <div class="card">
                        <img class="card-img-top img-fluid rounded" src="<?= $Kepek; ?>" alt="<?= $Nev ?>">
                        <div class="card-body pl-2 pr-2">
                            <h4 class="card-title"><?= $Nev ?></h4>
                            <h6>Leírás:</h6>
                            <p><?= $Leiras ?></p>
                            <hr>
                            <h6>Elkészités éve: </h6>
                            <p><?= $Megepites_eve ?></p>
                            <h6>Cím: </h6>
                            <p><?= $Orszag ?>, <?= $Telepules ?></p>
                            <h6>Térkép: </h6>
                            <p><?= $Terkep ?></a></p>
                            <h6>Forrás: </h6>
                            <p><a href="<?= $Forras ?>" target="_blank" rel="noopener noreferrer"><?= $Forras ?></a></p>
                        </div>
                        <div class="card-footer">
                            <div style="display: <?php

                                                    if ($privilege == 0) {
                                                        echo "none";
                                                    } else {
                                                        echo "block";
                                                    } ?>;">
                                <a href="szerkesztes.php?ID=<?= $id ?>&name=<?= $name ?>" class="btn btn-secondary" style="width: 100%;">Szerkesztés</a>
                                <br><br>
                                <a href="torol.php?ID=<?= $id ?>&name=<?= $name ?>" class="btn btn-secondary" style="width: 100%;">Törlés</a>
                                <br><br>
                            </div>
                            <a href="megjelenites.php?name=<?= $name ?>" class="btn btn-secondary" style="width: 100%;">Vissza</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center p-3">
		Készitette: Szincsák Szabolcs, Jakab Dániel, Klepács Roland +1 (Sanyó Zsanett).
	</footer>
</body>

</html>