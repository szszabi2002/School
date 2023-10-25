<!DOCTYPE html>
<?php
include '../common/adatbazis.php';
$name = $address = $postcode = $remark = "";

if (isset($_POST['insert'])) {
    try {
// Form adatok mentése
        $name = $_POST['name'];
        $address = $_POST['address'];
        $postcode = $_POST['postcode'];
        $remark = $_POST['remark'];
//SQL létrehozásaa
        $sql = "INSERT INTO firms (name, address, postcode,remark) VALUES ('$name', '$address', '$postcode','$remark');";
        //echo $sql;
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "INSERT hiba: " . $exc->getMessage();
    }
    header('Location: index.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Új rekord rögzítése</title>
        <!--<link href="db_alap.css" rel="stylesheet" type="text/css"/>-->
        <link href="../common/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <form name="uj_alkalmazott" method="POST">
                <h2>Új Cég adatai:</h2>
                <div class="mezo">
                    <label for="name" class="form-label" >Név:</label>
                    <input type="text" name="name" id='name' value="" class="form-control"/>
                </div>
                <div class="mezo">
                    <label for="address" class="form-label">Cím:</label>
                    <input type="text" name="address" id='adress' value="" class="form-control" />
                </div >
                <div class="mezo">
                    <label for="postcode" class="form-label">Irányítószám:</label>
                    <input type="text" name="postcode" id='postcode' value=""  class="form-control"/>
                </div>
                <div class="mezo">
                    <label for="remark" class="form-label">Megjegyzés:</label>
                    <textarea type="text" name="remark" id='remark' value=""  class="form-control"></textarea>
                </div>
                <input type="submit" value="Rögzítés" name="insert" class="btn btn-success my-3" />
                <a href="index.php" class="btn btn-success my-3" >Mégsem</a>
            </form>

        </div>


        <script src="../common/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
