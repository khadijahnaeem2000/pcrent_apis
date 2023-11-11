<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require '../db_config/database.php';
    require '../Class/prefacturas.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new prefacturas($db);
    $stmt = $items->facturacion_general();
    $itemCount = $stmt->rowCount();

  
    $sqlQuery ="SELECT SUM(cost_uni*cant*dfacturado) AS TOTAL FROM items_prefactura WHERE id_pre =7192 LIMIT 0,1";
    $stm = $db->prepare($sqlQuery);
    $stm->execute();
    $r = $stm->fetch(PDO::FETCH_ASSOC);
    $subtotal=$r['TOTAL'];
    if($itemCount > 0){
        
        $Arr = array();
        $Arr["body"] = array();
        $Arr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            if($descuento > 0 ){
                $subdesc = ($subtotal * ($descuento / 100));
                $total = $subtotal-$subdesc;
                $total=number_format($total,2);
            }
                else
                {  
                $total = $subtotal;
                $total=number_format($total,2);
                }
                
            $e = array(
            "id_prefactura"=>$id_prefactura, 
            "foliopre"=>$foliopre, 
            "razon_social"=>$razon_social, 
            "fecha_alta"=>$fecha_alta,
             "folio_cont"=>$folio_cont,
             "fecha_inicial"=>$fecha_inicial, 
            "fecha_final"=>$fecha_final, 
            "descuento"=>$descuento,
            "total"=>$total,
            "prefactura"=>"https://www.preferente.pcrent.com.mx/upload/facturas/".$id_prefactura."_factura.pdf"
            );
            array_push($Arr["body"], $e);
        }
        echo json_encode($Arr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>