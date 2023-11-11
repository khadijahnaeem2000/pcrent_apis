<?php
    //header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/propuestas_renta.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new propuestas_renta($db);
    $items->cliente = isset($_GET['cliente']) ? $_GET['cliente'] : die();
    $items->fechaalta = isset($_GET['fechaalta']) ? $_GET['fechaalta'] : die();
    $items->id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : die();
  
    $stmt = $items->propuestas_renta_filter();
    $itemCount = $stmt->rowCount();
   
  
    if($itemCount > 0){
        
        $clientesArr = array();
        $clientesArr["body"] = array();
        $clientesArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_pr"=>$id_pr, 
                "folio"=>$folio, 
                "fechaalta"=>$fechaalta,
                "cliente"=>$cliente
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