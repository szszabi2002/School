<!DOCTYPE html>
<?php
include 'adatkapcsolat.php';
//print_r($_GET);
$id = $_GET['id'];

try {
    $sql = "SELECT * FROM employees WHERE id=$id";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>DB alapok</title>
    <link href="db_alap.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h4>Alkalmazottak adatai </h4>
    <table>
        <thead>
            <tr>
                <?php foreach ($adatok[0] as $kulcs => $ertek) : ?>
                <th>
                    <?= $kulcs ?>
                </th>
                <?php endforeach; ?>
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
                    <a href="megtekint.php">Megtekint</a>
                    <a href="szerkeszt.php">Szerkeszt</a>
                    <a href="torol.php">Töröl</a>
                </td>
            </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php">Vissza </a>
</body>

</html>