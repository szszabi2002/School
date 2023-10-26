<?php
$id = $_GET['id'];
include 'kapcsolat.php';
if (isset($_POST['updatedata'])) {
    $leiras = $_POST['textupdate'];
    $idupdate = $_POST['id'];
    $queryupdate = "UPDATE adatok SET leiras='$leiras' WHERE id='$idupdate'";
    $utasitasupdate = $dbc->prepare($queryupdate);
    $utasitasupdate->execute();
    header("Location:index.php?sikeresszerkesztes");
print_r($_POST);
} else {
    $queryid = "SELECT * FROM adatok WHERE id='$id'";
    $utasitas = $dbc->prepare($queryid);
    $utasitas->execute();
    $adatid = $utasitas->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="stilus.css??=<?= rand(1, 32000) ?>">
    <title>Szerkesztés</title>
</head>

<body>
    <div class="grid-container">
        <div class="nav">
            <?php
            include 'header.php';
            ?>
        </div>
        <div class="main">
            <div class="container-fluid ">
                <div class="my-3 col-md-6 offset-md-3 col-xl-4 offset-xl-4 ">
                    <div class="card card-body float-center" style="width: 65rem; margin:0 auto;">
                        <h3 class="card-title text-center ">Szerkesztés</h3>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <?php foreach ($adatid as $sor) : ?>
                                    <img src="kepek/adatok/<?= $sor["kep"] ?>"  class="form-control w-50" id="kep">
                                <?php endforeach; ?>
                            </div>
                            <?php foreach ($adatid as $sor) : ?>
                                <input type="text" name="id" hidden value="<?= $sor['id']; ?>">
                                <label for="text">Leírás</label>
                                <textarea class="form-control w-50"  id="leiras" name="textupdate" cols="30" rows="12" style="margin:4px; padding:10px;"><?= $sor['leiras'] ?></textarea>
                            <?php endforeach; ?>
                            <div class="form-group">
                                <input type="submit" class="btn btn-dark w-100" value="Módsítás" name="updatedata" onclick="return confirm('Biztosan szeretné módosítani?');">
                            </div>
                            <div class="form-group">
                            <?php foreach ($adatid as $sor) : ?>
                                    <br><a href="kivalaszt.php?id=<?= $sor['id'] ?>"><button type="button" class="btn btn-dark w-100">Vissza az előző oldalra</button></a>
                                <?php endforeach; ?>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="footer">
            <?php
            include 'footer.php';
            ?>
        </div>
    </div>




</body>

</html>