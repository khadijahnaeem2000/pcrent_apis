<?php
    //header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/proyectos.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new proyectos($db);
    $items->id_client = isset($_GET['id_client']) ? $_GET['id_client'] : die();
    $stmt = $items->proyecto_clientes();
    $itemCount = $stmt->rowCount();
   
  
    if($itemCount > 0){
        
        $proyectoArr = array();
        $proyectoArr["body"] = array();
        $proyectoArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_proyecto"=>$id_proyecto,
                "descripcion"=>$descripcion,
                "fecha"=>$fecha
            );
            array_push($proyectoArr["body"], $e);
        }
        echo json_encode($proyectoArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>