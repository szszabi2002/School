<?php
include 'kapcsolat.php';
$id = $_GET['ID'];
$name = $_GET['name'];
if (isset($_POST['hozzaad'])) {
    $tipus = $_POST['remekmu'];
    $orszag = $_POST['orszag'];
    $telepules = $_POST['telepules'];
    $nev = $_POST['nev'];
    $kep = $_POST['kep'];
    $letrejovetel_ev = $_POST['letrejovetel_ev'];
    $forras = $_POST['forras'];
    $terkep = $_POST['terkep'];
    $leiras = $_POST['leiras'];

    $data = file_get_contents($_FILES['kep']['tmp_name']);
    $base64 = base64_encode($data);
    $type = $_FILES['kep']['type'];

    $kep = 'data:' . $type . ';' . 'base64, ' . $base64;

    try {
        $sql = "INSERT INTO muvek (tipus, orszag, telepules, nev, kepek) VALUES ('$tipus', '$orszag', '$telepules', '$nev', '$kep')";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo 'Lekérdezési hiba: ' . $exc->getTraceAsString();
    }

    try {
        $sql = "SELECT * FROM muvek";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo 'Lekérdezési hiba: ' . $exc->getTraceAsString();
    }
    $adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    $ID = $adatok[count($adatok) - 1]["ID"];

    $leiras = str_replace("'", "`", $leiras);
    try {
        $sql = "INSERT INTO leiras (muvek_ID, leiras, megepites_eve, forras, terkep) VALUES ('$ID', '$leiras', '$letrejovetel_ev', '$forras', '$terkep')";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo 'Lekérdezési hiba: ' . $exc->getTraceAsString();
    }
    header("Location:megjelenites.php?name=$name");
} else {
    try {
        $sql2 = "SELECT * FROM muvek WHERE ID='$id'";
        $utasitas2 = $dbc->prepare($sql2);
        $utasitas2->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getMessage();
    }
    $muvek = $utasitas2->fetchAll(PDO::FETCH_ASSOC);

    try {
        $sql1 = "SELECT * FROM leiras WHERE muvek_ID='$id'";
        $utasitas1 = $dbc->prepare($sql1);
        $utasitas1->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getMessage();
    }
    $leiras1= $utasitas1->fetchAll(PDO::FETCH_ASSOC);
    
    $tipus1 = $muvek[0]['tipus'];
    $orszag1 = $muvek[0]['orszag'];
    $telepules1 = $muvek[0]['telepules'];
    $nev1 = $muvek[0]['nev'];
    $kepek1 = $muvek[0]['kepek'];
    $leiras1 = $leiras1[0]['leiras'];
    $megepites_eve1 = $leiras1[0]['megepites_eve'];
    $forras1 = $leiras1[0]['forras'];
    $terkep1 = $leiras1[0]['terkep'];
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="uj.css">
    <title>Adat Bevitel</title>
</head>

<body>
    <header>Adat Bevitel</header>
    <div id="container" class="col-8">
        <form action="" method="POST" enctype="multipart/form-data">
            <label class="form-label" for="tipus">Remekmű tipusa:</label><br>
            <select class="form-control" name="remekmu">
                <option value="Épitmény">Épitmény</option>
                <option value="Szobor">Szobor</option>
                <option value="Festmény">Festmény</option>
            </select>
            <br>
            <label class="form-label" for="nev">Remekmű neve:</label>
            <input class="form-control" type="text" name="nev" id="nev" value="<?= $nev; ?>">
            <br>
            <label class="form-label" for="cim">Település:</label>
            <input class="form-control" type="text" name="telepules" id="telepules" value="<?= $telepules; ?>">
            <br>
            <label class="form-label" for="web">Ország:</label>
            <input class="form-control" type="text" name="orszag" id="orszag" value="<?= $orszag; ?>">
            <br>
            <label class="form-label" for="ev">Létrejövetelének éve:</label>
            <input class="form-control" type="text" name="letrejovetel_ev" id="letrejovetel_ev" value="<?= $megepites_eve; ?>">
            <br>
            <label class="form-label" for="map">Google Térkép link</label>
            <input class="form-control" type="text" name="terkep" id="terkep" value="<?= $terkep; ?>">
            <br>
            <label class="form-label" for="kep">Kép:</label>
            <input class="form-control" type="file" name="kep" id="kep" accept="image/png, image/jpg, image/jpeg" value="<?= $kepek; ?>">
            <br>
            <div>
                <label class="form-label" for="leiras">Leírás:</label>
                <br>
                <textarea class="form-control" name="leiras" id="leiras" cols="30" rows="10" value="<?= $leiras; ?>"></textarea>
            </div>
            <br>
            <label class="form-label" for="forras">Forrás</label>
            <input class="form-control" type="text" name="forras" id="forras" value="<?= $forras; ?>">
            <br>
            <input type="submit" class="btn btn-secondary" value="Hozzáadás" name="hozzaad">
            <a href="megjelenites.php?name=<?= $name ?>" class="btn btn-secondary">Vissza</a>
        </form>
    </div>
    <footer class="footer text-center p-3">
        Készitette: Szincsák Szabolcs, Jakab Dániel, Klepács Roland +1 (Sanyó Zsanett).
    </footer>
</body>

</html>