<?php
    //header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/mensajerias.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new mensajerias($db);
    $stmt = $items->mensajería_general_list();
   
    $itemCount = $stmt->rowCount();

  
   
    if($itemCount > 0){
        
        $Arr = array();
        $Arr["body"] = array();
        $Arr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "folio"=>$folio,
                "razon_social"=>$razon_social,
                 "direccion"=>$direccion,
                 "fecha_entrega"=>$fecha_entrega,
                 "operacion"=>$operacion,
                 "obs_ruta"=>$obs_ruta,
                  "operador"=>$operador
            );
        
            array_push($Arr["body"], $e);
        }
        echo json_encode($Arr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
    
?>