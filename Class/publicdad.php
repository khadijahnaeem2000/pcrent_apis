<?php
    class publicdad{
        // Connection
        private $conn;
        // Table
        private $db_table = "publicidad";
        // Columns
        
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getpublicdad_img(){
            $sqlQuery = "Select id_publicidad from publicidad where tipo='pcrent' AND  activo =1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getpublicdad_img_client(){
            $sqlQuery = "Select id_publicidad from publicidad where tipo='preferente' AND  activo =1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
       
    }
?>