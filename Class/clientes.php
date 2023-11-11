<?php
    class clientes{
        // Connection
        private $conn;
        // Table
      
        // Columns
    
        public $rfc ; 
        public $razon_social ; 
        public $calle ; 
        public $colonia ; 
        public $ciudad ; 
        public $estado ; 
        public $pais ;  
        public $cp ; 
        public $telefono ;
        public $email ; 
        public $contacto ; 
        public $id_suc ;

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
        public function  clientes_filter(){
            $sqlQuery = "SELECT razon_social,calle,colonia,ciudad,estado,telefono FROM 
            clientes WHERE activo=1 AND razon_social LIKE :razon_social  OR rfc 
            LIKE  :rfc ORDER BY razon_social ASC";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->razon_social=htmlspecialchars(strip_tags($this->razon_social));
            $this->razon_social=$this->razon_social."%";
            //echo $this->razon_social;
            $stmt->bindParam(":razon_social", $this->razon_social);
            $this->rfc=htmlspecialchars(strip_tags($this->rfc));
            $this->rfc=$this->rfc."%";
            //echo $this->rfc;
            $stmt->bindParam(":rfc", $this->rfc);
            $stmt->execute();
            return $stmt;
            
        }
        public function  clientes_list(){
            $sqlQuery = "SELECT rfc, razon_social,calle,colonia,ciudad,estado,telefono 
            FROM clientes  WHERE activo =1 ORDER BY razon_social ASC LIMIT 0,30";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
            
        }
        
        public function  clientes_select(){
            $sqlQuery = "SELECT id_cliente, razon_social, rfc, contacto, telefono, email 
            FROM clientes WHERE activo=1 and autorizado !=1 order by razon_social";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
            
        }
        public function client_insertion(){
            $sqlQuery = "INSERT INTO clientes (rfc, razon_social, calle, colonia, 
            ciudad, estado, pais, cp, 
            telefono, email, contacto, id_cat, activo,autorizado, id_suc) VALUES ( :rfc ,  :razon_social , 
             :calle ,  :colonia ,  :ciudad ,  :estado ,  :pais ,  :cp ,  
            :telefono ,  :email ,  :contacto ,  1 , 1 , 3 , :id_suc ) ";
           $stmt = $this->conn->prepare($sqlQuery);
           
           $this->rfc=htmlspecialchars(strip_tags($this->rfc));
           $this->razon_social=htmlspecialchars(strip_tags($this->razon_social));
           $this->calle=htmlspecialchars(strip_tags($this->calle));
           $this->colonia=htmlspecialchars(strip_tags($this->colonia));
           $this->ciudad=htmlspecialchars(strip_tags($this->ciudad));
           $this->estado=htmlspecialchars(strip_tags($this->estado));
            $this->pais=htmlspecialchars(strip_tags($this->pais));
            $this->cp=htmlspecialchars(strip_tags($this->cp));
            $this->contacto=htmlspecialchars(strip_tags($this->contacto));
            $this->telefono=htmlspecialchars(strip_tags($this->telefono));
            $this->email=htmlspecialchars(strip_tags($this->email));
           $this->id_suc=htmlspecialchars(strip_tags($this->id_suc));
          
           
           $stmt->bindParam(":rfc", $this->rfc);
           $stmt->bindParam(":razon_social", $this->razon_social);
           $stmt->bindParam(":calle", $this->calle);
           $stmt->bindParam(":colonia", $this->colonia);
           $stmt->bindParam(":ciudad", $this->ciudad);
           $stmt->bindParam(":estado", $this->estado);
           $stmt->bindParam(":pais", $this->pais);
           $stmt->bindParam(":cp", $this->cp);
           $stmt->bindParam(":contacto", $this->contacto);
           $stmt->bindParam(":telefono", $this->telefono);
           $stmt->bindParam(":email", $this->email);
           $stmt->bindParam(":id_suc", $this->id_suc);
           
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