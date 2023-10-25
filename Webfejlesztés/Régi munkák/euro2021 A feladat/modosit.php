<!DOCTYPE html>
<html lang="hu">
<?php
include 'kapcsolat.php';

$id = $varos = $rovidleiras = $leiras = $nepesseg = $terulet = $orszag = "";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $varos = $_POST['varos'];
    $rovidleiras = $_POST['rovidleiras'];
    $leiras = $_POST['leiras'];
    $nepesseg = $_POST['nepesseg'];
    $terulet = $_POST['terulet'];
    $orszag = $_POST['orszag'];
    try {
        $sql = "UPDATE varosok SET varos = '$varos', rovidleiras = '$rovidleiras', leiras='$leiras', nepesseg='$nepesseg', terulet='$terulet', orszag='$orszag' WHERE id='$id'";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Frissítési hiba: " . $exc->getMessage();
    }
    header('Location: index.php');
} else {
    $id = $_GET['id'];
    try {
        $sql = "SELECT * FROM varosok WHERE id=$id";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getMessage();
    }

    $adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    $varos = $adatok[0]['varos'];
    $rovidleiras = $adatok[0]['rovidleiras'];
    $leiras = $adatok[0]['leiras'];
    $nepesseg = $adatok[0]['nepesseg'];
    $terulet = $adatok[0]['terulet'];
    $orszag = $adatok[0]['orszag'];
    $id = $adatok[0]['id'];
}
if (isset($_POST['insert'])) {
    try {
        // Form adatok mentése
        $varos = $_POST['varos'];
        $rovidleiras = $_POST['rovidleiras'];
        $leiras = $_POST['leiras'];
        $nepesseg = $_POST['nepesseg'];
        $terulet = $_POST['terulet'];
        $orszag = $_POST['orszag'];
        //SQL létrehozásaa
        $sql = "INSERT INTO varosok (varos, rovidleiras, leiras, nepesseg, terulet, orszag) VALUES ('$varos', '$rovidleiras', '$leiras', '$nepesseg', '$terulet', '$orszag');";
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
                    <li class="nav-item">
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
        <img class="card-img-top img-fluid col-md-6" src="Forras/kepek/helyszinek/<?= $sor['varos']; ?>.jpg" alt="' <?= $sor['varos']; ?>">
        <?php endforeach; ?>
        <form name="modositas" method="POST" class="col-md-6">
            <input hidden type="text" name="id" id='id' value="<?= $id; ?>" />
            <div class="mezo">
                <label for="varos">Város:</label><br>
                <input type="text" name="varos" id='varos' value="<?= $varos ?>" readonly />
            </div><br>
            <div class="mezo">
                <label for="rovidleiras">Rövidleírás:</label><br>
                <input type="text" name="rovidleiras" id='rovidleiras' value="<?= $rovidleiras ?>" />
            </div><br>
            <div class="mezo">
                <label for="leiras">Leírás:</label><br>
                <textarea name="leiras" id='leiras'> <?= $leiras ?></textarea>
            </div><br>
            <div class="mezo">
                <label for="nepesseg">Népesség:</label><br>
                <input type="number" name="nepesseg" id='nepesseg' value="<?= $nepesseg ?>" />
            </div><br>
            <div class="mezo">
                <label for="terulet">Terület:</label><br>
                <input type="number" name="terulet" id='terulet' value="<?= $terulet ?>" />
            </div><br>
            <div class="mezo">
                <label for="orszag">Ország:</label><br>
                <input type="text" name="orszag" id='orszag' value="<?= $orszag ?>" readonly />
            </div><br>
            <input type="submit" value="Módosítás" name="update" class="btn btn-info" />
            <a href="index.php" class="btn btn-info float-right" class="modos">Mégsem</a>
        </form>
    </main>
    <footer>&copy; Mekk Elek - 2020.</footer>
</body>

</html>