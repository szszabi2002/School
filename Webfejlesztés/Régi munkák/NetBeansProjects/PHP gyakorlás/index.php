<!DOCTYPE html>
<?php
include 'Database.php';

try {
    $sql = 'SELECT * FROM employees';
    $utasitások = $dbc->prepare($sql);
    $utasitások->execute();
} catch (PDOException $exc) {
    echo 'Lekérdezési hiba: ' . $exc->getTraceAsString();
}
$adatok = $utasitások->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="">
</head>

<body>
    <h4>Alkamazotak adatai</h4>
    <a href="űrlap.php">Új rekord rögzitése</a>
    <table>
        <thead>
            <tr>
                <?php foreach (array_keys($adatok[0]) as $ertek): ?>
                <th>
                    <?= $ertek ?>
                </th>
                <?php endforeach; ?>
                <th>
                    Műveletek
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($adatok as $sor): ?>
            <tr>
                <?php foreach ($sor as $mezo): ?>
                <td><?= $mezo ?></td>
                <?php endforeach; ?>
                <td>
                <a href="megtekintes.php?id='<?= $sor['id'] ?>'">Megtekint</a>
                <a href="szerkesztes.php?id='<?= $sor['id'] ?>'">Szerkesztés</a>
                <a href="torles.php?id='<?= $sor['id'] ?>'">Törlés</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>