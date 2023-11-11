<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: PUT");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    require '../db_config/database.php';
    require '../Class/mensajerias.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $item = new mensajerias($db);
    
    
    $item->id_mensajeria = isset($_GET['id']) ? $_GET['id'] : die();
    $item->obs_ruta = isset($_GET['obs_ruta'])?$_GET['obs_ruta'] : die();
    $item->fechamod = isset($_GET['fechamod']) ? $_GET['fechamod'] : die();
    
    
    if($item->update_mensajerías_observaciones()){
        echo json_encode("Data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }

?>