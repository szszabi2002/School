<!DOCTYPE html>
<?php
include 'kapcsolat.php';
$id = $_GET['id'];

try {
	$sql = "SELECT * FROM sportletesitmeny WHERE ID='$id'";
	$utasitas = $dbc->prepare($sql);
	$utasitas->execute();
} catch (PDOException $exc) {
	echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);

$nev = $feltetek = $ar = $kep = "";

//nev feltetek ar kep

foreach ($adatok as $key => $value) {
	$Letesitmeny = $value['Letesitmeny'];
	$Cim = $value['Cim'];
	$Leiras = $value['Leiras'];
	$Weboldal = $value['Weboldal'];
	$Google_Maps_SRC = $value['Google_Maps_SRC'];
	$Telefonszam = $value['Telefonszam'];
	$Megnyitas_eve = $value['Megnyitas_eve'];

	$kep = explode(';', $value['Kep_nev']);
}

if (isset($_POST['szerkeszt'])) {
	$nev = $_POST['nev'];
	$cim = $_POST['cim'];
	$web = $_POST['web'];
	$tel = $_POST['tel'];
	$ev = $_POST['ev'];
	$map = $_POST['map'];
	$leiras = $_POST['leiras'];

	$data = file_get_contents($_FILES['kep']['tmp_name']);
	$base64 = base64_encode($data);
	$type = $_FILES['kep']['type'];

	$kep = $type . ';' . $base64;

	try {
		//$sql = "INSERT INTO sportletesitmeny (Letesitmeny, Cim, Leiras, Weboldal, Google_Maps_SRC, Telefonszam, Kep_nev, Megnyitas_eve) VALUES ('$nev','$cim','$leiras', '$web', '$map', '$tel', '$kep', '$ev')";
		if ($_FILES['kep']['error'] == 4)
			$sql = "UPDATE sportletesitmeny SET Letesitmeny = '$nev', Cim = '$cim', Leiras = '$leiras', Weboldal = '$web', Google_Maps_SRC = '$map', Telefonszam = '$tel', Megnyitas_eve = '$ev' WHERE ID = '$id'";
		else
			$sql = "UPDATE sportletesitmeny SET Letesitmeny = '$nev', Cim = '$cim', Leiras = '$leiras', Weboldal = '$web', Google_Maps_SRC = '$map', Telefonszam = '$tel', Kep_nev = '$kep', Megnyitas_eve = '$ev' WHERE ID = '$id'";
		$utasitas = $dbc->prepare($sql);
		$utasitas->execute();
	} catch (PDOException $exc) {
		echo "Lekérdezési hiba: " . $exc->getTraceAsString();
	}

	header("Location:letesitmenyek.php");
}

?>

<html lang="hu">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sportlétesítmény adatai</title>
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
	</header>
	<div class="row m-3">
		<div class="col-2" style="text-align: center;">

		</div>
		<div id="pizza_container" class="col-8">
			<form action="" method="POST" enctype="multipart/form-data">
				<label class="form-label" for="nev">Név:</label><br>
				<input class="form-control" type="text" name="nev" id="nev" value="<?= $Letesitmeny ?>">
				<br>
				<label class="form-label" for="leiras">Leírás</label><br>
				<textarea class="form-control" name="leiras" id="leiras" rows="5"><?= $Leiras ?></textarea>
				<br>
				<label class="form-label" for="ev">Megnyitás éve:</label><br>
				<input class="form-control" type="number" name="ev" id="ev" value="<?= $Megnyitas_eve ?>">
				<br>
				<label class="form-label" for="cim">Cím:</label><br>
				<input class="form-control" type="text" name="cim" id="cim" value="<?= $Cim ?>">
				<br>
				<label class="form-label" for="tel">Telefonszám:</label><br>
				<input class="form-control" type="tel" name="tel" id="tel" value="<?= $Telefonszam ?>">
				<br>
				<label class="form-label" for="web">Weboldal:</label><br>
				<input class="form-control" type="text" name="web" id="web" value="<?= $Weboldal ?>">
				<br>
				<label class="form-label" for="map">Google map embed src:</label><br>
				<input class="form-control" type="text" name="map" id="map" value="<?= $Google_Maps_SRC ?>">
				<br>
				<label class="form-label" for="kep">Új kép:</label>
				<input class="" type="file" name="kep" id="kep" accept="image/png, image/jpg, image/jpeg">
				<br><br>
				<input class="btn btn-secondary" style="width: 100%;" type="submit" value="Szerkeszt" name="szerkeszt" id="szerkeszt">
			</form>
			<br>
			<a href="letesitmenyek.php" class="btn btn-secondary" style="width: 100%;">Vissza</a>
		</div>

	</div>
	<footer class="container-fluid">
		<p> </p>
	</footer>
</body>

</html>