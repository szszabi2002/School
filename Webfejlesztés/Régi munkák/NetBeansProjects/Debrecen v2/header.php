<?php
$sql = "SELECT * FROM adatok";
$utasitas = $dbc->prepare($sql);
$utasitas->execute();
$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC); 
session_start();
error_reporting(0);

?>

<header>
<nav class="navbar  fixed-top  navbar-expand-lg navbar-dark bg-dark ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Debrecen</a>
        <a class="nav-link" href="http://smartcity.debrecen.hu/hu" target="_blank">Smart City Debrecen</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Fejlődési ágak
                    </a>
                  
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                    <?php foreach ($adatok as $sorok) :?>
                    <li><a class="dropdown-item" href="kivalaszt.php?id=<?=$sorok["id"]?>"><?=$sorok["nev"]?></a></li>
                    <?php endforeach;?>
                    </ul>
                   
                </li>
            </ul>
            <?php if($_SESSION['van']===1):?>
                <br><a href="kijelentkezes.php"><button type="button" class="btn btn-dark">Kijelentkezés</button></a>
                <br><a href="profil.php"><button type="button" class="btn btn-dark"><?= $_SESSION['username']?></button></a>
                <br><a href="feltolt.php"><button type="button" class="btn btn-dark">Feltöltés</button></a>
                <?php else : ?>
            <br><a href="login.php"><button type="button" class="btn btn-dark">Bejelentkezés</button></a>
            <?php endif;?>
            
        </div>
        <form class="form-inline d-flex " action="keres.php" method="POST">
    <input class="form-control mr-sm-2" type="search"  aria-label="Search" name="keresesimezo">
    <input class="btn btn-outline-light my-2 my-sm-0  mx-2" type="submit" name="submit" value="Keresés"/>
  </form>
  
    </div>
   
</nav>
</header>