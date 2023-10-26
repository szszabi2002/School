<!DOCTYPE html>
<?php
include 'common/adatkapcsolat.php';

try {
    $sql = "SHOW TABLES;";
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
        <!--<link href="db_alap.css" rel="stylesheet" type="text/css"/>-->
        <link href="common/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <h4 class="text-center my-3">Adatbázis táblák</h4>

            <table class="table table-success table-striped table-responsive w-50 mx-auto ">
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
                                <a href="<?= $mezo ?>/index.php"><span class="badge bg-secondary">Megtekint</span></a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

        <script src="common/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
