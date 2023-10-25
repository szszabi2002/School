<!DOCTYPE html>
<html lang="hu">
<?php
include 'adatbazis.php';
$db = new Database();
session_start();
$sql = "SELECT * FROM utazasicelok where id =" . $_GET['id'] . ";";
$adat = $db->RunSQL($sql);
//print_r($adat);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons.css">
    <script src="jquery-3.5.1.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <link rel="stylesheet" href="stilus.css">
</head>

<body>
    <div class="container">
        <header class="container">
            <div class="row">
                <div class="col-12">
                    <img class="w-100" src="img/fejlec.png" />
                </div>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Kiránduló helyek</a>
                <form class="d-flex ml-auto">
                    <input class="form-control me-2" type="search" placeholder="" aria-label="Search">
                    <button class="btn btn-outline-light ml-1" type="submit">Keresés</button>
                </form>
                <a class="btn btn-outline-light ml-1" href="#">Bejelentkezés </a>
            </div>
        </nav>
        <main class="container">
    <div class="row d-flex flex-wrap ">
        <?php foreach ($adat as $sor) : ?>
            <div class="col-xl-6 offset-xl-3 my-3" >
                <div class="card text-center" >
                    <a href="megjelenit.php?id='<?= $sor['id']; ?>'">
                        <img src='<?php echo "img/" . $db->cserel($sor['kep']); ?>' class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $sor['nev']; ?></h5>
                        <div class="card-text text-justify my-1">Megye: <?= $sor['megye']; ?> </div>
                        <div class="card-text text-justify my-1">Távolság Budapesttől: <?= $sor['tavolsag']; ?> </div>
                        <div class="card-text text-justify my-1">Leírás: <?= $sor['leiras']; ?> </div>
                        <a class="btn btn-outline-dark" href="index.php">Vissza</a>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>
    </div>
</main>

        <footer class="container">
            <div class="row">
                <div class="col-12">
                    <h4 class="p-1">&copy;  Gyalog Galopp - 2022 </h4>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>