<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require '../db_config/database.php';
    require '../Class/publicdad.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new publicdad($db);
    $stmt = $items->getpublicdad_img();
    $itemCount = $stmt->rowCount();

  
   
    if($itemCount > 0){
        
        $Arr = array();
        $Arr["body"] = array();
        $Arr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_publicidad"=>"https://www.preferente.pcrent.com.mx/upload/publicidad/".$id_publicidad."_img.jpg",
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