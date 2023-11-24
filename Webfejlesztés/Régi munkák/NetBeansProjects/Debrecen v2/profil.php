<?php 
include 'kapcsolat.php';

?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="stilus.css?=<?=rand(1,32000)?>">
    <title>Profil</title>
</head>

<body>
<div class="grid-container">
    <div class="nav">
    <?php
    include 'header.php';
    ?>
    </div>
    <br><br><br>
    <div class="main">
        <div class="container-fluid">
        <div class="my-3 col-md-6 offset-md-3 col-xl-4 offset-xl-4 " >
    <div class="card card-body">
        <h3 class="card-title text-center">Profil Adatok</h3>
        <div class="mb3">
                <label class="form-label" for="fullname">Teljes Neve:</label>
                <input class="form-control" type="text" id="fullname" name="fullname" value="<?= $_SESSION['fullname']?>" disabled/>
            </div>
            <div class="mb-3">
               <br> <label class="form-label" for="username">Felhasználói név:</label>
                <input class="form-control" type="text" id="username" name="username"  value="<?=$_SESSION['username'] ?>" disabled/>
            </div>
            <div class="mb3">
                <label class="form-label" for="type">Típus:</label>
                <input class="form-control" type="text" id="type" name="type" value="<?= $_SESSION['type']?>" disabled/>
            </div>
            <div class="mb3">
                <br><label class="form-label" for="email">Email:</label>
                <input class="form-control" type="email" id="email" name="email" value="<?= $_SESSION['email']?>" disabled/>
            </div>
            
            <br><a href="profilszerkeszt.php"><button type="button" class="btn btn-dark w-100">Módosítás</button></a>
            <br><a href="index.php"><button type="button" class="btn btn-dark w-100" >Vissza az előző oldalra</button></a>
    </div>
</div>
        </div>
    </div>
    <div class="footer">
    <?php
    include 'footer.php';
    ?>
    </div>
</div>
 
</body>

</html>