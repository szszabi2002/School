<?php
include 'kapcsolat.php';
if (isset($_POST['submit'])) {

  $keresvalue = $_POST['keresesimezo'];
  $sql = "SELECT * FROM adatok WHERE UPPER(nev) LIKE UPPER('%$keresvalue%')";
  $utasitas = $dbc->prepare($sql);
  $utasitas->execute();
  $adat = $utasitas->fetchAll(PDO::FETCH_ASSOC);
  if(empty($adat)){
    echo '<div class="alert alert-danger" role="alert">Nincsen találat!</div>';
  }
}


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
  <link rel="stylesheet" href="stilus.css?=<?= rand(1, 32000) ?>">
  <title>Keresés</title>
</head>

<body>
  <div class="grid-container">
    <div class="nav">
      <?php include 'header.php'; ?>
    </div>
    <br>
    <br>
    <br>
    <div class="main">
      <div class="container-fluid">
        <main>
          <br>
          <?php foreach ($adat as $sor) : ?>
            <div class="content-card">
              <div class="card" style="width: 30rem;">
                <img class="card-img-top" src="kepek/adatok/thumb/<?= $sor["thumbnail"] ?>" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title"><?= $sor["nev"]; ?></h5>
                  <a href=" megtekint.php?id=<?= $sor["id"] ?>" class="btn btn-dark">Megtekintés</a>
                  <?php if ($_SESSION['type'] == 'Felhasznaló' || $_SESSION['type'] == 'Admin') : ?>
                    <a href="szerkeszt.php?id=<?= $sor["id"] ?>" class="btn btn-dark">Szerkesztés</a>
                  <?php endif; ?>
                  <?php if ($_SESSION['type'] == 'Admin') : ?>
                    <a href="torol.php?id=<?= $sor["id"] ?>" class="btn btn-dark">Törlés</a>
                  <?php endif; ?>
      <br>
                  <a href="index.php"><button type="button" class="btn btn-dark w-100">Vissza</button></a>
                </div>
              </div>
                  </div>
          <?php endforeach; ?>
        </main>
      </div>
    </div>
  </div>
<div class="footer">
<?php
    include 'footer.php';
    ?>
</div>
   


</body>

</html>