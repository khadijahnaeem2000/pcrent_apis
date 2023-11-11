<?php
     header("Content-Type: application/json; charset=UTF-8");
     header("Access-Control-Allow-Methods: POST");
     header("Access-Control-Max-Age: 3600");
     header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    require '../db_config/database.php';
    require '../Class/prefacturas.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new prefacturas($db);
    $items->id_client = isset($_GET['id_client']) ? $_GET['id_client'] : die();
    $stmt = $items->facturacion_general_client();
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
       // print_r($data);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>