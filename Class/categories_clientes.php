<?php
    class categories_clientes{
        // Connection
        private $conn;
        // Table
      
        // Columns
       
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
        
        public function  categories_select(){
            $sqlQuery = "SELECT id_categoria, descripcion FROM `categoria_clientes` WHERE activo = 1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
            
        }
       
        
    }
?>