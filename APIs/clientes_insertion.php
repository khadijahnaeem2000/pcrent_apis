<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/clientes.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new clientes($db);
    
    
    $item->rfc = isset($_GET['rfc']) ? $_GET['rfc'] : die();
    $item->razon_social = isset($_GET['razon_social'])?$_GET['razon_social'] : die();
    $item->calle = isset($_GET['calle']) ? $_GET['calle'] : die();
    $item->colonia = isset($_GET['colonia']) ? $_GET['colonia'] : die();
    $item->ciudad = isset($_GET['ciudad'])?$_GET['ciudad'] : die();
    $item->estado = isset($_GET['estado']) ? $_GET['estado'] : die();
    $item->pais = isset($_GET['pais']) ? $_GET['pais'] : die();
    

    if($item->client_insertion()){
        echo 'created successfully.';
    } else{
        echo ' could not be created.';
    }

?>