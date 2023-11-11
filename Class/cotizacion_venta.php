<?php
    class cotizacion_venta{
        // Connection
        private $conn;
        // Table
      
        // Columns
       
       public $id_client;
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
        public function  venta_daterange(){
            $sqlQuery = "SELECT consecutivo, finicial, contacto, estatus 
             FROM cotizacion_venta WHERE estatus='orden cliente' and id_cl = :id_client
             and activo=1 and finicial  Between :date1 AND :date2";
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
        public function  venta_client(){
            $sqlQuery = "SELECT consecutivo, finicial, contacto, estatus  FROM cotizacion_venta 
            WHERE estatus='orden cliente' and id_cl = :id_client and activo=1";
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