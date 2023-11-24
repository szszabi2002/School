<!DOCTYPE html>
<?php
include 'adatbazis.php';
$id = $_GET['id'];
if (isset($_POST['torol'])) {
    try {
        $sql = "DELETE FROM konyvek WHERE id=$id";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getTraceAsString();
    }

    header('Location: listazas.php');
} else if (isset($_POST['megsem'])) {
    header('Location: listazas.php');
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
        <div class="valasz">
            <?php
            echo "<p>Biztosan törölni akarod a(z) $id. rekordot?</p>"
            ?>
            <form method="post">
                <input type="submit" name="torol" value="Igen">
                <input type="submit" name="megsem" value="Nem">
            </form>
        </div>
    </main>
    <footer>&copy; Mekk Elek - 2018.</footer>
</body>

</html>