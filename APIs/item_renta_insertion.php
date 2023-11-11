<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/item_venta.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new item_venta($db);
    $item->id_propuesta = isset($_GET['id_propuesta']) ? $_GET['id_propuesta'] : die();
    $item->articulo = isset($_GET['articulo']) ? $_GET['articulo'] : die();
    $item->tiempo = isset($_GET['tiempo']) ? $_GET['tiempo'] : die();
    $item->cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : die();
    $item->renta_uni = isset($_GET['renta_uni']) ? $_GET['renta_uni'] : die();


    if($item->item_renta_insertion()){
        echo 'created successfully.';
    } else{
        echo ' could not be created.';
    }

?>