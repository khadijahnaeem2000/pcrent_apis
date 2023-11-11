<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require '../db_config/database.php';
    require '../Class/proyectos.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new proyectos($db);
    $stmt = $items->proyecto_listado();
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
                 "fecha"=>$fecha,
                 "razon_social"=>$razon_social
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