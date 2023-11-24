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
        if ($row['felhasznalonev'] == $username && $row['jelszo'] == $password) {
            header("Location:megjelenites.php?name=$username");
            break;
        }
    }
}
if (isset($_POST['register'])) {
    $username = $_POST['regusername'];
    $password = $_POST['regpassword'];
    $jogosultsag = $_POST['privilege'];
    try {
        $sql = "INSERT INTO felhasznalok (felhasznalonev, jelszo, jogosultsag) VALUES ('$username', '$password', '$jogosultsag')";
        $utasitas = $dbc->prepare($sql);
        $utasitas->execute();
    } catch (PDOException $exc) {
        echo "Lekérdezési hiba: " . $exc->getTraceAsString();
    }

}


?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="utf-8">
    <title>Remekművek</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="css/sourcesanspro-font.css">
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body class="form-v8">
    <div class="page-content">
        <div class="form-v8-content">
            <div class="form-left">
                <img src="images/mona.jpg" alt="form">
            </div>
            <div class="form-right">
                <div class="tab">
                    <div class="tab-inner">
                        <button class="tablinks" onclick="openCity(event, 'sign-up')" id="defaultOpen">Sign Up</button>
                    </div>
                    <div class="tab-inner">
                        <button class="tablinks" onclick="openCity(event, 'sign-in')">Sign In</button>
                    </div>
                </div>
                <form class="form-detail" action="#" method="post">
                    <div class="tabcontent" id="sign-up">
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="text" name="regusername" id="regusername" class="input-text" required>
                                <span class="label">Username</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="password" name="regpassword" id="regpassword" class="input-text" required>
                                <span class="label">Password</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="text" maxlength="1" oninput="this.value=this.value.replace(/[^0-1]/g,'');" name="privilege" id="privilege" class="input-text" required>
                                <span class="label">Jogosultság (0 = user - 1 = admin)</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row-last">
                            <input type="submit" name="register" class="register" value="Regisztráció">
                        </div>
                    </div>
                </form>
                <form class="form-detail" action="#" method="post">
                    <div class="tabcontent" id="sign-in">
                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="text" name="username" id="username" class="input-text" required>
                                <span class="label">Username</span>
                                <span class="border"></span>
                            </label>
                        </div>

                        <div class="form-row">
                            <label class="form-row-inner">
                                <input type="password" name="password" id="password" class="input-text" required>
                                <span class="label">Password</span>
                                <span class="border"></span>
                            </label>
                        </div>
                        <div class="form-row-last">
                            <input type="submit" name="login" class="login" value="Bejelentkezés">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
</body>

</html>