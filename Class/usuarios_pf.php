<?php
    class usuarios_pf{
        // Connection
        private $conn;
        // Table
        private $db_table = "usuarios_pf";
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
       
        public function client_login(){
            $sqlQuery = "select id_usuario, nombre, id_cliente from usuarios_pf where email=:email AND contrasena=:contrasena
             and activo =1";
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
            $this->nombre = $dataRow['nombre'];
            $this->id_cliente = $dataRow['id_cliente'];
            }
            
        }
       
    }
?>