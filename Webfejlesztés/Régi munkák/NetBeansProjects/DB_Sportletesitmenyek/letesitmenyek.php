<?php

include 'kapcsolat.php';

try {
	$sql = "SELECT * FROM sportletesitmeny;";
	$utasitas = $dbc->prepare($sql);
	$utasitas->execute();
} catch (PDOException $exc) {
	echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);

$kereses = null;
if (isset($_POST['kereses'])) {
	$kereses = $_POST['kereses'];
}

$name = $_GET['name'];

try {
	$sql = "SELECT * FROM felhasznalok;";
	$utasitas = $dbc->prepare($sql);
	$utasitas->execute();
} catch (PDOException $exc) {
	echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
$users = $utasitas->fetchAll(PDO::FETCH_ASSOC);

$privilege = 0;
foreach ($users as $row) {
	if ($row['username'] == $name) {
		$privilege =  $row['privilege'];
		break;
	}
}

?>

<!DOCTYPE html>
<html lang="hu">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Debrecen sportlétesítményei</title>
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/bootstrap-icons.css">
	<script src="bootstrap/jquery-3.5.1.min.js"></script>
	<script src="bootstrap/popper.min.js"></script>
	<script src="bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" href="stilus.css">
	<link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<body>
	<header>
		<img src="img/DB_Logo.png" alt="Debrecen címere" style="height: 50px;">
		<span style="font-size: 18px; font-weight: bold	;">Debrecen sportlétesítményei</span>
		<span style="float: right;"><a href="index.php" class="btn-sm btn-warning">Kijelentkezés</a> Felhasználó: <?= $name ?></span>
	</header>
	<div class="row m-3">
		<div class="col-sm-12 col-md-3 col-lg-3 col-xl-2" style="text-align: center;">
			<form method="post">
				<h3>Keresés:</h3>
				<input type="text" name="kereses" id="kereses" class="form-control">
				<br>
				<input type="submit" value="Keresés" class="btn btn-secondary search_btn" style="width: 100%;">
			</form>
			<br><br><br>
			<div style="display: <?php

									if ($privilege == 0) {
										echo "none";
									} else {
										echo "block";
									} ?>;">
				<a href="uj.php" class="btn btn-secondary" style="width:100%;">Hozzáadás</a>

			</div>
		</div>
		<div id="pizza_container" class="col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<div class="row">
				<?php
				if ($kereses != null) {
					foreach ($adatok as $sor) {
						$kep = explode(';', $sor['Kep_nev']);
						if (strpos(strtolower($sor['Letesitmeny']), strtolower("$kereses")) !== false) {
							echo '<div class="col-md-6 col-lg-4 mt-3 mb-3"><div class="card">
							  <img class="card_img" class="card-img-top img-fluid" src="data:' . $kep['0'] . ';base64, ' . $kep['1'] . '" alt="' . $sor['Letesitmeny'] . '">
							  <div class="card-body">
									<h4 class="card-title">' . $sor['Letesitmeny'] . '</h4>
									<br>
									<p class="gombok">
									<a href="megtekint.php?id=' . $sor['ID'] . '&name=' . $name . '"><span class="btn btn-secondary btn-lg btn-block">Megtekint</span></a>
									</p>
							  </div>
						 </div>
						 </div>';
						}
					}
				} else {
					foreach ($adatok as $sor) {
						$kep = explode(';', $sor['Kep_nev']);
						echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-3 mb-3"><div class="card h-100">
							  <img class="card_img" class="card-img-top img-fluid" src="data:' . $kep['0'] . ';base64, ' . $kep['1'] . '" alt="' . $sor['Letesitmeny'] . '">
							  <div class="card-body">
									<h4 class="card-title">' . $sor['Letesitmeny'] . '</h4>
									<br>
									</div>
									<div class="card-footer">
									<p class="gombok">
									<a href="megtekint.php?id=' . $sor['ID'] . '&name=' . $name . '"><span class="btn btn-secondary btn-lg btn-block">Megtekint</span></a>
									</p>
									
							  </div>
						 </div>
						 </div>';
					}
				}
				?>
			</div>
		</div>

	</div>
	<footer class="container-fluid">
		<p> </p>
	</footer>
</body>

</html>