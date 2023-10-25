<!DOCTYPE html>
<?php
include '../common/adatkapcsolat.php';
$id = $empID = $firmID = $begin = $end = "";

function getValues($dbc, $table, $fieldList) {
    try {
        $mezok = "";
        foreach ($fieldList as $field) {
            $mezok .= $field . ", ";
        }
        $mezok = substr($mezok, 0, strlen($mezok) - 2);

        $sql = "SELECT $mezok FROM $table;";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getTraceAsString();
    }
    $values = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    return $values;
}

$empValues = getValues($dbc, 'employees', ['id', 'name']);
$firmValues = getValues($dbc, 'firms', ['id', 'name']);

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $empID = $_POST['empID'];
    $firmID = $_POST['firmID'];
    $begin = $_POST['begin'];
    $end = $_POST['end'];
    try {
        $sql = "UPDATE workers SET empID = '$empID', firmID = '$firmID', begin='$begin', end='$end' WHERE id='$id'";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Frissítési hiba: " . $exc->getMessage();
    }
    header('Location: index.php');
} else {
    $id = $_GET['id'];
    try {
        $sql = "SELECT * FROM workers WHERE id=$id";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getMessage();
    }
    $adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    $empID = $adatok[0]['empID'];
    $firmID = $adatok[0]['firmID'];
    $begin = $adatok[0]['begin'];
    $end = $adatok[0]['end'];
    $id = $adatok[0]['id'];
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
                <h2>Munkaviszony adatainak módosítása </h2>
                <input hidden type="text" name="id" id='id' value="<?= $id; ?>" />

                <div class="mezo">
                    <label for="empID" class="form-label" >Alkalmazott:</label>
                    <select name="empID" id="empID" class="form-select">

                        <?php foreach ($empValues as $value) : ?>
                            <option value="<?= $value['id']; ?>"> <?= $value['name']; ?>  </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mezo">
                    <label for="firmID" class="form-label" >Cég:</label>
                    <select name="firmID" id="firmID" class="form-select">
                        <?php foreach ($firmValues as $value) : ?>
                            <option value="<?= $value['id']; ?>"> <?= $value['name']; ?>  </option>
                        <?php endforeach; ?>
                    </select>
                </div>



                <div class="mezo">
                    <label class="form-label" for="begin">Kezdés:</label>
                    <input type="date" class="form-control" name="begin" id='begin' value="<?= $begin; ?>" />
                </div>
                <div class="mezo">
                    <label class="form-label" for="end">Befejezés:</label>
                    <input type="date" class="form-control" name="end" id='end' value="<?= $end; ?>" />
                </div>
                <input class="btn btn-success my-3"type="submit" value="Módosítás" name="update" />
                <a class="btn btn-success my-3" href="index.php">Mégsem</a>
            </form>
        </div>


        <script src="../common/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
