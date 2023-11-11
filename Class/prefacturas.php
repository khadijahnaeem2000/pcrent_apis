<?php
    class prefacturas{
        // Connection
        private $conn;
        // Table
      
        // Columns
       
       public $id_client;
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
        public function  facturacion_general(){
            $sqlQuery = "SELECT p.id_prefactura, p.foliopre, c.razon_social, p.fecha_alta, p.folio_cont, p.fecha_inicial, 
            p.fecha_final, p.descuento FROM prefacturas p INNER JOIN clientes c 
            ON c.id_cliente = p.id_client WHERE p.estatus LIKE 'cerrada' ORDER BY p.id_prefactura DESC LIMIT 0,50";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
           
                
            
        }
        public function  facturacion_general_client(){
            $sqlQuery = "SELECT p.id_prefactura, p.foliopre, c.razon_social, p.fecha_alta, p.folio_cont, p.fecha_inicial, p.fecha_final, p.descuento FROM prefacturas p INNER JOIN clientes c ON c.id_cliente = p.id_client WHERE p.estatus LIKE 'cerrada'
             and p.id_client = :id_client ORDER BY p.id_prefactura DESC LIMIT 0,50";
             $stmt = $this->conn->prepare($sqlQuery);
            $this->id_client=htmlspecialchars(strip_tags($this->id_client));
            $stmt->bindParam(":id_client", $this->id_client);  
            $stmt->execute();
            return $stmt;
           
                
            
        }
        
       
        
        
    }