<?php
    class propuestas_leasing{
        // Connection
        private $conn;
        // Table
      
        // Columns
        public $id_suc;
        public $folio;
        public  $fechaalta;
        public  $idcl;
        public $cliente;
        public $rfc;
        public $contacto;
        public $telefono;
        public $email;
        public $entrega;
        public $lugar_entrega;
        public $vigencia;
        public $ejecutivo;
        public $observaciones;
        public $garantia;
        public $id_usuario;
       
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
       
        
        public function  propuestas_leasing_filter(){
            $sqlQuery = "SELECT id_prol, folio, fechaalta, cliente FROM propuestas_leasing WHERE ejecutivo = :id_usuario 
            and estatus = 'abierto' AND activo = 1 
            AND cliente LIKE :cliente OR fechaalta =:fechaalta ORDER BY id_prol DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->cliente=htmlspecialchars(strip_tags($this->cliente));
            $this->cliente=$this->cliente."%";
            $this->fechaalta=htmlspecialchars(strip_tags($this->fechaalta));
            $this->fechaalta=$this->fechaalta."%";
            $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
            $stmt->bindParam(":cliente", $this->cliente);
            $stmt->bindParam(":fechaalta", $this->fechaalta);
            $stmt->bindParam(":id_usuario", $this->id_usuario);
            $stmt->execute();
            return $stmt;
            
        }
      
        public function  propuestas_leasing_list(){
            $sqlQuery = "SELECT id_prol, folio, fechaalta, cliente FROM propuestas_leasing WHERE ejecutivo = :id_usuario
             AND estatus = 'abierto' AND activo = 1 ORDER BY id_prol DESC";
            $stmt = $this->conn->prepare($sqlQuery);
    
            $this->id_usuario=htmlspecialchars(strip_tags($this->id_usuario));
        
            $stmt->bindParam(":id_usuario", $this->id_usuario);
            $stmt->execute();
            return $stmt;
            
        }
        public function  propuestas_leasing_update(){
         
            $sqlQuery = "UPDATE propuestas_leasing SET idcl= :idcl, cliente =:cliente, rfc = :rfc, 
             contacto = :contacto, telefono = :telefono, email = :email, entrega = :entrega, vigencia = :vigencia,
             observaciones = :observaciones , estatus = 'pendiente'  WHERE  id_prol=:id_propuesta";
            $stmt = $this->conn->prepare($sqlQuery);
           // $this->id_suc=htmlspecialchars(strip_tags($this->id_suc));
            //$this->folio=htmlspecialchars(strip_tags($this->folio));
           // $this->fechaalta=htmlspecialchars(strip_tags($this->fechaalta));
            $this->idcl=htmlspecialchars(strip_tags($this->idcl));
            $this->cliente=htmlspecialchars(strip_tags($this->cliente));
            $this->rfc=htmlspecialchars(strip_tags($this->rfc));
            $this->contacto=htmlspecialchars(strip_tags($this->contacto));
            $this->telefono=htmlspecialchars(strip_tags($this->telefono));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->entrega=htmlspecialchars(strip_tags($this->entrega));
            //$this->lugar_entrega=htmlspecialchars(strip_tags($this->lugar_entrega));
            $this->vigencia=htmlspecialchars(strip_tags($this->vigencia));
            //$this->ejecutivo=htmlspecialchars(strip_tags($this->ejecutivo));
            $this->observaciones=htmlspecialchars(strip_tags($this->observaciones));
            $this->id_propuesta=htmlspecialchars(strip_tags($this->id_propuesta));
            //$this->garantia=htmlspecialchars(strip_tags($this->garantia));

           // $stmt->bindParam(":folio", $this->folio);
            //$stmt->bindParam(":fechaalta", $this->fechaalta);
            $stmt->bindParam(":cliente", $this->cliente);
            $stmt->bindParam(":rfc", $this->rfc);
            $stmt->bindParam(":contacto", $this->contacto);
            $stmt->bindParam(":telefono", $this->telefono);
            $stmt->bindParam(":idcl", $this->idcl);
           // $stmt->bindParam(":id_suc", $this->id_suc);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":entrega", $this->entrega);
//$stmt->bindParam(":lugar_entrega", $this->lugar_entrega);
            $stmt->bindParam(":vigencia", $this->vigencia);
           // $stmt->bindParam(":ejecutivo", $this->ejecutivo);
            $stmt->bindParam(":observaciones", $this->observaciones);
            $stmt->bindParam(":id_propuesta", $this->id_propuesta);
            
            if($stmt->execute())
            {
                return $stmt;
            }
           
           
            
        }
        
    }