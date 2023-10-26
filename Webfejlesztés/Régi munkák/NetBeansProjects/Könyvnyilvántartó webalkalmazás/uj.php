<!DOCTYPE html>
<?php
include 'adatbazis.php';
$irok = $konyv = $kategoria = $kiado = $kiadas_eve = $oldalszam = "";

if (isset($_POST['insert'])) {
    if (empty($_POST['irok']) || empty($_POST['konyv']) || empty($_POST['kategoria']) || empty($_POST['kiado']) || empty($_POST['kiadas_eve']) || empty($_POST['oldalszam'])) {
        echo "<script> alert('Minden mező legyen kitöltve!'); </script>";
    } else {
        try {
            $irok = $_POST['irok'];
            $konyv = $_POST['konyv'];
            $kategoria = $_POST['kategoria'];
            $kiado = $_POST['kiado'];
            $kiadas_eve = $_POST['kiadas_eve'];
            $oldalszam = $_POST['oldalszam'];
            $sql = "INSERT INTO konyvek (irok, konyv, kategoria, kiado, kiadas_eve, oldalszam) VALUES ('$irok', '$konyv', '$kategoria', '$kiado', '$kiadas_eve', '$oldalszam');";
            $utasitas = $dbc->prepare($sql);
            $utasitas->execute();
        } catch (PDOException $exc) {
            echo "INSERT hiba: " . $exc->getMessage();
        }
        echo "<script> alert('Sikeres adatfelvétel!'); </script>";
    }
}
?>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Könyvnyilvántartó webalkalmazás</title>
</head>

<body>
    <header>Könyvtáram kincsei</header>
    <nav>
        <ul>
            <li><button onclick="location.href='index.php'">Nyitólap</button></li>
            <li><button onclick="location.href='listazas.php'">Könyveim</button></li>
            <li><button onclick="location.href='uj.php'">Könyv felvittel</button></li>
        </ul>
        <a class="menukep" href="listazas.php"><img src="menu_background.jpg" alt="Menű kép"></a>
    </nav>
    <main>
        <form id="uj" name="uj_alkalmazott" method="POST">
            <div class="mezo">
                <label for="irok" class="form-label">Írók</label>
                <input type="text" name="irok" id='irok' value="" class="form-control" />
            </div>
            <div class="mezo">
                <label for="konyv" class="form-label">Könyv címe</label>
                <input type="text" name="konyv" id='konyv' value="" class="form-control" />
            </div>
            <div class="mezo">
                <label for="kategoria" class="form-label">Kategória</label>
                <input type="text" name="kategoria" id='kategoria' value="" class="form-control" />
            </div>
            <div class="mezo">
                <label for="kiado" class="form-label">Kiadó</label>
                <input type="text" name="kiado" id='kiado' value="" class="form-control" />
            </div>
            <div class="mezo">
                <label for="kiadas_eve" class="form-label">Kiadás éve</label>
                <input type="number" name="kiadas_eve" id='kiadas_eve' value="" max="2018" class="form-control" />
            </div>
            <div class="mezo">
                <label for="oldalszam" class="form-label">Oldalszám</label>
                <input type="number" name="oldalszam" id='oldalszam' value="" class="form-control" />
            </div>
            <input id="add" type="submit" value="Adatok mentése" name="insert" class="form-control" />
        </form>
    </main>
    <footer>&copy; Mekk Elek - 2018.</footer>
</body>

</html>