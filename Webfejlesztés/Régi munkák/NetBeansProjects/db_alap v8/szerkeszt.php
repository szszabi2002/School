<!DOCTYPE html>
<?php
include 'adatkapcsolat.php';
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






if (isset($_POST['insert'])) {
    try {
// Form adatok mentése
        $name = $_POST['name'];
        $address = $_POST['address'];
        $salary = $_POST['salary'];
//SQL létrehozásaa
        $sql = "INSERT INTO employees (name, address, salary) VALUES ('$name', '$address', '$salary');";
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
        <link href="db_alap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="Common/css/bootstrap.rtl.min.css" type="text/css">
    </head>
    <body>
        <form name="uj_alkalmazott" method="POST">
            <h2>Új alkalmazott adatai:</h2>
            <input class="form-control" hidden type="text" name="id" id='id' value="<?= $id; ?>" />
            <div class="mezo">
                <label class="form-label" for="name">Név:</label>
                <input class="form-control" type="text" name="name" id='name' value="<?= $name ?>" />
            </div>
            <div class="mezo">
                <label class="form-label" for="address">Cím:</label>
                <input class="form-control" type="text" name="address" id='adress' value="<?= $address ?>" />
            </div >
            <div class="mezo">
                <label class="form-label" for="salary">Fizetés:</label>
                <input class="form-control" type="text" name="salary" id='salary' value="<?= $salary ?>" />
            </div>
            <input class="form-control" type="submit" value="Módosítás" name="update" />
            <a href="index.php">Mégsem</a>
        </form>


    </body>
</html>
