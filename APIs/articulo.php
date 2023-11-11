<?php
    //header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/arti.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new arti($db);
    $items->articulo = isset($_GET['articulo']) ? $_GET['articulo'] : die();
    $stmt = $items->articulo_search();
    $itemCount = $stmt->rowCount();
   
  
    if($itemCount > 0){
        
        $Arr = array();
        $Arr["body"] = array();
        $Arr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
            
                "nombre"=>$nombre, 
                "folio"=>$folio 
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