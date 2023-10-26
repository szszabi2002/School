<!DOCTYPE html>
<?php
include 'adatkapcsolat.php';

try {
    $sql = 'SELECT * FROM alkatreszek';
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo 'Lekérdezési hiba: ' . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);

?>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="kozos/jquery-3.5.1.min.js "></script>
    <script src="kozos/popper.min.js "></script>
    <script src="kozos/bootstrap.min.js "></script>
    <link rel="stylesheet" href="kozos/bootstrap.min.css">
    <link rel="stylesheet" href="kozos/bootstrap-icons.css">
    <title>Autósbolt</title>
</head>

<body>
    <header>
        <img src="src/logo.png" alt="Logó">
        <h3>"Csiga tempó" Alkatrészek Áruháza</h3>
    </header>
    <div class="terület">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active elemek">
                <a class="nav-link" href="index.php">Nyitólap</a>
            </li>
            <li class="nav-item elemek">
                <a class="nav-link" href="Alkatreszek.php">Alkatrészek</a>
            </li>
            <li class="nav-item elemek">
                <a class="nav-link inactive" href="letrehozasalat.php">Új Alkatrész Felvitele</a>
            </li>
            <li class="nav-item elemek">
                <a class="nav-link" href="Torles.php">Alkatrész Törlése</a>
            </li>
            <li class="nav-item elemek">
                <a class="nav-link inactive" href="letrehozasalat.php">Kapcsolat</a>
            </li>
        </ul>
    </div>
    <main class="adatok">
    <select id="id">
            <?php
            $cnt = 0;
            foreach ($file_content as $sor) {
                $adatok = explode(",", $sor);
                ?>
                <option value="<?= $cnt; ?>"><?= $adatok[0]; ?></option>
                <?php
                $cnt++;
            }
            ?>
        </select>
    <table class="table table-responsive">
            <thead>
                <tr>
                    <?php foreach ($adatok[0] as $kulcs => $ertek) : ?>
                        <th>
                            <?= $kulcs ?>
                        </th>
                    <?php endforeach; ?>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($adatok as $sor) : ?>
                    <tr>
                        <?php foreach ($sor as $mezo) : ?>
                            <td><?= $mezo; ?></td>
                        <?php endforeach; ?>
                        
                    </tr>

                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <footer><b>&copy; Javítóvizsga - 2020.<b></footer>
</body>

</html>