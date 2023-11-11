<?php
    class sedes{
        // Connection
        private $conn;
        // Table
      
        // Columns
        public $id_proyecto;
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
        public function  AreaDeTrabajo(){
            $sqlQuery = "SELECT nombre, id_centro FROM sedes WHERE  id_proyecto= :id_proyecto";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
            $stmt->bindParam(":id_proyecto", $this->id_proyecto);
            $stmt->execute();
            return $stmt;
            
        }
        
    }
?>