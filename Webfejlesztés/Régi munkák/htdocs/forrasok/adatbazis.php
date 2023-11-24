<?php

class Database 
{
    //creat mysqli connect and set charset to utf8
    public function __construct() 
    {
        $this->dbc = new mysqli("localhost", "root", "", "kirandulohelyek");
        $this->dbc->set_charset("utf8");
        //check connection
        if ($this->dbc->connect_error) 
        {
            die("Connection failed: " . $this->dbc->connect_error);
        }
    }
    //run mysqli sql query
    public function RunSQL($sql) 
    {
        $result = $this->dbc->query($sql);
        return $result;
    }
    //replace special characters
    public function cserel($miben) {
        $mit = ['á', 'é', 'í', 'ó', 'ö', 'ő', 'ú', 'ü', 'ű', 'Á', 'É', 'Í', 'Ó', 'Ö', 'Ő', 'Ú', 'Ü', 'Ű'];
        $mire = ['a', 'e', 'i', 'o', 'o', 'o', 'u', 'u', 'u', 'A', 'E', 'I', 'O', 'O', 'O', 'U', 'U', 'U'];
        return str_replace($mit, $mire, $miben);
    }
}