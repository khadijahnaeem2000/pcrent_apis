<?php
    //header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/documentos.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new documentos($db);
    $items->id_proyecto = isset($_GET['id_proyecto']) ? $_GET['id_proyecto'] : die();
    $stmt = $items->documentos();
    $itemCount = $stmt->rowCount();
   
  
    if($itemCount > 0){
        
        $documentosArr = array();
        $documentosArr["body"] = array();
        $documentosArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_documento"=>"https://www.preferente.pcrent.com.mx/upload/ documentos/".$id_documento."_archivo",
                 "fecha"=>$fecha,
                 "nombred"=>$nombred
            );
            array_push( $documentosArr["body"], $e);
        }
        echo json_encode( $documentosArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>