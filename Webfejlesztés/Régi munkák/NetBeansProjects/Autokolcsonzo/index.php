<?php
include 'adatbazis.php';
try {
    $sql = "SELECT * FROM autok";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Autókölcsönző</title>
</head>
<body>
<table class="table table-success table-striped table-responsive">
            <thead>
                <tr>
                    <th>Rendszám</th>
                    <th>Típus</th>
                    <th>Kategória</th>
                    <th>Vásárlás dátuma</th>
                    <th>Ár</th>
                    <th>Futott_km</th>
                    <th>Állapot</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adatok as $sor) : ?>
                    <tr>
                        <?php foreach ($sor as $mezo) : ?>
                            <td><?= $mezo; ?></td>
                        <?php endforeach; ?>
                        <td>
                            <a class="badge bg-secondary" href="megtekint.php?id='<?= $sor['rendszam']; ?>'"><span class="badge bg-secondary" >Megtekint</span></a>
                            <a class="badge bg-secondary" href="szerkeszt.php?id='<?= $sor['rendszam']; ?>'"><span class="badge bg-secondary" >Szerkeszt</span></a>
                            <a class="badge bg-secondary" href="torol.php?id='<?= $sor['rendszam']; ?>'"><span class="badge bg-secondary" >Töröl</span></a>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
</body>
</html>