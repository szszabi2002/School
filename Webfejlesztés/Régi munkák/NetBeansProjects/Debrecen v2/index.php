<?php
include 'kapcsolat.php';
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/bootstrap.bundle.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stilus.css?=<?=rand(1,32000)?>">
    
    <title>Debrecen</title>
</head>

<body>
<div class="grid-container">
    <div class="nav">
    <?php
    include 'header.php';
    ?>
    <br><br><br>
    </div>
    <div class="main">
    <div class="container">
    <main>
        <div class="content">
        <div class="container-fluid" style="padding-top:20px;" >
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="kepek/adatok/thumb/1.jpg" class="mx-auto d-block img-fluid  rounded" style="max-width:900px; max-height:600px !important;" alt="kep1">
                    </div>
                    <div class="carousel-item">
                        <img src="kepek/adatok/thumb/2.jpg" class="mx-auto d-block img-fluid  rounded" style="max-width:900px; max-height:600px !important;" alt="kep2">
                    </div>
                    <div class="carousel-item">
                        <img src="kepek/adatok/thumb/3.jpg" class="mx-auto d-block img-fluid  rounded" style="max-width:900px; max-height:600px !important;" alt="kep3">
                    </div>
                </div>
            </div>
            <br>
            <div class="content-item">
                <div class="content-text">
                <h1> Debrecen </h1>
                    <p>Debrecen Magyarország harmadik legnagyobb területű és második legnépesebb települése, Hajdú-Bihar megye és a Debreceni járás székhelye, megyei jogú város. Napjainkban elég fejlett városnak számít, de mindig van hova fejlődni. A város melyet mindig is a "civis város"-nak becézték eléggé ellentmond a valóságnak ugyanis számtalan projekt és program keretében kifejezetten moderné tették a várost. Debrecen városa továbbra is törekszik az újulásra, a fejlődésre és a modernizációra.</p>
                </div>
            </div>
        </div>
        </div>
    </main>
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