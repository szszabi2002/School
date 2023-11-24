    <?php
    include "connect.php";
    try {
        $sql = "SELECT * FROM debrecen.kartyak";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $ex) {
        echo "Hiba" . $ex;
    }

    $adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css" />
        <title>
        </title>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand h1" id="fekete" href="#">Debrecen az élhetőbb város</a>
                <img width="3%" height="3%" src="Pictures/csímer.jpg" id="eastereggimg" onclick="onClick()">
            </div>
        </nav>
        <main>
            <div class="card-group">
                <?php foreach ($adatok as $adat) : ?>
                    <div class="card" style="width: 18rem;">
                        <img src="Pictures/<?= $adat['kep']; ?>" class="card-img-top" id="nemrejtetkep" alt="...">
                        <img src="Pictures/<?= $adat['kephover']; ?>" class="card-img-top" id="rejtetkep" alt="...">
                        <img src="Pictures/<?= $adat['easteregg']; ?>" class="card-img-top" id="easteregg" alt="...">
                        <div class="card-body">
                            <a href="<?= $adat['webpage']; ?>" class="card-title btn btn-outline-info">Több infó</a>
                            <h5 class="card-title clearfix"><?= $adat['kategoria']; ?></h5>
                            <p class="card-text"><?= $adat['rovidleiras']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
        </main>
    </body>
    <script>
        var clicks = 0;

        function onClick() {
            clicks += 1;
            console.log(clicks);
            if (clicks == 5) {
                document.getElementById("easteregg").style.opacity = "1";
            } else if (clicks == 6) {
                document.getElementById("easteregg").style.opacity = "0";
                clicks = 0;
            }
        };
    </script>

    </html>
    <!-- made by: Klepács Roland, Szincsák Szabolcs, Jakab Dániel, Craciun Edvin + 1 Sanyó Zsanett-->