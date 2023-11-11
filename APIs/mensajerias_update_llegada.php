<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    require '../db_config/database.php';
    require '../Class/mensajerias.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $item = new mensajerias($db);

    $item->id_mensajeria = isset($_GET['id']) ? $_GET['id'] : die();
    $item->ubicacion_entrada = isset($_GET['ubicacion_entrada'])?$_GET['ubicacion_entrada'] : die();
    $item->f_llegada = isset($_GET['f_llegada']) ? $_GET['f_llegada'] : die();

    
    
    if($item->update_mensajerías_llegada()){
        echo json_encode("Data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }

?>