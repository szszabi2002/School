<!DOCTYPE html>
<html lang="hu">
<?php
include 'adatkapcsolat.php';

$id = $nev = $feltetek = $ar = $kep = "";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nev = $_POST['nev'];
    $feltetek = $_POST['feltetek'];
    $ar = $_POST['ar'];
    $kep = $_POST['kep'];
    try {
        $sql = "UPDATE pizzak SET nev = '$nev', feltetek = '$feltetek', ar='$ar', kep='$kep', WHERE ID='$id'";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Frissítési hiba: " . $exc->getMessage();
    }
    header('Location: index.php');
} else {
    $id = $_GET['id'];
    try {
        $sql = "SELECT * FROM pizzak WHERE ID=$id";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getMessage();
    }

    $adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    $nev = $adatok[0]['nev'];
    $feltetek = $adatok[0]['feltetek'];
    $ar = $adatok[0]['ar'];
    $kep = $adatok[0]['kep'];
    $id = $adatok[0]['ID'];
}
if (isset($_POST['insert'])) {
    try {
        // Form adatok mentése
        $nev = $_POST['nev'];
        $feltetek = $_POST['feltetek'];
        $ar = $_POST['ar'];
        $kep = $_POST['kep'];
        //SQL létrehozásaa
        $sql = "INSERT INTO pizzak (nev, feltetek, ar, kep) VALUES ('$nev', '$feltetek', '$ar', '$kep');";
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
    <title>Pizzéria</title>
    <meta charset="UTF-8">
    <meta nev="viewport" content="width=device-width, initial-scale=1.0">
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
    <main class="row">
        <form name="modositas" method="POST" class="col-md-8">
            <input hidden type="text" name="id" id='id' value="<?= $id; ?>" />
            <div class="mezo">
                <label for="nev">A pizza neve:</label><br>
                <input type="text" name="nev" id='nev' value="<?= $nev ?>"/>
            </div><br>
            <div class="mezo">
                <label for="ar">Ár:</label><br>
                <input type="number" name="ar" id='ar' value="<?= $ar ?>" />
            </div><br>
            <div class="mezo">
                <label for="feltetek">Feltétek:</label><br>
                <textarea name="feltetek" id='feltetek'> <?= $feltetek ?></textarea>
            </div><br>
            <div class="mezo">
                <label for="kep">Kép neve: (Itt adja meg a képek mappába feltölttött kép nevét!)</label><br>
                <input type="text" name="kep" id='kep' value="<?= $kep ?>" />
            </div><br>
            <input type="submit" value="Módosítás" name="update" class="btn btn-success"/>
            <a href="index.php" class="btn btn-success float-right">Mégsem</a>
        </form>
    </main>
    <footer class="btn btn-block btn-secondary">&copy; Mekk Elek - 2021.</footer>
</body>
</html>