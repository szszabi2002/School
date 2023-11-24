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
        <link rel="stylesheet" href="Common/css/bootstrap.rtl.min.css" type="text/css">
    </head>
    <body>
        <h4>Alkalmazottak adatai </h4>
        <a href="uj.php">Új adat rögzítése</a>
        <table class="table table-success table-striped table-responsive">
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
                            <a class="badge bg-secondary" href="megtekint.php?id='<?= $sor['id']; ?>'"><span class="badge bg-secondary" >Megtekint</span></a>
                            <a class="badge bg-secondary" href="szerkeszt.php?id='<?= $sor['id']; ?>'"><span class="badge bg-secondary" >Szerkeszt</span></a>
                            <a href="torol.php?id='<?= $sor['id']; ?>'"><span class="badge bg-secondary" >Töröl</span></a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>





    </body>
</html>
