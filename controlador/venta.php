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

        case "guardardetalle":
            $datos = $venta -> InsertDetalleVenta($_POST["idVenta"],$_POST["idProducto"],$_POST["PrecioVenta"],$_POST["Cantidad"]);
            break;

            case "listardetalle":
                $datos = $venta -> ListarTempVenta($_POST["idVenta"]);
                $data = Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["Producto"];
                    $sub_array[] = $row["PrecioVenta"];
                    $sub_array[] = $row["Cantidad"];

                    $sub_array[] = $row["Total"];
    
                    $sub_array[] = '<Button type="button" class="Eliminar" onClick="eliminar('.$row["idTempVenta"].','.$row["idVenta"].')" id="'.$row["idTempVenta"].'"><i class="fa-solid fa-trash"></i></Button>';
                    
                    $data[] = $sub_array;
                }
                $results = array(
                    "sEcho" => 1,
                    "iTotalRecors" => count($data),
                    "iTotalDisplayRecords" => count($data),
                    "aaData" => $data);
                echo json_encode($results);
                break;

            case "eliminardetalle":
            $venta -> EliminarTempVenta($_POST["idTempVenta"]);
            break;

    }

?>