<!DOCTYPE html>

<?php
require 'kozos/connect.php';

$keres = isset($_POST['keres']) ? test_data($_POST['keres']) : '';
$keres = isset($_POST['torol']) ? '' : $keres;

if (isset($_POST['kereses']) && $_POST['keres'] != '') {
    $sql =
        'SELECT * FROM  pizzak WHERE' .
        " UPPER(nev) LIKE UPPER('%" .
        $_POST['keres'] .
        "%');";
} else {
    $sql = 'SELECT * FROM  pizzak;';
}
//echo $sql;
$stmt = $dbc->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['torol'])) {
    $sql = 'DELETE FROM pizzak WHERE id = ' . $_GET['ID'];
    $stmt = $dbc->prepare($sql);
    $stmt->execute();
    header('Location: index.php');
}
?>


<html>

<head>
    <meta charset="UTF-8">
    <title>Pizzák </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="kozos/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 bg-danger text-light py-3 sticky-top">
                <h2>Pizzéria adat feltöltő oldala - Pizzák</h2>
            </div>

            <div class="col-2 order-0" style="background-image: url('img/pizzabg.jpg'); ">
                <div class="text-center my-3">
                    <a class="btn btn-danger" href="uj.php">Új pizza rögzítése</a>
                </div>

            </div>
            <div class="col-2 order-2 text-center" style="background-image: url('img/pizzabg.jpg'); ">
                <h2>Keresés:</h2>
                <form method="POST">
                    <input type="text" name="keres" value="<?= $keres ?>" placeholder="" />
                    <div>
                        <input class="my-3 btn btn-success" type="submit" value="Keresés" name="kereses" />
                        <input class="my-3 btn btn-success" type="submit" value="Mindent mutat" name="torol" />
                    </div>
                </form>
            </div>
            <div class="row col-8 order-1">

                <?php foreach ($data as $row): ?>
                <div class="card m-3" style="width: 22rem;">
                    <div>
                        <input type='txt' hidden name='ID' value="<?= $row[
                                'ID'
                            ] ?>" />
                        <img class="card-img-top img-fluid rounded-3" src='img/<?= $row[
                                'kep'
                            ] ?>'>
                        <div class="card-body">
                            <h5 class='card-title' name='nev'><?= $row[
                                    'nev'
                                ] ?></h5>
                            <a class="btn btn-success" href="megtekint.php?ID='<?= $row[
                                    'ID'
                                ] ?>'">Megtekint</a>
                            <a class="btn btn-success" href="modosit.php?ID='<?= $row[
                                    'ID'
                                ] ?>'">Szerkeszt</a>
                            <a class="btn btn-success" href="index.php?ID='<?= $row[
                                    'ID'
                                ] ?>'&torol='igen'">Töröl</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
            <div class=" order-3 col-12 bg-secondary text-light text-center py-3">
                <h4>&copy Mekk Elek - 2021.</h4>
            </div>
        </div>

    </div>
    <script src="kozos/js/bootstrap.min.js" type="text/javascript"></script>
</body>

</html>