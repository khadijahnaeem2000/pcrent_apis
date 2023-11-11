<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require '../db_config/Database.php';
    require '../Class/categories_clientes.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new categories_clientes($db);
    $stmt = $items->categories_select();
    $itemCount = $stmt->rowCount();

  
   
    if($itemCount > 0){
        
        $categoryArr = array();
        $categoryArr["body"] = array();
        $categoryArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
               "id_categoria"=>$id_categoria,
               "descripcion"=>$descripcion
            );
            
            array_push($categoryArr["body"], $e);
        }
        echo json_encode($categoryArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>