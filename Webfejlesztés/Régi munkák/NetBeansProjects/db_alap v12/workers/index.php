<!DOCTYPE html>
<?php
include '../common/adatkapcsolat.php';

try {
    $sql = "SELECT * FROM workers";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

function getName($dbc, $table, $id) {
    try {
        $sql = "SELECT * FROM $table WHERE id='$id';";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getTraceAsString();
    }
    $name = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    return $name[0]['name'];
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DB alapok</title>
        <!--<link href="db_alap.css" rel="stylesheet" type="text/css"/>-->
        <link href="../common/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <h4>Munkaviszonyok adatai </h4>
            <a href="uj.php" class="btn btn-success my-3" >Új adat rögzítése</a>
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
                            <?php foreach ($sor as $kulcs => $adat) : ?>
                                <td>
                                    <?php
                                    if ($kulcs == 'empID') {
                                        echo getName($dbc, "employees", $adat);
                                    } else if ($kulcs == 'firmID') {
                                        echo getName($dbc, "firms", $adat);
                                    } else {
                                        echo $adat;
                                    }
                                    ?>
                                </td>
                            <?php endforeach; ?>
                            <td>
                                <a href="megtekint.php?id='<?= $sor['id']; ?>'"><span class="badge bg-secondary">Megtekint</span></a>
                                <a href="szerkeszt.php?id='<?= $sor['id']; ?>'"><span class="badge bg-secondary">Szerkeszt</span></a>
                                <a href="torol.php?id='<?= $sor['id']; ?>'"><span class="badge bg-secondary">Töröl</span></a>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="../index.php" class="btn btn-success my-3">Vissza </a>
        </div>
        <script src="../common/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
