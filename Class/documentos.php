<?php
    class documentos{
        // Connection
        private $conn;
        // Table
      
        // Columns
        public $id_proyecto;
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       public function documentos_clients()
       {
        $sqlQuery = "SELECT d.id_documento, d.nombred,d.fecha, d.archivo, s.nombre FROM documentos d INNER JOIN sedes s ON s.id_centro = d.sede
         WHERE d.id_proyecto = :id_proyecto and d.extension = 'jpeg' ORDER BY d.id_documento DESC";
        $stmt = $this->conn->prepare($sqlQuery);
        $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
        $stmt->bindParam(":id_proyecto", $this->id_proyecto);
        $stmt->execute();
        return $stmt;
        

       }
        public function  documentos(){
            $sqlQuery = "SELECT d.id_documento, d.nombred,d.fecha, s.nombre 
            FROM documentos d INNER JOIN sedes s ON s.id_centro = d.sede
             WHERE d.id_proyecto = :id_proyecto and d.extension = 'pdf'
             ORDER BY d.id_documento DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
            $stmt->bindParam(":id_proyecto", $this->id_proyecto);
            $stmt->execute();
            return $stmt;
            
        }
        public function  proyecto_document_insertion(){
            $sqlQuery = "INSERT INTO documentos(usuario, tipo, fecha, id_proyecto, id_cl,id_suc,archivo, extension)
             VALUES (:usuario, :tipo  , :fecha , :id_proyecto , :id_cl , :id_suc , :archivo , :extension )";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->usuario=htmlspecialchars(strip_tags($this->usuario));
            $this->tipo=htmlspecialchars(strip_tags($this->tipo));
            $this->fecha=htmlspecialchars(strip_tags($this->fecha));
            $this->archivo=htmlspecialchars(strip_tags($this->archivo));
            $this->id_cl=htmlspecialchars(strip_tags($this->id_cl));
            $this->id_suc=htmlspecialchars(strip_tags($this->id_suc));
            $this->extension=htmlspecialchars(strip_tags($this->extension));
            $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
            $stmt->bindParam(":id_proyecto", $this->id_proyecto);
            $stmt->bindParam(":archivo", $this->archivo);
            $stmt->bindParam(":fecha", $this->fecha);
            $stmt->bindParam(":usuario", $this->usuario);
            $stmt->bindParam(":tipo", $this->tipo);
            $stmt->bindParam(":extension", $this->extension);
            $stmt->bindParam(":id_cl", $this->id_cl);
            $stmt->bindParam(":id_suc", $this->id_suc);
            
            $stmt->execute();
            return $stmt;
            
        }
        
    }
?>