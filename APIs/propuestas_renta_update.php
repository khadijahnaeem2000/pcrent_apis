<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/propuestas_renta.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new propuestas_renta($db);
    $items->idcl = isset($_GET['idcl']) ? $_GET['idcl'] : die();
    $items->cliente = isset($_GET['cliente']) ? $_GET['cliente'] : die();
    $items->rfc = isset($_GET['rfc']) ? $_GET['rfc'] : die();

    $items->contacto = isset($_GET['contacto']) ? $_GET['contacto'] : die();
    $items->telefono = isset($_GET['telefono']) ? $_GET['telefono'] : die();
    $items->email = isset($_GET['email']) ? $_GET['email'] : die();
    $items->entrega = isset($_GET['entrega']) ? $_GET['entrega'] : die();
    $items->vigencia = isset($_GET['vigencia']) ? $_GET['vigencia'] : die();
    $items->lugar_entrega = isset($_GET['lugar_entrega']) ? $_GET['lugar_entrega'] : die();
    $items->observaciones = isset($_GET['observaciones']) ? $_GET['observaciones'] : die();
    $items->id_propuesta = isset($_GET['id_propuesta']) ? $_GET['id_propuesta'] : die();
   
    if($items->propuestas_renta_update()){
        echo 'updated successfully.';
    } else{
        echo ' could not be created.';
    }

?>