<?php
    class item_venta{
        // Connection
        private $conn;
        // Table
      
        // Columns
        public $id_itemv;
         public $id_propuesta;
         public $articulo;
         public $tipo;
         public  $cantidad;
         public  $renta_uni;
         public $importe;
         public  $parte;
         public $tiempo;
         public $nparte;
       
          

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
       
    
        public function  item_venta_insertion()
        { $sqlQuery = "INSERT INTO item_venta ( id_propuesta, articulo, tipo, cantidad, renta_uni, importe, parte) 
        VALUES (:id_propuesta, :articulo, :tipo,:cantidad,:renta_uni, :importe, :parte) ";
            $stmt = $this->conn->prepare($sqlQuery);
     
            $this->id_propuesta=htmlspecialchars(strip_tags($this->id_propuesta));
           // $this->id_itemv=htmlspecialchars(strip_tags($this->id_itemv));
            $this->articulo=htmlspecialchars(strip_tags($this->articulo));
            $this->tipo=htmlspecialchars(strip_tags($this->tipo));
            $this->renta_uni=htmlspecialchars(strip_tags($this->renta_uni));
            $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));
            $this->importe=(float)$this->renta_uni * (float)$this->cantidad;
            $this->parte=htmlspecialchars(strip_tags($this->parte));
           // $this->articulo=$this->articulo."%";
            $stmt->bindParam(":id_propuesta", $this->id_propuesta);
           // $stmt->bindParam(":id_itemv", $this->id_itemv);
            $stmt->bindParam(":articulo", $this->articulo);
            $stmt->bindParam(":tipo", $this->tipo);
            $stmt->bindParam(":cantidad", $this->cantidad);
            $stmt->bindParam(":renta_uni", $this->renta_uni);
            $stmt->bindParam(":importe", $this->importe); 
            $stmt->bindParam(":parte", $this->parte);
            $stmt->execute();
            return $stmt;

        }
        public function  item_renta_insertion()
        { $sqlQuery = "INSERT INTO item_renta (id_pr, articulo, tiempo, cantidad, renta_uni, importe) 
        VALUES (:id_propuesta, :articulo, :tiempo,:cantidad,:renta_uni, :importe) ";
            $stmt = $this->conn->prepare($sqlQuery);
     
            $this->id_propuesta=htmlspecialchars(strip_tags($this->id_propuesta));
           // $this->id_itemv=htmlspecialchars(strip_tags($this->id_itemv));
            $this->articulo=htmlspecialchars(strip_tags($this->articulo));
            $this->tiempo=htmlspecialchars(strip_tags($this->tiempo));
            $this->renta_uni=htmlspecialchars(strip_tags($this->renta_uni));
            $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));
           // $this->importe=(float)$this->renta_uni * (float)$this->cantidad;
           // $this->parte=htmlspecialchars(strip_tags($this->parte));
           // $this->articulo=$this->articulo."%";
            $stmt->bindParam(":id_propuesta", $this->id_propuesta);
           // $stmt->bindParam(":id_itemv", $this->id_itemv);
            $stmt->bindParam(":articulo", $this->articulo);
            $stmt->bindParam(":tiempo", $this->tiempo);
            $stmt->bindParam(":cantidad", $this->cantidad);
            $stmt->bindParam(":renta_uni", $this->renta_uni);
          
            //$stmt->bindParam(":parte", $this->parte);
           // $stmt->bindParam(":tiempo", $this->tiempo);
            $importe =  (float)$this->tiempo * ((float)$this->cantidad *(float)$this->renta_uni);
            $stmt->bindParam(":importe", $importe);
            
            $stmt->execute();
            return $stmt;

        }
        public function  item_leasing_insertion()
        { $sqlQuery = "INSERT INTO item_leasing (id_prl, articulo, nparte, cantidad, costo_unitario,mensualidad) 
            VALUES (:id_prl, :articulo, :nparte, :cantidad, :costo_unitario, :mensualidad)";
            $stmt = $this->conn->prepare($sqlQuery);
     
            $this->id_propuesta=htmlspecialchars(strip_tags($this->id_propuesta));
           // $this->id_itemv=htmlspecialchars(strip_tags($this->id_itemv));
            $this->articulo=htmlspecialchars(strip_tags($this->articulo));
            $this->nparte=htmlspecialchars(strip_tags($this->nparte));
            $this->renta_uni=htmlspecialchars(strip_tags($this->renta_uni));
            $this->cantidad=htmlspecialchars(strip_tags($this->cantidad));
            $this->costo_unitario=htmlspecialchars(strip_tags($this->costo_unitario));
            $this->mensualidad=htmlspecialchars(strip_tags($this->mensualidad));
            $stmt->bindParam(":id_prl", $this->id_propuesta);
            $stmt->bindParam(":articulo", $this->articulo);
            $stmt->bindParam(":nparte", $this->nparte);
           // $stmt->bindParam(":tiempo", $this->tiempo);
            $stmt->bindParam(":cantidad", $this->cantidad);
            $stmt->bindParam(":costo_unitario", $this->costo_unitario);
            $stmt->bindParam(":mensualidad", $this->mensualidad);
            $stmt->execute();
            return $stmt;

        }
        public function  list_articles_renta()
        { $sqlQuery = "SELECT cantidad, articulo,tipo,renta_uni,importe FROM item_renta WHERE id_pr=:id_propuesta 
             ORDER BY  id_item DESC ";
            $stmt = $this->conn->prepare($sqlQuery);
     
            $this->id_propuesta=htmlspecialchars(strip_tags($this->id_propuesta));
            
           // $this->articulo=$this->articulo."%";
            $stmt->bindParam(":id_propuesta", $this->id_propuesta);
            
            

            $stmt->execute();
            return $stmt;

        }
        public function  list_articles_leasing()
        { $sqlQuery = "SELECT id_iteml,cantidad, articulo,nparte,costo_unitario, mensualidad 
         FROM item_leasing WHERE id_prl=:id_propuesta";
            $stmt = $this->conn->prepare($sqlQuery);
     
            $this->id_propuesta=htmlspecialchars(strip_tags($this->id_propuesta));
            
           // $this->articulo=$this->articulo."%";
            $stmt->bindParam(":id_propuesta", $this->id_propuesta);
            
            

            $stmt->execute();
            return $stmt;

        }
        public function  item_leasing_delete()
        { $sqlQuery = "DELETE FROM item_leasing
            WHERE id_iteml = .id_itemv";
            $stmt = $this->conn->prepare($sqlQuery);
     
            $this->id_itemv=htmlspecialchars(strip_tags($this->id_itemv));
            
           // $this->articulo=$this->articulo."%";
            $stmt->bindParam(":id_itemv", $this->id_itemv);

            $stmt->execute();
            return $stmt;

        }
        public function  item_renta_delete()
        { $sqlQuery = "DELETE FROM item_renta
            WHERE id_item = .id_itemv";
            $stmt = $this->conn->prepare($sqlQuery);
     
            $this->id_itemv=htmlspecialchars(strip_tags($this->id_itemv));
            
           // $this->articulo=$this->articulo."%";
            $stmt->bindParam(":id_itemv", $this->id_itemv);

            $stmt->execute();
            return $stmt;

        }
        public function  item_venta_delete()
        { $sqlQuery = "DELETE FROM item_venta
            WHERE id_itemv = .id_itemv";
            $stmt = $this->conn->prepare($sqlQuery);
     
            $this->id_itemv=htmlspecialchars(strip_tags($this->id_itemv));
            
           // $this->articulo=$this->articulo."%";
            $stmt->bindParam(":id_itemv", $this->id_itemv);

            $stmt->execute();
            return $stmt;

        }
        

       
        

        
        
    }