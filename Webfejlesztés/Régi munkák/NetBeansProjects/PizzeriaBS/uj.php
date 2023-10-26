<?php
require_once 'kozos/connect.php';

$ID = $nev = $feltetek = $ar = $kep = "";

if (isset($_POST['beszur'])) {
    $ID = test_data($_POST['ID']);
    $nev = test_data($_POST['nev']);
    $feltetek = test_data($_POST['feltetek']);
    $ar = test_data($_POST['ar']);
    $kep = test_data($_POST['kep']);

    $sql = "INSERT pizzak (nev, feltetek, ar, kep) VALUES (:nev, :feltetek, :ar, :kep)";
    $stmt = $dbc->prepare($sql);
    $stmt->bindParam(':nev', $nev);
    $stmt->bindParam(':feltetek', $feltetek);
    $stmt->bindParam(':ar', $ar);
    $stmt->bindParam(':kep', $kep);
    $stmt->execute();
    header('Location: index.php');
}

if (isset($_POST['megsem']))  {
   header('Location: index.php');
}
$keres = "";
?>


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
                    <h2>Pizzéria adat feltöltő oldala - Új pizza felvitele</h2>
                </div>

                <div class="col-2 order-0" style="background-image: url('img/pizzabg.jpg'); " >
                    <div class="text-center my-3" >
                        <a class="btn btn-danger" href="uj.php">Új pizza rögzítése</a>
                    </div>

                </div>

                <div class="row col-8 order-1">


                    <form class="mx-auto my-3 " name="modosit" method="POST" style="width: 40rem;">
                        <div class="mb-3">
                            <label class="form-label" for='nev'> A pizza neve: </label>
                            <input class="form-control" type="text" name="nev" value=""  />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"for='ar'> Ár: </label>
                            <input class="form-control" type="text" name="ar" value=""  />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"for='feltetek'> Feltétek: </label>
                            <textarea class=" form-control" name="feltetek"  >  </textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"for='kep'> Kép neve:  (Itt adja meg a képek mappába feltöltött kép nevét!) </label>
                            <input class="form-control" name="kep" value="" />
                        </div>
                        <div class="mx-auto text-center">
                            <input class="btn btn-success" type="submit" value="Mentés" name="beszur" />
                            <input class="btn btn-success" type="submit" value="Mégse" name="megsem"/>
                        </div>
                    </form>


                </div>
                <div class=" order-3 col-12 bg-secondary text-light text-center py-3">
                    <h4>&copy Mekk Elek - 2021.</h4>
                </div>
            </div>

        </div>
        <script src="kozos/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>


