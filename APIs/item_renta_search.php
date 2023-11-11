<?php
    //header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require '../db_config/database.php';
    require '../Class/item_venta.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new item_venta($db);
    $items->id_propuesta = isset($_GET['id_propuesta']) ? $_GET['id_propuesta'] : die();

    $stmt = $items->list_articles_renta();
    $itemCount = $stmt->rowCount();
   
    $sqlQuery ="SELECT SUM(importe) AS SUBTOTAL FROM item_venta 
    WHERE id_propuesta =".$items->id_propuesta;
    $stm = $db->prepare($sqlQuery);
    $stm->execute();
    $r = $stm->fetch(PDO::FETCH_ASSOC);
    $subtotal=$r['SUBTOTAL'];
    $sqlQuery ="SELECT tasa AS IVA FROM grupo_impuestos WHERE id_impuesto=1";
    $stm = $db->prepare($sqlQuery);
    $stm->execute();
    $r = $stm->fetch(PDO::FETCH_ASSOC);
    $IVA=$r['IVA'];
    $IVA=($subtotal * ($IVA / 100));
    $TOTAL_MENSUAL =  number_format($subtotal +  $IVA, 2);
    if($itemCount > 0){
        
        $clientesArr = array();
        $clientesArr["body"] = array();
        $clientesArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
               
                "cantidad"=>$cantidad,
                 "articulo"=>$articulo,
                 "tipo"=>$tipo,
                 "renta_uni"=>$renta_uni,
                "importe"=>$importe,
                "SUBTOTAL"=>$subtotal,
                "IVA"=>$IVA,
                "TOTAL_MENSUAL"=>$TOTAL_MENSUAL
                
            );
            array_push($clientesArr["body"], $e);
        }
        echo json_encode( $clientesArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>