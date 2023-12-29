<<<<<<< HEAD
<?php

class Database {

    private $dbname = 'kirandulohelyek';
    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $password = '';
    private $dbc;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname;
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            $this->dbc = new PDO($dsn, $this->dbuser, $this->password, $options);
        } catch (PDOException $exc) {
            echo "hiba:" . $exc->getMessage();
        }
    }

    public function RunSQL($sql) {
        try {
            $utasitas = $this->dbc->prepare($sql);
            $utasitas->execute();
        } catch (PDOException $exc) {
            echo "Lekérdezési hiba:" . $exc->getMessage();
        }
        $result = $utasitas->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function cserel($miben) {
        $mit = ['á', 'é', 'í', 'ó', 'ö', 'ő', 'ú', 'ü', 'ű', 'Á', 'É', 'Í', 'Ó', 'Ö', 'Ő', 'Ú', 'Ü', 'Ű'];
        $mire = ['a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u', 'A', 'E', 'I', 'O', 'O', 'O', 'U', 'U', 'U'];
        return str_replace($mit, $mire, $miben);
    }

}
=======
<?php

class Database {

    private $dbname = 'kirandulohelyek';
    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $password = '';
    private $dbc;

    public function __construct() {
        try {
            $dsn = "mysql:host=" . $this->dbhost . ";dbname=" . $this->dbname;
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            $this->dbc = new PDO($dsn, $this->dbuser, $this->password, $options);
        } catch (PDOException $exc) {
            echo "hiba:" . $exc->getMessage();
        }
    }

    public function RunSQL($sql) {
        try {
            $utasitas = $this->dbc->prepare($sql);
            $utasitas->execute();
        } catch (PDOException $exc) {
            echo "Lekérdezési hiba:" . $exc->getMessage();
        }
        $result = $utasitas->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function cserel($miben) {
        $mit = ['á', 'é', 'í', 'ó', 'ö', 'ő', 'ú', 'ü', 'ű', 'Á', 'É', 'Í', 'Ó', 'Ö', 'Ő', 'Ú', 'Ü', 'Ű'];
        $mire = ['a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u', 'A', 'E', 'I', 'O', 'O', 'O', 'U', 'U', 'U'];
        return str_replace($mit, $mire, $miben);
    }

}
>>>>>>> e64aef7d494d1f1d5727fa570625277f6bcb2d8f
