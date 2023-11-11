<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/usuarios.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new usuarios($db);
    $item->email = isset($_GET['email']) ? $_GET['email'] : die();
    $item->contrasena = isset($_GET['password']) ? $_GET['password'] :die();
  
    $item->getSingleEmployee();
    if($item->id_usuario != null){
        // create array
        $emp_arr = array(
           "id_usuario" => $item->id_usuario,
             "id_sucursal" => $item->id_sucursal,
             "tipo_usuario" => $item->tipo_usuario
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Employee not found.");
    }
?>