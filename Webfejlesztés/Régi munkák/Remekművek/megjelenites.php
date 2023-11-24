<?php

include 'kapcsolat.php';

try {
	$sql = "SELECT * FROM muvek;";
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
$kategoria = null;
if (isset($_POST['kategoria'])) {
	$kategoria = $_POST['kategoria'];
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
	if ($row['felhasznalonev'] == $name) {
		$privilege =  $row['jogosultsag'];
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
	<title>Remekművek</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="stilus.css">
	<link rel="stylesheet" href="fontawesome/css/all.min.css">
</head>

<body>
	<header>
		<span style="font-size: 18px; font-weight: bold	;">Remekművek</span>
		<span style="float: right;"><a href="index.php" class="btn btn-sm btn-info">Kijelentkezés</a> Felhasználó: <?= $name ?></span>
	</header>
	<div class="row m-3">
		<div class="col-sm-12 col-md-3 col-lg-3 col-xl-2" style="text-align: center;">
			<form method="post">
				<h3>Keresés:</h3>
				<input type="text" name="kereses" id="kereses" class="form-control">
				<br>
				<select name="kategoria" class="form-control">
					<option value="">Válasz Kategóriát</option>
					<option value="Épitmény">Épitmény</option>
					<option value="Szobor">Szobor</option>
					<option value="Festmény">Festmény</option>
				</select>
				<br><br>
				<input type="submit" value="Keresés" class="btn btn-secondary search_btn" style="width: 100%;">
			</form>
			<br><br><br>
			<div style="display: <?php

									if ($privilege == 0) {
										echo "none";
									} else {
										echo "block";
									} ?>;">
				<a href="uj.php?name=<?= $name; ?>" class="btn btn-secondary" style="width:100%;">Hozzáadás</a>

			</div>
		</div>
		<div id="container" class="col-sm-12 col-md-9 col-lg-9 col-xl-10">
			<div class="row">
				<?php
				if ($kereses != null) {
					foreach ($adatok as $sor) {
						if (strpos(strtolower($sor['nev']), strtolower("$kereses")) !== false) {
							echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-3 mb-3"><div class="card">
							  <img class="card-img" class="card-img-top m-0 img-fluid" src="' . $sor['kepek'] . '" alt="' . $sor['nev'] . '">
							  <div class="card-body">
									<h4 class="card-title">' . $sor['nev'] . '</h4>
                                    <p class="card-text">' . $sor['orszag'] . ', ' . $sor['telepules'] . '</p>
									<br>
									<p class="gombok">
									<a href="megtekint.php?ID=' . $sor['ID'] . '&name=' . $name . '"><span class="btn btn-secondary btn-lg btn-block">Megtekint</span></a>
									</p>
							  </div>
						 </div>
						 </div>';
						}
					}
				} else if ($kereses == null && $kategoria != null) {
					foreach ($adatok as $sor) {
						if (strpos($sor['tipus'], $kategoria) !== false) {
							echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-3 mb-3"><div class="card h-100">
							  <img class="card-img" class="card-img-top m-0 img-fluid" src="' . $sor['kepek'] . '" alt="' . $sor['nev'] . '">
							  <div class="card-body">
                              <h4 class="card-title">' . $sor['nev'] . '</h4>
							  <p class="card-text">' . $sor['orszag']   . ', 	' . $sor['telepules'] . '</p>
							  <br>
									</div>
									<div class="card-footer">
									<p class="gombok">
									<a href="megtekint.php?ID=' . $sor['ID'] . '&name=' . $name . '"><span class="btn btn-secondary btn-lg btn-block">Megtekint</span></a>
									</p>
							  </div>
						 </div>
						 </div>';
						}
					}
				} else {
					foreach ($adatok as $sor) {
						echo $kategoria;
						echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mt-3 mb-3"><div class="card h-100">
							  <img class="card-img" class="card-img-top m-0 img-fluid" src="' . $sor['kepek'] . '" alt="' . $sor['nev'] . '">
							  <div class="card-body">
                              <h4 class="card-title">' . $sor['nev'] . '</h4>
							  <p class="card-text">' . $sor['orszag']   . ', 	' . $sor['telepules'] . '</p>
							  <br>
									</div>
									<div class="card-footer">
									<p class="gombok">
									<a href="megtekint.php?ID=' . $sor['ID'] . '&name=' . $name . '"><span class="btn btn-secondary btn-lg btn-block">Megtekint</span></a>
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
	<footer class="footer text-center p-3">
		Készitette: Szincsák Szabolcs, Jakab Dániel, Klepács Roland +1 (Sanyó Zsanett).
	</footer>
</body>

</html>