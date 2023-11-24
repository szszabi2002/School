<!DOCTYPE html>
<html lang="hu">
<?php
include 'kapcsolat.php';

$id = $varos = $nev = $ferohelyek = $orszag = "";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $varos = $_POST['varos'];
    $nev = $_POST['nev'];
    $ferohelyek = $_POST['ferohelyek'];
    $orszag = $_POST['orszag'];
    try {
        $sql = "UPDATE stadionok SET varos = '$varos', nev = '$nev', ferohelyek='$ferohelyek', orszag='$orszag' WHERE id='$id'";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Frissítési hiba: " . $exc->getMessage();
    }
    header('Location: index.php');
} else {
    $id = $_GET['id'];
    try {
        $sql = "SELECT * FROM stadionok WHERE id=$id";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getMessage();
    }

    $adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    $varos = $adatok[0]['varos'];
    $nev = $adatok[0]['nev'];
    $ferohelyek = $adatok[0]['ferohelyek'];
    $orszag = $adatok[0]['orszag'];
    $id = $adatok[0]['id'];
}
if (isset($_POST['insert'])) {
    try {
        // Form adatok mentése
        $varos = $_POST['varos'];
        $nev = $_POST['nev'];
        $ferohelyek = $_POST['ferohelyek'];
        $orszag = $_POST['orszag'];
        //SQL létrehozásaa
        $sql = "INSERT INTO stadionok (nev, varos, orszag, ferohelyek) VALUES ('$nev', '$varos', '$orszag', '$ferohelyek');";
        //echo $sql;
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "INSERT hiba: " . $exc->getMessage();
    }
    header('Location: index.php');
}
?>

<head>
    <title>euro2021</title>
    <meta charset="UTF-8">
    <meta varos="viewport" content="width=device-width, initial-scale=1.0">
    <script src="Forras/kozos/jquery-3.5.1.min.js "></script>
    <script src="Forras/kozos/popper.min.js "></script>
    <script src="Forras/kozos/bootstrap.min.js "></script>
    <link rel="stylesheet" href="Forras/kozos/bootstrap.min.css">
    <link rel="stylesheet" href="Forras/kozos/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="">
        <img src="Forras/kepek/fejlec.png" alt="Fejléc kép" class="w-100 px-3 rounded">

        <nav class="navbar navbar-expand-lg navbar-dark ">
            <a class="navbar-brand" href="#">Euro 2020-2021</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Helyszín szerkesztése</a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Keresés</button>
                </form>
            </div><br>

        </nav>

    </header>
    <main class="row">
        <?php foreach ($adatok as $sor) : ?>
            <img class="card-img-top img-fluid col-md-6" src="Forras/kepek/stadionok/<?= $sor['varos']; ?>.jpg" alt="' <?= $sor['varos']; ?>">
        <?php endforeach; ?>
        <form name="modositas" method="POST" class="col-md-6">
            <input hidden type="text" name="id" id='id' value="<?= $id; ?>" />
            <br><div class="mezo">
                <label for="varos">Város:</label><br>
                <input type="text" name="varos" id='varos' value="<?= $varos ?>" readonly/>
            </div><br>
            <div class="mezo">
                <label for="nev">Név:</label><br>
                <input type="text" name="nev" id='nev' value="<?= $nev ?>" />
            </div><br>
            <div class="mezo">
                <label for="ferohelyek">Leírás:</label><br>
                <input type="number" name="ferohelyek" id='ferohelyek' value="<?= $ferohelyek ?>" />
            </div><br>
            <div class="mezo">
                <label for="orszag">Ország:</label><br>
                <input type="text" name="orszag" id='orszag' value="<?= $orszag ?>" readonly/>
            </div><br>
            <input type="submit" value="Módosítás" name="update" class="btn btn-info"/>
            <a href="index.php" class="btn btn-info float-right" class="modos">Mégsem</a>
        </form>
    </main>
    <footer>&copy; Mekk Elek - 2020.</footer>
</body>
</html>