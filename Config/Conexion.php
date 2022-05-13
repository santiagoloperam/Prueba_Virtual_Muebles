<?php

    class Conexion{
        
        public $db;
        
        public function __construct(){
            
            $host = "localhost";
            $dbname = "virtual_muebles";
            $username = "root";
            $password = "";
            
            try {
                
                $this->db = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
                $this->db->query("SET NAMES 'UTF8'");
                
            } catch (PDOException $e) {
                
                echo "Error: ". $e->getMessage();
            }

        }
        
        
        
        //Funcion que me permite cerrar una conexion cuando yo quiera =)
        public function CloseConexion()
        {
            $this->db = null;
        }

    }
        
    

    

?>