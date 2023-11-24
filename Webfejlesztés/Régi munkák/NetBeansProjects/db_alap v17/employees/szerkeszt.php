<!DOCTYPE html>
<?php
include '../common/adatbazis.php';
$id = $name = $address = $salary = "";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];
    try {
        $sql = "UPDATE employees SET name = '$name', address = '$address', salary='$salary' WHERE id='$id'";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Frissítési hiba: " . $exc->getMessage();
    }
    header('Location: index.php');
} else {
    $id = $_GET['id'];
    try {
        $sql = "SELECT * FROM employees WHERE id=$id";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getMessage();
    }

    $adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    $name = $adatok[0]['name'];
    $address = $adatok[0]['address'];
    $salary = $adatok[0]['salary'];
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
                <h2>Új alkalmazott adatai:</h2>
                <input hidden type="text" name="id" id='id' value="<?= $id; ?>" />
                <div class="mezo">
                    <label class="form-label" for="name">Név:</label>
                    <input type="text" class="form-control" name="name" id='name' value="<?= $name ?>" />
                </div>
                <div class="mezo">
                    <label class="form-label" for="address">Cím:</label>
                    <input type="text" class="form-control" name="address" id='adress' value="<?= $address ?>" />
                </div >
                <div class="mezo">
                    <label class="form-label" for="salary">Fizetés:</label>
                    <input type="text" class="form-control" name="salary" id='salary' value="<?= $salary ?>" />
                </div>
                <input class="btn btn-success my-3"type="submit" value="Módosítás" name="update" />
                <a class="btn btn-success my-3" href="index.php">Mégsem</a>
            </form>
        </div>


        <script src="../common/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>
