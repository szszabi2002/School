<?php

class DataBase {

    private $db_name = "";
    private $db_user = "root";
    private $db_password = "";
    private $db_host = "localhost";
    private $dbc;

    function __construct() {
        try {
//kapcsolódás mysql szerverhez adatbázis nékül
            $dsn = "mysql:host" . $this->db_host . ";dbname=" . $this->db_name;
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            $this->dbc = new PDO($dsn, $this->db_user, $this->db_password, $options);
        } catch (PDOException $exc) {
            echo 'Hiba: ' . $exc->getMessage();
        }
    }

    public function ListDatabases($dbname) {
        $sql = "SHOW DATABASES;";
        $utasitas = $this->dbc->prepare($sql);
        $utasitas->execute();
        $data = $utasitas->fetchAll(PDO::FETCH_COLUMN);
        return in_array($dbname, $data);
    }

    public function Create($dbname, $tblname) {
        try {
            $sql_set = "SET NAMES 'utf8';";
            $sql_createdb = "CREATE DATABASE IF NOT EXISTS $dbname"
                    . " CHARACTER SET utf8"
                    . " COLLATE utf8_hungarian_ci;";
            $sql_use = "USE $dbname;";
            $sql_droptbl = "DROP TABLE IF EXISTS $tblname;";
            $sql_tbl = "CREATE TABLE IF NOT EXISTS $tblname ("
                    . "rendszam CHAR(7) NOT NULL,"
                    . " tipus VARCHAR(15) DEFAULT NULL,"
                    . " kategoria VARCHAR(6) DEFAULT NULL,"
                    . " vasarlasdatuma DATE DEFAULT NULL,"
                    . " ar INT(10) DEFAULT NULL,"
                    . " futott_km INT(6) DEFAULT NULL,"
                    . " allapot CHAR(1) DEFAULT NULL,"
                    . " PRIMARY KEY (rendszam))"
                    . " ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_hungarian_ci;";
//$this->dbc->beginTransaction();
            $this->dbc->exec($sql_set);
            $this->dbc->exec($sql_createdb);
            $this->dbc->exec($sql_use);
            $this->dbc->exec($sql_droptbl);
            $this->dbc->exec($sql_tbl);
//$this->dbc->commit();
        } catch (Exception $exc) {
            die("Hiba: " . $exc->getMessage());
        }
    }

    public function ImportData($filename, $dbname, $table) {
        $adatok = file($filename);
        $sql_use = "USE $dbname;";
        $ut = $this->dbc->prepare($sql_use);
        $ut->execute();

        $sql = "INSERT INTO $table VALUES ";
        for ($i = 1; $i < count($adatok); $i++) {
            $sql .= "(";
            $adatok[$i] = str_replace('","', '";"', $adatok[$i]);
            $ertekek = explode(';', $adatok[$i]);
            foreach ($ertekek as $ertek) {
                $sql .= $ertek . ", ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= '),';
        }
        $sql = substr($sql, 0, -1);
        $sql .= ';';
        print_r($sql);
        $utasitas = $this->dbc->prepare($sql);
        $utasitas->execute();
    }
}
$dbname = 'autokolcsonzo';
$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = '';

$dsn = "mysql:host=" . $dbhost . ";dbname=" . $dbname;
$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$dbc = new PDO($dsn, $dbuser, $dbpassword, $options);