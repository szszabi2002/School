<!DOCTYPE html>
<?php
include 'adatbazis.php';
try {
    $sql = "SELECT * FROM konyvek";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
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
        <table id="tablazat">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Írók
                    </th>
                    <th>
                        Könyvek címe
                    </th>
                    <th>
                        Kategória
                    </th>
                    <th>
                        Kiadó
                    </th>
                    <th>
                        Kiadás éve
                    </th>
                    <th>
                        Oldalszám
                    </th>
                    <th>
                        Műveletek
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adatok as $sor) : ?>
                <tr>
                    <?php foreach ($sor as $mezo) : ?>
                    <td><?= $mezo; ?></td>
                    <?php endforeach; ?>
                    <td>
                        <a href="torol.php?id='<?= $sor['id']; ?>'"><img class="kep" src="delete.png" alt="Töröl" title="Törlés"></a>
                    </td>
                </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <footer>&copy; Mekk Elek - 2018.</footer>
</body>

</html>