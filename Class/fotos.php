<?php
    class fotos{
        // Connection
        private $conn;
        // Table
      
        // Columns
        public $id_proyecto;
        public $responsable;
        public $fecha;
        public $sede;
        public $id_cl;
        public $id_suc;
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
        public function  proyecto_fotos_insertion(){
            $sqlQuery = "INSERT INTO fotos (responsable, fecha, sede, id_proyecto, id_cl, id_suc) VALUES (:responsable, :fecha, :sede, :id_proyecto, :id_cl, :id_suc)";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->responsable=htmlspecialchars(strip_tags($this->responsable));
            $this->fecha=htmlspecialchars(strip_tags($this->fecha));
            $this->sede=htmlspecialchars(strip_tags($this->sede));
            $this->id_cl=htmlspecialchars(strip_tags($this->id_cl));
            $this->id_suc=htmlspecialchars(strip_tags($this->id_suc));
            $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
            $stmt->bindParam(":id_proyecto", $this->id_proyecto);
            $stmt->bindParam(":responsable", $this->responsable);
            $stmt->bindParam(":fecha", $this->fecha);
            $stmt->bindParam(":sede", $this->sede);
            $stmt->bindParam(":id_cl", $this->id_cl);
            $stmt->bindParam(":id_suc", $this->id_suc);
            
            $stmt->execute();
            return $stmt;
            
        }
        
    }
?>