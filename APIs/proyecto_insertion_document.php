<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/documentos.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new documentos($db);

    $item->id_proyecto = isset($_GET['id_proyecto']) ? $_GET['id_proyecto'] : die();
    $item->tipo = isset($_GET['tipo'])?$_GET['tipo'] : die();
    $item->fecha = isset($_GET['fecha']) ? $_GET['fecha'] : die();
   // $item->sede = isset($_GET['sede'])?$_GET['sede'] : die();
    $item->id_cl = isset($_GET['id_cl']) ? $_GET['id_cl'] : die();
    $item->id_suc= isset($_GET['id_suc'])?$_GET['id_suc'] : die();
    $item->usuario = isset($_GET['usuario']) ? $_GET['usuario'] : die();
    $item->extension= isset($_GET['extension'])?$_GET['extension'] : die();
    $item->archivo= isset($_GET['archivo'])?$_GET['archivo'] : die();
    
   
    
    if($item->proyecto_document_insertion()){
        echo 'created successfully.';
    } else{
        echo ' could not be created.';
    }

?>