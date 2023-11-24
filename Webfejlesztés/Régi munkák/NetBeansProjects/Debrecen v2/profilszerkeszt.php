<?php 
include 'kapcsolat.php';
echo '<div class="alert alert-danger" role="alert">Mósodítás után ki fog jelentkezni!</div>';
echo '<div class="alert alert-success" role="alert">A jelszavát nem muszáj frissítenie!</div>';
if (isset($_POST['profupdate'])) {
    session_start();
   $id = $_POST['id'];
   $username = $_POST['username'];
   $email = $_POST['email'];
   $fullname = $_POST['fullname'];
   $pw1 = $_POST['pw1'];
   $pw2 = $_POST['pw2'];
   $originalusername = $_SESSION['username'];
   $selectsql="SELECT * FROM felhasznalo WHERE username='$originalusername'";
   $utasitas = $dbc->prepare($selectsql);
   $utasitas->execute();
   $row = $utasitas->fetch();
   if ($row != false) {
       $actusername = $row['username'];
        $profsql = "UPDATE felhasznalo SET username='$username', email='$email', nev='$fullname' WHERE id='$id'";
        $utasitas = $dbc->prepare($profsql);
        $utasitas->execute();
       session_destroy();
        header("Location:login.php");
   }
   else{
       echo "valami hiba van!";
   }
   if(!empty($_POST['pw1']) && !empty($_POST['pw2'])){
    if($pw1 == $pw2){
        $pw = password_hash($pw1,PASSWORD_DEFAULT);
        $pwusql = "UPDATE felhasznalo SET passwd='$pw'  WHERE id='$id'";
        $utasitas = $dbc->prepare($pwusql);
        $utasitas->execute();
        echo '<div class="alert alert-success" role="alert">Az új jelszó frissítve</div>';
       }
       else{
        echo '<div class="alert alert-danger" role="alert">A megadott jelszavak nem egyeznek meg!</div>';
       }
   }
  
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
    <link rel="stylesheet" href="stilus.css?=<?=rand(1,32000)?>">
    <title>Profilszerkesztés</title>
</head>

<body>
<div class="grid-container">
    <div class="nav">
    <?php
    include 'header.php';
    ?>
    </div>
    <br>
    <br>
    <br>
<div class="main">
    <div class="container-fluid">
    </div>
    <div class="my-3 col-md-6 offset-md-3 col-xl-4 offset-xl-4 " >
    <div class="card card-body">
        <h3 class="card-title text-center">Profil Adatok</h3>
        <form method="POST">
        <div class="mb3">
                <label class="form-label" for="fullname">Teljes neve:</label>
                <input class="form-control" type="text" id="fullname" name="fullname" value="<?= $_SESSION['fullname']?>" required/>
            </div>
            <div class="mb-3">
               <br> <input type="text" hidden name="id" id="id" value="<?=$_SESSION['id']?>">
                <label class="form-label" for="username">Felhasználói név:</label>
                <input class="form-control" type="text" id="username" name="username"  value="<?=$_SESSION['username'] ?>" required/>
            </div>
            <div class="mb3">
                <label class="form-label" for="type">Típus:</label>
                <input class="form-control" type="text" id="type" name="type" value="<?= $_SESSION['type']?>" disabled/>
            </div>
            <div class="mb3">
               <br> <label class="form-label" for="email">Email:</label>
                <input class="form-control" type="email" id="email" name="email" value="<?= $_SESSION['email']?>" required/>
            </div>
            <hr>

            <div class="mb-3">
                <label class="form-label" for="pw1">*Új jelszó:</label>
                <input type="password" id="pw1" name="pw1" class="form-control" placeholder="új jelszó" />
            </div>
            <div class="mb-3">
                <label class="form-label" for="pw2">*Új jelszó újra:</label>
                <input type="password" id="pw2" name="pw2" class="form-control" placeholder="új jelszó újra" />
            </div>
            <br>
          <input type="submit"  class="btn btn-dark w-100" value="Módsítás" name="profupdate" onclick="return confirm('Biztosan szeretné módosítani?');">
          <br>
          <br><a href="index.php"><button type="button" class="btn btn-dark w-100" >Vissza az előző oldalra</button></a>
        </form>
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