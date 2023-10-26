<!DOCTYPE html>
<?php
include 'kapcsolat.php';
$id = $_GET['id'];
$name = $_GET['name'];

try {
    $sql = "SELECT * FROM sportletesitmeny WHERE ID='$id'";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);

$nev = $feltetek = $ar = $kep = "";


foreach ($adatok as $key => $value) {
    $Letesitmeny = $value['Letesitmeny'];
    $Cim = $value['Cim'];
    $Leiras = $value['Leiras'];
    $Weboldal = $value['Weboldal'];
    $Google_Maps_SRC = $value['Google_Maps_SRC'];
    $Telefonszam = $value['Telefonszam'];
    $Megnyitas_eve = $value['Megnyitas_eve'];

    $kep = explode(';', $value['Kep_nev']);
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
    if ($row['username'] == $name) {
        $privilege =  $row['privilege'];
        break;
    }
}
?>

<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportlétesítmény adatai</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/bootstrap-icons.css">
    <script src="bootstrap/jquery-3.5.1.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="stilus.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<body>
    <header>
        <img src="img/DB_Logo.png" alt="Debrecen címere" style="height: 50px;">
        <span style="font-size: 18px; font-weight: bold	;">Debrecen sportlétesítményei</span>
        <span style="float: right;">Felhasználó: <?= $name ?></span>
    </header>
    <div class="row m-3">
        <div class="col-2" style="text-align: center;">

        </div>
        <div id="pizza_container" class="col-8">
            <div class="row">
                <div class="ml-auto mr-auto col-8 mt-3 mb-3">
                    <div class="card">
                        <img class="card-img-top img-fluid rounded" src="data:<?= $kep['0']; ?>;base64, <?= $kep['1']; ?>" alt="<?= $Letesitmeny ?>">
                        <div class="card-body pl-2 pr-2">
                            <h4 class="card-title"><?= $Letesitmeny ?></h4>
                            <h6>Leírás:</h6>
                            <p><?= $Leiras ?></p>
                            <hr>
                            <h6>Megnyitás éve: <span><?= $ar ?></span></h6>
                            <p><?= $Megnyitas_eve ?></p>
                            <h6>Cím: <span><?= $ar ?></span></h6>
                            <p><?= $Cim ?></p>
                            <h6>Telefonszám: <span><?= $ar ?></span></h6>
                            <p><a href="tel:<?= $Telefonszam ?>"><?= $Telefonszam ?></a></p>
                            <h6>Weboldal: <span><?= $ar ?></span></h6>
                            <p><a href="<?= $Weboldal ?>" target="_blank" rel="noopener noreferrer"><?= $Weboldal ?></a></p>
                            <hr>
                            <p><iframe src="<?= $Google_Maps_SRC ?>" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe></p>
                        </div>
                        <div class="card-footer">
                            <div style="display: <?php

                                                    if ($privilege == 0) {
                                                        echo "none";
                                                    } else {
                                                        echo "block";
                                                    } ?>;">
                                <a href="szerkeszt.php?id=<?= $id ?>" class="btn btn-secondary" style="width: 100%;">Szerkesztés</a>
                                <br><br>
                                <a href="torol.php?id=<?= $id ?>" class="btn btn-secondary" style="width: 100%;">Törlés</a>
                                <br><br>
                            </div>
                            <a href="letesitmenyek.php?id=<?= $id ?>&name=<?= $name ?>" class="btn btn-secondary" style="width: 100%;">Vissza</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="container-fluid">
        <p> </p>
    </footer>
</body>

</html>