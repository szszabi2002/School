<?php
include 'kapcsolat.php';
if(isset($_POST['login'])){
    $felnev=$_POST['username'];
    $passwd = $_POST['password'];
    $query = "SELECT * FROM felhasznalo WHERE username= '$felnev'";
    $utasitas = $dbc->prepare($query);
    $utasitas->execute();
    $row = $utasitas->fetch();
    if ($row != false) {
        $hash2 = $row['passwd'];
        $user = $row['username'];
        $full = $row['nev'];
        $type =$row['types'];
        $email = $row['email'];
        $id = $row['id'];
        $passwordd = $row['passwd'];
        $verify = password_verify($passwd, $hash2);
        if ($verify) {
            session_start();
                    $_SESSION['username'] = $user;
                    $_SESSION['fullname'] = $full;
                    $_SESSION['type'] = $type;
                    $_SESSION['van'] = 1;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $id;
                    $_SESSION['password'] =  $passwordd;
                    header("Location:index.php");
        }
        else{
            echo '<div class="alert alert-danger" role="alert">Nem megfelelő jelszó!</div>';
         }
    }
 else {
    echo '<div class="alert alert-danger" role="alert">Nem létező felhasználó!</div>';
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
    <link rel="stylesheet" href="stilus.css??=<?=rand(1,32000)?>">
    <title>Bejelentkezés</title>
</head>

<body>
<div class="grid-container">
    <div class="nav">
    <?php
    include 'header.php';
    ?>
    </div>
    <div class="main">
        <div class="container-fluid">
        <div class="my-3 col-md-6 offset-md-3 col-xl-4 offset-xl-4 " >
    <div class="card card-body float-center">
        <h3 class="card-title text-center">Bejelentkezés</h3>
        <form method="post">
            <div class="mb-3">
                <label class="form-label" for="username">Felhasználói név</label>
                <input class="form-control" type="text" id="username" name="username" placeholder="Név" required/>
            </div>
            <div class="mb3">
                <label class="form-label" for="password">Jelszó</label>
                <input class="form-control" type="password" id="password" name="password"  placeholder="Jelszó" required/>
            </div>
            <button  type="submit" name="login" class=" btn btn-dark  my-3 w-100  " >Bejelentkezés</button><br>
            <a href="index.php"><button type="button" class="btn btn-dark my-3 w-100">Vissza</button></a>
            <div>
                <div class = "float-end"><a class="card-link " href="regisztral.php">Regisztráció</a></div>
            </div>
        </form>
    </div>
</div>
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