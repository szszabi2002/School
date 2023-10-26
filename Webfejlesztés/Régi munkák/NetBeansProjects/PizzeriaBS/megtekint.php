<?php
require_once 'kozos/connect.php';

$keres = "";

$sql = "SELECT * FROM pizzak WHERE ID =" . $_GET['ID'];
$stmt = $dbc->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Pizzák </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="kozos/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row" >
                <div class="col-12 bg-danger text-light py-3 sticky-top">
                    <?php foreach ($data as $row) : ?>
                        <h2>Pizzéria adat feltöltő oldala - <?= $row['nev']; ?> </h2>
                    <?php endforeach; ?>
                </div>

                <div class="col-2 order-0" style="background-image: url('img/pizzabg.jpg'); " >
                    <div class="text-center my-3" >
                        <a class="btn btn-danger" href="uj.php">Új pizza rögzítése</a>
                    </div>

                </div>
                <div class="row col-8 order-1">

                    <?php foreach ($data as $row) : ?>
                        <div class="card mx-auto my-3" style="width: 40rem;" >
                            <div>
                                <input type='type' hidden name='ID' value="<?= $row['ID']; ?>" />
                                <img class="card-img-top img-fluid rounded-3" src='img/<?= $row['kep']; ?>'>
                                <div class="card-body">
                                    <h5 class='card-title' name='nev'><?= $row['nev']; ?></h5>
                                    <p class="card-text my-3"><span class="fw-bold" >Feltétek: </span><br> <?= $row['feltetek']; ?></p>
                                    <p class="card-text my-3"><span class="fw-bold" >Ár: </span><span class="text-danger fw-bold"><?= $row['ar']; ?> Ft</span></p>
                                </div>
                            </div>
                            <a class="my-3 btn btn-success " href="index.php?">Vissza</a>
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

