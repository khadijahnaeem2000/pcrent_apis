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
    $item = new propuestas_renta($db);
    $data = json_decode(file_get_contents("php://input"));
    $item->id_suc=$data->id_suc;
   // $item->folio=$data->folio;
     $item->fechaalta=$data->fechaalta;
     $item->finicial=$data->finicial;
     $item->ftermino=$data->ftermino;
     $item->dias=$data->dias;
     $item->idcl=$data->idcl;
    $item->cliente=$data->cliente;
    $item->rfc=$data->rfc;
    $item->contato=$data->contato;
    $item->telefono=$data->telefono;
    $item->email=$data->email;
    $item->lugar_entrega=$data->lugar_entrega;
    $item->vigencia=$data->vigencia;
    $item->ejecutivo=$data->ejecutivo;
    $item->observaciones=$data->observaciones;
   
    if($item->propuestas_renta_insertion()){
        echo 'created successfully.';
    } else{
        echo ' could not be created.';
    }

?>