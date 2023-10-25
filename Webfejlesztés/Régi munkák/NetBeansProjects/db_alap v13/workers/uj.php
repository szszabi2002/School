<!DOCTYPE html>
<?php
include '../common/adatkapcsolat.php';
$empID = $firmID = $begin = $end = '';

function getValues($dbc, $table, $fieldList)
{
    try {
        $mezok = '';
        foreach ($fieldList as $field) {
            $mezok .= $field . ', ';
        }

        $mezok = substr($mezok, 0, strlen($mezok) - 2);
        $sql = "SELECT $mezok FROM $table;";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo 'Lekérdezési hiba: ' . $exc->getTraceAsString();
    }
    $values = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    return $values;
}

$empValues = getValues($dbc, 'employees', ['id', 'name']);
$firmValues = getValues($dbc, 'firms', ['id', 'name']);

if (isset($_POST['insert'])) {
    try {
        // Form adatok mentése
        $empID = $_POST['empID'];
        $firmID = $_POST['firmID'];
        $begin = $_POST['begin'];
        $end = $_POST['end'];
        //SQL létrehozásaa
        $sql = "INSERT INTO employees (empID, firmID, begin,end) VALUES ('$empID', '$firmID', '$begin', '$end');";
        //echo $sql;
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo 'INSERT hiba: ' . $exc->getMessage();
    }
    header('Location: index.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Új munkaviszony rögzítése</title>
        <!--<link href="db_alap.css" rel="stylesheet" type="text/css"/>-->
        <link href="../common/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <form name="uj_workers" method="POST">
                <h2>Új Munkaviszony adatai:</h2>
                <div class="mezo">
                    <select name="empID" id="empID" class="form-select">
                        <label for="empID" class="form-label" >Alkalmazott:</label>
                        <?php foreach ($empValues as $value): ?>
                            <option value="<?= $value['id'] ?>"> <?= $value['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mezo">
                    <label for="firmID" class="form-label">Cég:</label>
                    <input type="text" name="firmID" id='adress' value="" class="form-control" />
                </div >
                <div class="mezo">
                    <label for="begin" class="form-label">Kezdés:</label>
                    <input type="text" name="begin" id='begin' value=""  class="form-control"/>
                </div>
                <div class="mezo">
                    <label for="begin" class="form-label">Befejezés:</label>
                    <input type="text" name="begin" id='begin' value=""  class="form-control"/>
                </div>
                <input type="submit" value="Rögzítés" name="insert" class="btn btn-success my-3" />
                <a href="index.php" class="btn btn-success my-3" >Mégsem</a>
            </form>

        </div>


        <script src="../common/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
