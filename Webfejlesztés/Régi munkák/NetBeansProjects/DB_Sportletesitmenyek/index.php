<?php

include 'kapcsolat.php';

try {
    $sql = "SELECT * FROM felhasznalok;";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    foreach ($adatok as $row) {
        if ($row['username'] == $username && $row['password'] == $password) {
            header("Location:letesitmenyek.php?name=$username");
            break;
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
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <script src="bootstrap/bootstrap.min.js"></script>
    <link rel="stylesheet" href="stilus.css">
    <title>Bejelentkezés!</title>
</head>

<body>
        <header>
        <img src="img/DB_Logo.png" alt="Debrecen címere" style="height: 50px;">
        <span style="font-size: 18px; font-weight: bold	;">Debrecen sportlétesítményei</span>
    </header>
    <div class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="border border-secondary" style="border-radius: 1rem;">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <hr class="my-3">
                                <h3 class="mb-5">Bejelentkezés</h3>
                                <form method="post">
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="username">Felhasználónév</label>
                                        <input type="text" id="username" name="username" class="form-control form-control-lg" />
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Jelszó</label>
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                    </div>
                                    <button type="submit" name="login" id="login" class="btn btn-success btn-lg btn-block" type="submit">Bejelentkezés</button>
                                    <br>
                                </form>
                                <a href="letesitmenyek.php?name=Guest"><span class="btn btn-outline-secondary btn-sm">Bejelentkezés vendégként</span></a>
                                <hr class="my-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>