<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/usuarios_pf.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new usuarios_pf($db);
    $item->email = isset($_GET['email']) ? $_GET['email'] : die();
    $item->contrasena = isset($_GET['password']) ? $_GET['password'] :die();
  
    $item->client_login();
    if($item->id_usuario != null){
        // create array
        $arr = array(
           "id_usuario" => $item->id_usuario,
             "nombre" => $item->nombre,
             "id_cliente" => $item->id_cliente
        );
      
        http_response_code(200);
        echo json_encode($arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>