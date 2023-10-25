<?php
include 'adatbazis.php';

try {
    $sql = "SELECT * FROM etelek WHERE kategoria = '1'";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
    $sql2 = "SELECT * FROM etelek WHERE kategoria = '2'";
    $utasitas2 = $dbc->prepare($sql2);
    $utasitas2->execute();
    $sql3 = "SELECT * FROM etelek WHERE kategoria = '3'";
    $utasitas3 = $dbc->prepare($sql3);
    $utasitas3->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$leves = $utasitas->fetchAll(PDO::FETCH_ASSOC);
$foetel = $utasitas2->fetchAll(PDO::FETCH_ASSOC);
$desszert = $utasitas3->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['insert'])) {
    try {
        $het = $_POST['het'];
        for ($i = 1; $i <= 5; $i++) {
            $levesmentes = $_POST['leves' . $i];
            $foetelmentes = $_POST['foetel' . $i];
            $desszertmentes = $_POST['desszert' . $i];
            $sql = "INSERT INTO menu (het, nap, leves, foetel, desszert) VALUES ('$het', '$i', '$levesmentes', '$foetelmentes', '$desszertmentes');";
            $utasitas = $dbc->prepare($sql);
            $utasitas->execute();
        }
    } catch (PDOException $exc) {
        echo "INSERT hiba: " . $exc->getMessage();
    }
    header("Location: menu.php?ID=$het");
}

?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Menükreátor</title>
</head>

<body>
    <main>
        <form action="" method="post">
            <?php
            echo "Hét száma <select name='het'>";
            for ($i = 1; $i <= 52; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            echo "</select>";
            ?>
            <table>
                <thead>
                    <tr>
                        <th>
                            Hétfő
                        </th>
                        <th>
                            Kedd
                        </th>
                        <th>
                            Szerda
                        </th>
                        <th>
                            Csütörtök
                        </th>
                        <th>
                            Péntek
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo "<td><select name='leves$i'>";
                            shuffle($leves);
                            foreach ($leves as $key => $levesek) {
                                echo "<option value='" . $levesek['etel'] . "'>" . $levesek['etel'] . "</option>";
                                shuffle($leves);
                            }
                            echo "</select></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo "<td><select name='foetel$i'>";
                            shuffle($foetel);
                            foreach ($foetel as $key => $foetelek) {
                                echo "<option value='" . $foetelek['etel'] . "'>" . $foetelek['etel'] . "</option>";
                                shuffle($foetel);
                            }
                            echo "</select></td>";
                        }
                        ?>
                    </tr>
                    <tr>
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo "<td><select name='desszert$i'>";
                            shuffle($desszert);
                            foreach ($desszert as $key => $desszertek) {
                                echo "<option value='" . $desszertek['etel'] . "'>" . $desszertek['etel'] . "</option>";
                                shuffle($desszert);
                            }
                            echo "</select></td>";
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
            <input type="submit" name="insert" value="Jóváhagy">
        </form>
    </main>
</body>

</html>