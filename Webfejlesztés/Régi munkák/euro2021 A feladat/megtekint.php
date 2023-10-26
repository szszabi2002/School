<!DOCTYPE html>
<html lang="hu">
<?php
include 'kapcsolat.php';
$id = $_GET['id'];

try {
    $sql = "SELECT * FROM varosok WHERE id=$id";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <title>euro2021</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Forras/kozos/jquery-3.5.1.min.js "></script>
    <script src="Forras/kozos/popper.min.js "></script>
    <script src="Forras/kozos/bootstrap.min.js "></script>
    <link rel="stylesheet" href="Forras/kozos/bootstrap.min.css">
    <link rel="stylesheet" href="Forras/kozos/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class=" ">
        <img src="Forras/kepek/fejlec.png" alt="Fejléc kép" class="w-100 px-3">

        <nav class="navbar navbar-expand-lg navbar-dark ">
            <a class="navbar-brand" href="#">Euro 2020-2021</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Adatok</a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Keresés</button>
                </form>
            </div>

        </nav>

    </header>

    <body>
        <main>
            <div class="card-deck" id="megt">
                <?php foreach ($adatok as $sor) : ?>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-1 mb-3">
                        <div class="card">
                            <img class="card-img-top img-fluid rounded" src="Forras/kepek/helyszinek/<?= $sor['varos']; ?>.jpg" alt="' <?= $sor['varos']; ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= $sor['varos']; ?></h5>
                                <b id="nagybetu" class="card-title"><?= $sor['rovidleiras']; ?></b>
                                <p class="card-text text-justify"><br><?= $sor['leiras']; ?></p>
                                <p class="card-text text-justify"><b>Terület:</b> <?= $sor['terulet']; ?> km<sup>2</sup></p>
                                <p class="card-text text-justify"><b>Népessége:</b> <?= $sor['nepesseg']; ?> fő</p>
                                <p class="card-text text-justify"><b>Ország:</b> <?= $sor['orszag']; ?></p>
                            </div>
                            <a href="index.php" class="btn btn-block btn-info" id="vissza">Vissza</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
        <footer>&copy; Mekk Elek - 2020.</footer>
    </body>

</html>