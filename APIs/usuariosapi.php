<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require '../db_config/Database.php';
    require '../Class/usuarios.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new usuarios($db);
    $stmt = $items->getEmployees();
    $itemCount = $stmt->rowCount();

  
   
    if($itemCount > 0){
        
        $usuariosArr = array();
        $usuariosArr["body"] = array();
        $usuariosArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id_usuario" => $id_usuario,
                "id_sucursal" => $id_sucursal,
                "nombre" => $nombre,
                "contrasena" => $contrasena,
                "departamento" => $departamento,
                "tipo_usuario" => $tipo_usuario,
                "activo" => $activo,
                "puesto" => $puesto,
                "telefono" => $telefono
            );
            array_push($usuariosArr["body"], $e);
        }
        echo json_encode($usuariosArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>