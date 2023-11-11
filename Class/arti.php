<?php
    class arti{
        // Connection
        private $conn;
        // Table
      
        // Columns
        public $articulo;
       
       
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
    
        public function  articulo_search()
        { $sqlQuery = "SELECT nombre, folio  FROM articulos WHERE nombre LIKE :articulo and activo=1
            ";
            $stmt = $this->conn->prepare($sqlQuery);
    
            $this->articulo=htmlspecialchars(strip_tags($this->articulo));
            $this->articulo=$this->articulo."%";
            $stmt->bindParam(":articulo", $this->articulo);
            $stmt->execute();
            return $stmt;

        }
        
        
    }