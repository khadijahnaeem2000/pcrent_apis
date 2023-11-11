<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/mensajerias.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new mensajerias($db);
    $items->id_mensajeria = isset($_GET['id_mensajeria']) ? $_GET['id_mensajeria'] : die();
    $stmt = $items->mensajeríasdeliverydata();
    $itemCount = $stmt->rowCount();
   
  
    
    if($itemCount > 0){
        
        $mensajeriasArr = array();
        $mensajeriasArr["body"] = array();
        $mensajeriasArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
               
                "folio"=>$folio,
                 "razon_social"=>$razon_social,
                  "direccion"=>$direccion,
                  "contacto"=>$contacto,
                  "telefono"=>$telefono,
                  "servicio"=>$servicio
            );
            array_push($mensajeriasArr["body"], $e);
        }
        echo json_encode($mensajeriasArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>