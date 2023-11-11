<?php
    class cotizacion_leasing{
        // Connection
        private $conn;
        // Table
      
        // Columns
       
       public $id_client;
       public $date1;
       public $date2;
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
        public function  leasing_daterange(){
            $sqlQuery = "SELECT consecutivo, finicial, ftermino, oc, contacto, ult_pre, estatus,ingresado FROM cotizacion_renta 
            WHERE (estatus='contrato' OR estatus = 'cerrado') and id_cl=:id_client and activo=1 and ftermino
            Between :date1 AND :date2";
           $stmt = $this->conn->prepare($sqlQuery);
           $this->id_client=htmlspecialchars(strip_tags($this->id_client));
           $stmt->bindParam(":id_client", $this->id_client);  
           $this->date1=htmlspecialchars(strip_tags($this->date1));
           $stmt->bindParam(":date1", $this->date1); 
        $this->date2=htmlspecialchars(strip_tags($this->date2));
           $stmt->bindParam(":date2", $this->date2); 
            $stmt->execute();
            return $stmt;
           
                
            
        }
        public function  leasing_oc(){
            $sqlQuery = "SELECT consecutivo, finicial, ftermino, oc, contacto, ult_pre, estatus, ingresado
             FROM cotizacion_leasing WHERE
             (estatus='contrato' OR estatus = 'cerrado') and id_cl=:id_client and activo=1 and oc LIKE '1235'";
           $stmt = $this->conn->prepare($sqlQuery);
           $this->id_client=htmlspecialchars(strip_tags($this->id_client));
           $stmt->bindParam(":id_client", $this->id_client);  
           //$this->oc=htmlspecialchars(strip_tags($this->oc));
           //$this->oc=$this->oc."%";
           //$stmt->bindParam(":oc", $this->oc); 
       
            $stmt->execute();
            return $stmt;
           
                
            
        }
        public function  leasing_client(){
            $sqlQuery = "SELECT consecutivo, finicial, ftermino, oc, contacto, ult_pre, estatus, ingresado FROM cotizacion_leasing 
            WHERE (estatus='contrato' OR estatus = 'cerrado') and id_cl =:id_client and activo=1";
           $stmt = $this->conn->prepare($sqlQuery);
           $this->id_client=htmlspecialchars(strip_tags($this->id_client));
           $stmt->bindParam(":id_client", $this->id_client);  
           //$this->folio=htmlspecialchars(strip_tags($this->folio));
           //$this->folio=$this->folio."%";
           //$stmt->bindParam(":folio", $this->folio); 
      
            $stmt->execute();
            return $stmt;
           
                
            
        }
       
        
       
        
        
    }