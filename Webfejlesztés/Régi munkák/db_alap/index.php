<!DOCTYPE html>
<?php
include 'adatkapcsolat.php';

try {
    $sql = "SELECT * FROM workers";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}

$adatok = $utasitas->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DB alapok</title>
        <link href="db_alap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <h4>Alkalmazottak adatai </h4>
        <?php
        echo '<table>';
        foreach ($adatok as $sor) {
            echo "<tr>";
            foreach ($sor as $mezo) {
                echo "<td>$mezo</td>";
            }
            echo "</tr>";
        }
        echo '</table>';
        ?>



    </body>
</html>
