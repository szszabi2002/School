<?php
include 'kapcsolat.php';
$id = $_GET['id'];
$queryids = "SELECT * FROM adatok WHERE id='$id'";
$utasitas = $dbc->prepare($queryids);
$utasitas->execute();
$adatids = $utasitas->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="stilus.css?=<?= rand(1, 32000) ?>">
    <title>Megtekintés</title>
</head>

<body>
    <div class="grid-container">
        <div class="nav">
            <?php
            include 'header.php';
            ?>
        </div>
        <br>
        <div class="main">
            <div class="container-fluid">
                <div class="my-3 col-md-6 offset-md-3 col-xl-4 offset-xl-4 ">
                    <div class="card card-body float-center" style="width: 65rem; margin:0 auto;">
                        <h3 class="card-title text-center ">Megtekintés</h3>
                        <div class="form-group">

                            <br>
                            <?php foreach ($adatids as $sors) : ?>
                                <img src="kepek/adatok/<?= $sors["kep"] ?>?<?= rand(1, 32000) ?>" id="kep" class="form-control w-50">
                            <?php endforeach; ?>
                            <?php foreach ($adatids as $sors) : ?>
                                <label for="leiras" style="float:inherit;">Leírás</label>
                                <textarea class="form-control w-50" id="leiras" name="textupdate" cols="30" rows="12" disabled style="margin:4px; padding:10px;"><?= $sors['leiras'] ?></textarea>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group">
                            <?php foreach ($adatids as $sors) : ?>
                                <br><a href="kivalaszt.php?id=<?= $sors['id'] ?>"><button type="button" class="btn btn-dark w-100">Vissza az előző oldalra</button></a>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>
            <br>
            <div class="footer">
                <?php
                include 'footer.php';
                ?>
            </div>

        </div>

</body>

</html>