<?php
include 'kozos/adatbazis.php';
$db = new DataBase();
if (!$db->ListDatabases('autokolcsonzo')) {
    $db->Create('autokolcsonzo', 'autok');
    $db->ImportData('kozos/autok.csv', 'autokolcsonzo', 'autok');
    $db = new DataBase('autokolcsonzo');
} else {
    $db = new DataBase('autokolcsonzo');
}
try {
    $sql = "SELECT * FROM autok;";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="kozos/css/bootstrap.min.css">
    <link rel="stylesheet" href="kozos/css/style.css">
    <script src="kozos/js/bootstrap.min.js"></script>
    <title>Dolgozat</title>
</head>

<body>
    <div id="container">
        <div class="header"><b>Autókölcsönző</b></div>
        <div class="row">
            <?php foreach ($adatok as $sor) {
                echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-3 mb-3"><div class="card h-100">
							  <div class="card-body">
                              <h4 class="card-title">' . $sor['tipus'] . '</h4>
							  <p class="card-text">Kategória: ' . $sor['kategoria']   . '</p>
							  <p class="card-text">Futtot km: ' . $sor['futott_km'] . '</p>
							  <br>
									</div>
									<div class="card-footer">
									<p class="gombok">
									<a href="megtekint.php?ID=' . $sor['rendszam'] . '"><span class="btn btn-secondary btn-lg btn-block">Megtekint</span></a>
									</p>
							  </div>
						 </div>
						 </div>';
            } ?>
        </div>
    </div>
</body>

</html>