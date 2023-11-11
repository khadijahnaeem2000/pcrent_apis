<?php
    //header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/item_venta.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new item_venta($db);
  
    $items->id_itemv = isset($_GET['id_itemv']) ? $_GET['id_itemv'] : die();
  
    $stmt = $items->item_venta_delete();
    $itemCount = $stmt->rowCount();
   
  
    if($itemCount > 0){
        
        $clientesArr = array();
        $clientesArr["body"] = array();
        $clientesArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "success"=>"success",
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