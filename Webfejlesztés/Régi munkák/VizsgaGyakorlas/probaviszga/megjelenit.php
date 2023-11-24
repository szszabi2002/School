<?php
include 'header.php';

$sql = "SELECT * FROM utazasicelok where id =" . $_GET['id'] . ";";
$adat = $db->RunSQL($sql);
//print_r($adat);
?>

<main class="container">
    <div class="row d-flex flex-wrap ">
        <?php foreach ($adat as $sor) : ?>
            <div class="col-xl-6 offset-xl-3 my-3" >
                <div class="card text-center" >
                    <a href="megjelenit.php?id='<?= $sor['id']; ?>'">
                        <img src='<?php echo "img/" . $db->cserel($sor['kep']); ?>' class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $sor['nev']; ?></h5>
                        <div class="card-text text-justify my-1">Megye: <?= $sor['megye']; ?> </div>
                        <div class="card-text text-justify my-1">Távolság Budapesttől: <?= $sor['tavolsag']; ?> </div>
                        <div class="card-text text-justify my-1">Leírás: <?= $sor['leiras']; ?> </div>
                        <a class="btn btn-outline-dark" href="index.php">Vissza</a>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>
    </div>
</main>


<?php
include 'footer.php';
?>