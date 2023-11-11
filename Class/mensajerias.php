<?php
    class mensajerias{
        // Connection
        private $conn;
        // Table
        private $db_table = "mensajerias";
        // Columns
        public $id_client;
            public $id_mensajeria;
            public $folio;
            public $id_sucursal;
            public $id_usuario;
            public $folio_pro;  
            public  $fecha;
            public $id_c; 
            public $razon_social ;
            public $contacto;
            public $telefono ; 
            public $fecha_entrega ; 
            public $direccion; 
            public $servicio;
            public $division; 
            public $observaciones; 
            public $operacion; 
            public $programacion;
            public $id_operador;
            public $operador;
            public $f_llegada; 
            public $f_salida;
            public $ubicacion_salida ; 
            public $ubicacion_entrada ; 
            public $obs_ruta; 
            public $estacionamiento;
            public $pasajes;
            public $casetas; 
            public $gasolina;
            public $total_gastos;
            public $asignacion; 
            public $clasificacion_evento;
            public $tipo_evento; 
            public $transport; 
            public $retardo;
            public $k_inicial; 
            public $k_final;
            public $k_total; 
            public $usermod;
            public $fechamod;
            public $referencia; 
            public $estatus;
            public $activo;
           

        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function  mensajeríasasignadas(){
            $sqlQuery = "SELECT id_mensajeria,asignacion,folio, razon_social, direccion,fecha_entrega,operacion,transporte FROM mensajerias
             WHERE id_operador = :id_operador and activo = 1 and YEAR(fecha_entrega) = :years and MONTH(fecha_entrega) = :months and estatus = 'pendiente' order by asignacion ASC";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->id_operador=htmlspecialchars(strip_tags($this->id_operador));
            $this->fecha_entrega=htmlspecialchars(strip_tags($this->fecha_entrega));
            $stmt->bindParam(":id_operador", $this->id_operador);
          //  $stmt->bindParam(":fecha_entrega", $this->fecha_entrega);
            //and YEAR(fecha_entrega) = :years and MONTH(fecha_entrega) = :months
            $date = DateTime::createFromFormat("Y-m-d", $this->fecha_entrega);
            $year=$date->format("Y");
            $month=$date->format("m");
            $stmt->bindParam(":years", $year);
            $stmt->bindParam(":months", $month);
            $stmt->execute();
            return $stmt;
            
        }
        public function  mensajeríasdeliverydata(){
            $sqlQuery = "SELECT folio,razon_social,direccion,contacto,telefono,servicio FROM mensajerias WHERE id_mensajeria = :id_mensajeria";
            $stmt = $this->conn->prepare($sqlQuery);
            $this->id_mensajeria=htmlspecialchars(strip_tags($this->id_mensajeria));
            $stmt->bindParam(":id_mensajeria", $this->id_mensajeria);
            $stmt->execute();
            return $stmt;
            
        }
        public function update_mensajerías_llegada(){
            $sqlQuery = "UPDATE mensajerias SET
                    ubicacion_entrada=:ubicacion_entrada,
                     f_llegada = :f_llegada
                    WHERE 
                    id_mensajeria = :id_mensajeria";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->ubicacion_entrada=htmlspecialchars(strip_tags($this->ubicacion_entrada));
            $this->f_llegada=htmlspecialchars(strip_tags($this->f_llegada));
            $this->id_mensajeria=htmlspecialchars(strip_tags($this->id_mensajeria));
        
            // bind data
            $stmt->bindParam(":ubicacion_entrada", $this->ubicacion_entrada);
            $stmt->bindParam(":f_llegada", $this->f_llegada);
            $stmt->bindParam(":id_mensajeria", $this->id_mensajeria);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
       
        public function update_mensajerías_salida(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    ubicacion_salida=:ubicacion_salida,
                    f_salida = :f_salida
                    WHERE 
                    id_mensajeria = :id_mensajeria";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->ubicacion_salida=htmlspecialchars(strip_tags($this->ubicacion_salida));
            $this->f_salida=htmlspecialchars(strip_tags($this->f_salida));
            $this->id_mensajeria=htmlspecialchars(strip_tags($this->id_mensajeria));
        
            // bind data
            $stmt->bindParam(":ubicacion_salida", $this->ubicacion_salida);
            $stmt->bindParam(":f_salida", $this->f_salida);
            $stmt->bindParam(":id_mensajeria", $this->id_mensajeria);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        public function update_mensajerías_observaciones(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    obs_ruta = :obs_ruta,
                     usermod = :usermod,
                     fechamod= :fechamod ,
                     estatus= 'cerrada'
                    WHERE 
                    id_mensajeria = :id_mensajeria";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->obs_ruta =htmlspecialchars(strip_tags($this->obs_ruta ));
            $this->usermod=htmlspecialchars(strip_tags($this->usermod));
            $this->fechamod=htmlspecialchars(strip_tags($this->fechamod));
            $this->id_mensajeria=htmlspecialchars(strip_tags($this->id_mensajeria));
        
            // bind data
            $stmt->bindParam(":obs_ruta", $this->obs_ruta);
            $stmt->bindParam(":usermod", $this->usermod);
            $stmt->bindParam(":fechamod", $this->fechamod);
            $stmt->bindParam(":id_mensajeria", $this->id_mensajeria);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        public function  mensajería_general(){
            $sqlQuery = "SELECT  folio,razon_social,direccion,fecha_entrega,operacion,obs_ruta, operador  FROM mensajerias
             WHERE  activo = 1 and YEAR(fecha_entrega) = :years
              and MONTH(fecha_entrega) = :months and DAY(fecha_entrega) = :dates  and estatus = 'pendiente' 
              ORDER BY id_mensajeria DESC";

            $stmt = $this->conn->prepare($sqlQuery);
            $this->fecha_entrega=htmlspecialchars(strip_tags($this->fecha_entrega));
            $date = DateTime::createFromFormat("Y-m-d", $this->fecha_entrega);
            $year=$date->format("Y");
            $month=$date->format("m");
            $date=$date->format("d");
            $stmt->bindParam(":years", $year);
            $stmt->bindParam(":months", $month);
            $stmt->bindParam(":dates", $date);
            $stmt->execute();
            return $stmt;
            
        }
        public function  mensajería_general_list(){
            $sqlQuery = "SELECT folio, razon_social, direccion,fecha_entrega,operacion,obs_ruta, operador FROM 
            mensajerias WHERE activo = 1 and estatus = 'pendiente' ORDER BY id_mensajeria DESC";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
            
        }
        public function envios(){
            $sqlQuery = "SELECT folio, fecha, razon_social, fecha_entrega, operacion,
             direccion, servicio, estatus  FROM mensajerias WHERE id_c = :id_client and   activo = 1 
             and estatus != 'abierto' order by fecha_entrega DESC LIMIT 50
            ";
              $stmt = $this->conn->prepare($sqlQuery);
            $this->id_client=htmlspecialchars(strip_tags($this->id_client));
            $stmt->bindParam(":id_client", $this->id_client);  

          
            $stmt->execute();
            return $stmt;
        }
        
       
    }
?>