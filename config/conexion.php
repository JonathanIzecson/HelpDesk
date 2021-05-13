<?php

session_start();

class Conectar{
    protected $dbh;

    protected function conexion(){
        try {
            $conexion = $this->dbh = new PDO("mysql:host=localhost;dbname=helpdesk","root","12345678");
            return $conexion;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function setNames(){
        return $this->dbh->query("SET NAMES 'utf8'");
    }

    public function ruta(){
        return "http://localhost/helpdesk/";
    }
}

?>