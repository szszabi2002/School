<?php
include 'adatbazis.php';
$hetn = $_GET['ID'];

try {
    $sql = "SELECT leves, foetel, desszert FROM menu WHERE nap = '1'";
    $utasitas = $dbc->prepare($sql);
    $utasitas->execute();
    $sql2 = "SELECT leves, foetel, desszert FROM menu WHERE nap = '2'";
    $utasitas2 = $dbc->prepare($sql2);
    $utasitas2->execute();
    $sql3 = "SELECT leves, foetel, desszert FROM menu WHERE nap = '3'";
    $utasitas3 = $dbc->prepare($sql3);
    $utasitas3->execute();
    $sql4 = "SELECT leves, foetel, desszert FROM menu WHERE nap = '4'";
    $utasitas4 = $dbc->prepare($sql4);
    $utasitas4->execute();
    $sql5 = "SELECT leves, foetel, desszert FROM menu WHERE nap = '5'";
    $utasitas5 = $dbc->prepare($sql5);
    $utasitas5->execute();
} catch (PDOException $exc) {
    echo "Lekérdezési hiba: " . $exc->getTraceAsString();
}
$hetfo = $utasitas->fetchAll(PDO::FETCH_ASSOC);
$kedd = $utasitas2->fetchAll(PDO::FETCH_ASSOC);
$szerda = $utasitas3->fetchAll(PDO::FETCH_ASSOC);
$csutortok = $utasitas4->fetchAll(PDO::FETCH_ASSOC);
$pentek = $utasitas5->fetchAll(PDO::FETCH_ASSOC);
foreach ($hetfo as $sor1) {
}
foreach ($kedd as $sor2) {
}
foreach ($szerda as $sor3) {
}
foreach ($csutortok as $sor4) {
}
foreach ($pentek as $sor5) {
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
        <?php
        echo "Hét száma <select name='het'><option value='0'>Válassz hetet...</option>";
        for ($i = 1; $i <= 52; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        echo "</select>";
        echo "<h1>Választott hét: $hetn. hét</h1>"
        ?>
        <table id="tablazat">
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
                    <td>
                        <?= $sor1['leves']; ?>
                    </td>
                    <td>
                        <?= $sor2['leves']; ?>
                    </td>
                    <td>
                        <?= $sor3['leves']; ?>
                    </td>
                    <td>
                        <?= $sor4['leves']; ?>
                    </td>
                    <td>
                        <?= $sor5['leves']; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $sor1['foetel']; ?>
                    </td>
                    <td>
                        <?= $sor2['foetel']; ?>
                    </td>
                    <td>
                        <?= $sor3['foetel']; ?>
                    </td>
                    <td>
                        <?= $sor4['foetel']; ?>
                    </td>
                    <td>
                        <?= $sor5['foetel']; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $sor1['desszert']; ?>
                    </td>
                    <td>
                        <?= $sor2['desszert']; ?>
                    </td>
                    <td>
                        <?= $sor3['desszert']; ?>
                    </td>
                    <td>
                        <?= $sor4['desszert']; ?>
                    </td>
                    <td>
                        <?= $sor5['desszert']; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>