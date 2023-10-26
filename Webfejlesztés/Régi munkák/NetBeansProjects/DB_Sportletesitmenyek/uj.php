<?php

include 'kapcsolat.php';

if (isset($_POST['hozzaad'])) {
	if (isset($_POST['nev'])) {
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
			$sql = "INSERT INTO sportletesitmeny (Letesitmeny, Cim, Leiras, Weboldal, Google_Maps_SRC, Telefonszam, Kep_nev, Megnyitas_eve) VALUES ('$nev','$cim','$leiras', '$web', '$map', '$tel', '$kep', '$ev')";
			$utasitas = $dbc->prepare($sql);
			$utasitas->execute();
		} catch (PDOException $exc) {
			echo "Lekérdezési hiba: " . $exc->getTraceAsString();
		}
	}
	header("Location:letesitmenyek.php");
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
	</header>
	<div class="row m-3">
		<div class="col-2" style="text-align: center;">

		</div>
		<div id="pizza_container" class="col-8">
			<form action="" method="POST" enctype="multipart/form-data">
				<label class="form-label" for="nev">Létesítmény neve:</label>
				<input class="form-control" type="text" name="nev" id="nev">
				<br>
				<label class="form-label" for="cim">Cím:</label>
				<input class="form-control" type="text" name="cim" id="cim">
				<br>
				<label class="form-label" for="web">Weboldal:</label>
				<input class="form-control" type="text" name="web" id="web">
				<br>
				<label class="form-label" for="tel">Telefonszám:</label>
				<input class="form-control" type="text" name="tel" id="tel">
				<br>
				<label class="form-label" for="ev">Megnyitás éve:</label>
				<input class="form-control" type="text" name="ev" id="ev">
				<br>
				<label class="form-label" for="map">Google map embed src</label>
				<input class="form-control" type="text" name="map" id="map">
				<br>
				<label class="form-label" for="">Kép:</label>
				<input class="" type="file" name="kep" id="kep" accept="image/png, image/jpg, image/jpeg">
				<br>
				<div>
					<label class="form-label" for="leiras">Leírás:</label>
					<br>
					<textarea class="form-control" name="leiras" id="leiras" cols="30" rows="10"></textarea>
				</div>
				<br>
				<input type="submit" class="btn btn-secondary" value="Hozzáadás" name="hozzaad">
				<a href="letesitmenyek.php" class="btn btn-secondary">Vissza</a>
			</form>
		</div>
	</div>
	<footer class="container-fluid">
		<p> </p>
	</footer>
</body>

</html>