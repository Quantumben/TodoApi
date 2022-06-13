<?php

class Database {

        private $host = "localhost";
        private $database_name = "mactodo";
        private $username = "root";
        private $password = "";
        public $conn;
        
        public function getConnection(){
            
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Alaye Database No Gree Connect Sha , Check Me : " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
