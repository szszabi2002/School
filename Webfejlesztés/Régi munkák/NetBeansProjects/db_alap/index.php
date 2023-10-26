<!DOCTYPE html>
<?php
include 'adatkapcsolat.php';

try {
    $sql = "SELECT * FROM employees";
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
        <link href="db_alap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h4>Alkalmazottak adatai </h4>
        <a href="uj.php">Új adat rögzítése</a>
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
                            <a href="megtekint.php?id='<?= $sor['id']; ?>'">Megtekint</a>
                            <a href="szerkeszt.php?id='<?= $sor['id']; ?>'">Szerkeszt</a>
                            <a href="torol.php?id='<?= $sor['id']; ?>'">Töröl</a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>





    </body>
</html>
