<!DOCTYPE html>
<?php
include '../common/adatbazis.php';
//print_r($_GET);
$id = $_GET['id'];

try {
    $sql = "SELECT * FROM firms WHERE id=$id";
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
        <link href="../common/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <h4>Cég adatai </h4>
            <ul class="list-group list-group-flush" >
                <?php foreach ($adatok[0] as $kulcs => $ertek) : ?>
                    <li  class="list-group-item" ><?= $kulcs ?> : <?= $ertek; ?></li>
                <?php endforeach; ?>
            </ul>


            <a href="index.php" class="btn btn-success my-3">Vissza </a>
        </div>

        <script src="../common/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
