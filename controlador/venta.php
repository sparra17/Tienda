<?php
require_once ("../config/conexion.php");
require_once ("../modelo/Venta.php");

    $venta = new Venta();

    switch($_GET["op"]){

        case "registrar":
            $datos = $venta -> InsertTempVenta();
                foreach($datos as $row){
                    $output["idVenta"] = $row["idVenta"];
                }
                echo json_encode($output);
            break;

    }

?>