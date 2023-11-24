<?php
require_once 'kozos/connect.php';

$ID = $nev = $feltetek = $kep = "";

if (isset($_POST['modosit'])) {
    $ID = test_data($_POST['ID']);
    $nev = test_data($_POST['nev']);
    $feltetek = test_data($_POST['feltetek']);
    $ar = test_data($_POST['ar']);
    $kep = test_data($_POST['kep']);

    $sql = "UPDATE pizzak  SET nev = :nev, feltetek = :feltetek, ar = :ar, kep = :kep WHERE ID = :ID";
    $stmt = $dbc->prepare($sql);
    $stmt->bindParam(':ID', $ID);
    $stmt->bindParam(':nev', $nev);
    $stmt->bindParam(':feltetek', $feltetek);
    $stmt->bindParam(':ar', $ar);
    $stmt->bindParam(':kep', $kep);
    $stmt->execute();
    header('Location: index.php');
} else {
    $sql = "SELECT * FROM pizzak WHERE ID =" . $_GET['ID'];
    $stmt = $dbc->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $ID = $data[0]['ID'];
    $nev = $data[0]['nev'];
    $feltetek = $data[0]['feltetek'];
    $ar = $data[0]['ar'];
    $kep = $data[0]['kep'];
}

if (isset($_POST['megsem'])) {
    header('Location: index.php');
}
$ID = $_GET['ID'];
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

                        <form class="mx-auto my-3 " name="modosit" method="POST" style="width: 40rem;">
                            <input type='hidden' name='ID' value="<?= $row['ID']; ?>"  />
                            <div class="mb-3">
                                <label class="form-label" for='nev'> A pizza neve: </label>
                                <input class="form-control" type="text" name="nev" value="<?= $row['nev']; ?>"  />
                            </div>
                            <div class="mb-3">
                                <label class="form-label"for='ar'> Ár: </label>
                                <input class="form-control" type="text" name="ar" value="<?= $row['ar']; ?>"  />
                            </div>
                            <div class="mb-3">
                                <label class="form-label"for='feltetek'> Feltétek: </label>
                                <textarea class=" form-control" name="feltetek"  ><?= $row['feltetek']; ?>  </textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"for='kep'> Kép neve:  (Itt adja meg a képek mappába feltöltött kép nevét!) </label>
                                <input class="form-control" name="kep" value="<?= $row['kep']; ?>" />
                            </div>
                            <div class="mx-auto text-center">
                                <input class="btn btn-success" type="submit" value="Módosít" name="modosit" />
                                <input class="btn btn-success" type="submit" value="Mégse" name="megsem"/>
                            </div>
                        </form>

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




