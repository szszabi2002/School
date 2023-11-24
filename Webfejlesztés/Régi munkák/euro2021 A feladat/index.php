<!DOCTYPE html>
<html lang="hu">
<?php
include 'kapcsolat.php';

try {
    $sql = "SELECT * FROM varosok";
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
    <header class="">
        <img src="Forras/kepek/fejlec.png" alt="Fejléc kép" class="w-100 px-3">

        <nav class="navbar navbar-expand-lg navbar-dark ">
            <a class="navbar-brand" href="#">Euro 2020-2021</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Helyszínek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Csoportok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Stadionok</a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Keresés</button>
                </form>
            </div>

        </nav>

    </header>
    <main>
        <div class="card-deck">
            <?php foreach ($adatok as $sor) : ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 m-3">
                    <div class="card">
                        <img class="card-img-top img-fluid rounded" src="Forras/kepek/helyszinek/<?= $sor['varos']; ?>.jpg" alt="' <?= $sor['varos']; ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= $sor['varos']; ?></h5>
                            <a href="megtekint.php?id='<?= $sor['id']; ?>'" class="card-link bi-eye"></a>
                            <a href="modosit.php?id='<?= $sor['id']; ?>'" class="card-link bi-pencil"></a>
                            <a href="torol.php?id='<?= $sor['id']; ?>'" class="card-link bi-trash"></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>&copy; Mekk Elek - 2020.</footer>
</body>

</html>