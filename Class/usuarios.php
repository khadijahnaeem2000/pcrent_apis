<?php
    class usuarios{
        // Connection
        private $conn;
        // Table
        private $db_table = "usuarios";
        // Columns
        public $id_usuario;
        public $id_sucursal;
        public $nombre;
        public $contrasena;
        public $departamento;
        public $tipo_usuario;
        public $activo;
        public $puesto;
        public $telefono;
        public $email;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getEmployees(){
            $sqlQuery = "SELECT  id_usuario , id_sucursal ,  nombre ,  email ,  contrasena ,  departamento ,  tipo_usuario ,  activo ,  puesto ,  telefono  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function getSingleEmployee(){
            $sqlQuery = "SELECT  id_usuario, tipo_usuario, id_sucursal from ". $this->db_table ." WHERE email=:email AND contrasena=:contrasena and activo =1";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->contrasena=htmlspecialchars(strip_tags($this->contrasena));
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":contrasena", $this->contrasena);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if($dataRow)
            {
            $this->id_usuario = $dataRow['id_usuario'];
            $this->id_sucursal = $dataRow['id_sucursal'];
            $this->tipo_usuario = $dataRow['tipo_usuario'];
            }
            
        }
       
    }
?>