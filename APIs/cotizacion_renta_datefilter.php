<?php
     header("Content-Type: application/json; charset=UTF-8");
     header("Access-Control-Allow-Methods: POST");
     header("Access-Control-Max-Age: 3600");
     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    require '../db_config/database.php';
    require '../Class/cotizacion_renta.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new cotizacion_renta($db);
    $items->id_client = isset($_GET['id_client']) ? $_GET['id_client'] : die();
    $items->date1 = isset($_GET['date1']) ? $_GET['date1'] : die();
    $items->date2 = isset($_GET['date2']) ? $_GET['date2'] : die();
    $stmt = $items->renta_daterange();
    $itemCount = $stmt->rowCount();
 
  
 
    if($itemCount > 0){
        
        $Arr = array();
        $Arr["body"] = array();
        $Arr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
                
            $e = array(
                 "ftermino"=>$ftermino, 
                 "oc"=>$oc, 
                 "ult_pre"=>$ult_pre,
                 "ingresado"=>$ingresado,
                "consecutivo"=>$consecutivo, 
                "finicial"=>$finicial, 
                "contacto"=>$contacto, 
                "estatus"=>$estatus 
            );
            array_push($Arr["body"], $e);
        }
        echo json_encode($Arr);
    }
    else{
       // print_r($data);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>