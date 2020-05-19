<?php
class db{
    private $dbHost="localhost";
    private $dbUser="root";
    private $dbPass="";
    private $dbName="apidogs";

    //conexíon
    public function conectDB(){
        $mysqConnect = "mysql:host=$this->dbHost;dbname=$this->dbName";
        $dbConnection= new PDO($mysqConnect,$this->dbUser,$this->dbPass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}