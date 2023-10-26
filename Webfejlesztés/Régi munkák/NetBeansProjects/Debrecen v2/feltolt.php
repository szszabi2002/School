<?php
include 'kapcsolat.php';
if (isset($_POST['upload'])) {
    print_r($_FILES);
    $fileborito = $_FILES['borito'];
    $filenameb = $_FILES['borito']['name'];
    $fileTmpNameb = $_FILES['borito']['tmp_name'];
    $fileSizeb = $_FILES['borito']['size'];
    $filenameb = $_FILES['borito']['name'];
    $fileErrorb = $_FILES['borito']['error'];
    $filenTypeb = $_FILES['borito']['type'];
    $fileExtb = explode('.', $filenameb);
    $fileActExtb = strtolower(end($fileExtb));
    //////////////////////
    $file = $_FILES['file'];
    $filename = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $filename = $_FILES['file']['name'];
    $fileError = $_FILES['file']['error'];
    $filenType = $_FILES['file']['type'];
    $fileExt = explode('.', $filename);
    $fileActExt = strtolower(end($fileExt));
    $allow = array('jpg', 'jpeg', 'png', 'jfif');
    if (in_array($fileActExt, $allow) && in_array($fileActExtb, $allow)) {
        if ($fileError === 0 && $fileErrorb === 0) {
            if ($fileSize < 5000000 && $fileSizeb <  5000000) {
                $filenewname = uniqid('', true) . "." . $fileActExt;
                $filenamenewb = uniqid('', true) . "." . $fileActExtb;
                $fileDestinationb = 'kepek/adatok/thumb/' . $filenamenewb;
                $fileDestination = 'kepek/adatok/' . $filenewname;
                move_uploaded_file($fileTmpName, $fileDestination);
                move_uploaded_file($fileTmpNameb, $fileDestinationb);
                $leiras = $_POST['leiras'];
                $nev = $_POST['nev'];
                $insert = "INSERT INTO adatok (nev, leiras, kep, thumbnail) VALUES('$nev', '$leiras', '$filenewname', '$filenamenewb');";
                $utasitasins = $dbc->prepare($insert);
                $utasitasins->execute();
                header("Location:index.php?sikeresfeltoltes");
            } else {
                echo "A fájl túl nagy!";
            }
        } else {
            echo "Hiba vana feltöltésben!";
        }
    } else {
        echo "Nem tudja feltölteni az iylen típusu fájlt!";
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
    <link rel="stylesheet" href="stilus.css?=<?= rand(1, 32000) ?>">
    <title>Feltöltés</title>
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

                <main style="width: 65rem">
                    <div class="my-3 col-md-6 offset-md-3 col-xl-4 offset-xl-4 ">
                        <div class="card card-body float-center" style="width: 65rem; margin:0 auto;">
                            <h3 class="card-title text-center">Feltöltés</h3>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Név:</label>
                                    <input type="text" name="nev" class="form-control w-50 align-items-center" id="formGroupExampleInput" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Leírás: </label>
                                    <textarea class="form-control" name="leiras" id="exampleFormControlTextarea1" style="height:50vh;" rows="3" maxlength="250" required></textarea>
                                </div>
                                <label>Válasszon ki kettő darab képet</label>
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile03" required>
                                    <label class="custom-file-label" for="inputGroupFile03">Vállasszon ki egy képet a leírásnak</label>
                                </div>
                                <br>
                                <div class="custom-file">
                                    <input type="file" name="borito" class="custom-file-input" id="inputGroupFile03" required>
                                    <label class="custom-file-label" for="inputGroupFile03">Vállasszon ki egy képet a boritónak </label>
                                </div>
                                <br>
                                <div class="input-group-prepend">
                                    <input type="submit" class="btn btn-dark w-100" value="Feltöltés" name="upload" />
                                </div>
                                <br><a href="index.php"><button type="button" class="btn btn-dark w-100">Vissza az előző oldalra</button></a>
                            </form>
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