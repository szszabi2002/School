<?php
include 'header.php';

$sql = "SELECT * FROM utazasicelok;";
$adat = $db->RunSQL($sql);
//print_r($adat);
?>

<main class="container">
    <div class="row d-flex flex-wrap ">
        <?php foreach ($adat as $sor) : ?>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 my-3" >
                <div class="card" >
                    <a href="megjelenit.php?id='<?= $sor['id']; ?>'">
                        <img src='<?php echo "img/" . $db->cserel($sor['kep']); ?>' class="card-img-top" alt="...">
                    </a>


                    <div class="card-body">
                        <h5 class="card-title"><?= $sor['nev']; ?></h5>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</main>


<?php
include 'footer.php';
?>