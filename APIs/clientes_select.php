<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require '../db_config/Database.php';
    require '../Class/clientes.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new clientes($db);
    $stmt = $items->clientes_select();
    $itemCount = $stmt->rowCount();

  
   
    if($itemCount > 0){
        
        $clientArr = array();
        $clientArr["body"] = array();
        $clientArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_cliente"=>$id_cliente,
                "rfc"=>$rfc,
                "razon_social"=>$razon_social,
                "contacto"=>$contacto,
                "teledono"=>$telefono,
                "email"=>$email
            );
        
            array_push($clientArr["body"], $e);
        }
        echo json_encode($clientArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>