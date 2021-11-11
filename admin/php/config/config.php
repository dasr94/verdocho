<?php
class Database{

    public function getConnection(){

        $dev = true;

        if($dev){

            $servername = "localhost";
            $username = "amarwxxl_verdocho";
            $password = "!(4K?8ctYw=t";
            $dbname = "amarwxxl_verdocho";
            
        } else {

            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "verdocho";

        }

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $servername . ";port=3306;dbname=" . $dbname, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>