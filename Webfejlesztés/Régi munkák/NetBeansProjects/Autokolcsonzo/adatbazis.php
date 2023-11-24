<?php
$servername = 'localhost';
$username = 'root';
$password = '';
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'CREATE DATABASE IF NOT EXISTS autokolcsonzo CHARACTER SET utf8 COLLATE utf8_hungarian_ci';
    $conn->exec($sql);
} catch (PDOException $e) {
    //echo $sql . '<br>' . $e->getMessage();
}

$conn = null;

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'autokolcsonzo';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE TABLE autok (
  rendszam CHAR(7) NOT NULL DEFAULT '',
    tipus CHAR(15) DEFAULT NULL,
    kategoria CHAR(6) DEFAULT NULL,
    vasarlasdatuma DATE DEFAULT NULL,
    ar DECIMAL(10, 2) DEFAULT NULL,
    futott_km DECIMAL(6, 0) DEFAULT NULL,
    allapot CHAR(1) DEFAULT NULL,
    PRIMARY KEY (rendszam)
  )";
    $conn->exec($sql);
} catch (PDOException $e) {
    //echo $sql . '<br>' . $e->getMessage();
}

$conn = null;

$csvdata = csv_in_array('autok.csv', '","', '" "', false);
function csv_in_array($url, $delm = '"', $encl = ',', $head = false)
{
    $csvxrow = file($url); // ---- csv rows to array ----
    $csvxrow[0] = chop($csvxrow[0]);
    $csvxrow[0] = str_replace($encl, '', $csvxrow[0]);
    $keydata = explode($delm, $csvxrow[0]);
    $keynumb = count($keydata);

    if ($head === true) {
        $anzdata = count($csvxrow);
        $z = 0;
        for ($x = 1; $x < $anzdata; $x++) {
            $csvxrow[$x] = chop($csvxrow[$x]);
            $csvxrow[$x] = str_replace($encl, '', $csvxrow[$x]);
            $csv_data[$x] = explode($delm, $csvxrow[$x]);
            $i = 0;
            foreach ($keydata as $key) {
                $out[$z][$key] = $csv_data[$x][$i];
                $i++;
            }
            $z++;
        }
    } else {
        $i = 0;
        foreach ($csvxrow as $item) {
            $item = chop($item);
            $item = str_replace($encl, '', $item);
            $csv_data = explode($delm, $item);
            for ($y = 0; $y < $keynumb; $y++) {
                $out[$i][$y] = $csv_data[$y];
            }
            $i++;
        }
    }

    return $out;
}
for ($i = 1; $i < count($csvdata);) {
    $rendszam = str_replace('"', '', $csvdata[$i][0]);
    $tipus = $csvdata[$i][1];
    $kategoria = $csvdata[$i][2];
    $vasarlasdatuma = str_replace('. ', '-', $csvdata[$i][3]);
    $ar = $csvdata[$i][4];
    $futott_km = $csvdata[$i][5];
    $allapot = $csvdata[$i][6];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO autok (rendszam, tipus, kategoria, vasarlasdatuma, ar, futott_km, allapot)
    VALUES ('$rendszam', '$tipus', '$kategoria', '$vasarlasdatuma', '$ar', '$futott_km', '$allapot')";
        $conn->exec($sql);
    } catch (PDOException $e) {
        //echo $sql . '<br>' . $e->getMessage();
    }
    $i++;
}
$host = 'localhost';
$db = 'autokolcsonzo';
$user = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$db";
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $dbc = new PDO($dsn, $user, $password, $options);
} catch (PDOException $exc) {
    echo "Kapcsolódási hiba:" . $exc->getMessage();
}
