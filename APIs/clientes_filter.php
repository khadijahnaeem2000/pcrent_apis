<?php
    //header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/clientes.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new clientes($db);
    $items->razon_social = isset($_GET['razon_social']) ? $_GET['razon_social'] : die();
    $items->rfc = isset($_GET['rfc']) ? $_GET['rfc'] : die();
    $stmt = $items->clientes_filter();
    $itemCount = $stmt->rowCount();
   
  
    if($itemCount > 0){
        
        $clientesArr = array();
        $clientesArr["body"] = array();
        $clientesArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "razon_social"=>$razon_social,
                "calle"=>$calle,
                "colonia"=>$colonia,
                "ciudad"=>$ciudad,
                "estado"=>$estado,
                "teledono"=>$telefono
            );
            array_push($clientesArr["body"], $e);
        }
        echo json_encode( $clientesArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>