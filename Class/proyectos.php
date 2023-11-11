<?php
    class proyectos{
        // Connection
        private $conn;
        // Table
      
        // Columns
        public $id_proyecto;
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function  proyecto_listado(){
            $sqlQuery = "SELECT p.id_proyecto, p.descripcion,p.fecha, c.razon_social FROM proyectos p INNER JOIN clientes c ON c.id_cliente = p.id_cl WHERE p.estatus = 1 AND p.activo = 1 ORDER BY p.id_proyecto DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
            
        }
        public function  proyecto_search(){
            $sqlQuery = "SELECT descripcion, fecha, id_cl FROM proyectos WHERE id_proyecto = :id_proyecto";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
            $stmt->bindParam(":id_proyecto", $this->id_proyecto);
            $stmt->execute();
            return $stmt;
            
        }
        public function  proyecto_photos(){
            $sqlQuery = "SELECT f.id_foto, f.fecha, s.nombre, s.direccion FROM fotos f INNER JOIN sedes s on s.id_centro = f.sede 
            where s.id_proyecto = :id_proyecto";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->id_proyecto=htmlspecialchars(strip_tags($this->id_proyecto));
            $stmt->bindParam(":id_proyecto", $this->id_proyecto);
            $stmt->execute();
            return $stmt;
            
        }
        public function  proyecto_clientes(){
            $sqlQuery = "SELECT id_proyecto,descripcion,fecha FROM proyectos 
            WHERE id_cl = :id_client AND proyectos.activo = 1 ORDER BY id_proyecto DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->id_client=htmlspecialchars(strip_tags($this->id_client));
            $stmt->bindParam(":id_client", $this->id_client);
            $stmt->execute();
            return $stmt;
            
        }
        
    }
?>