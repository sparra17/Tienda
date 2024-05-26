<?php
    require_once ("../config/conexion.php");
    require_once ("../modelo/Producto.php");

    $producto = new Producto();

    switch($_GET["op"]){

        case "listar":
            $datos = $producto -> Producto();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = '<input type="hidden" id="idProducto" name="idProducto" value="'.$row["idProducto"].'"/>
                    '.$row["Producto"]
                    ;
                    
                $sub_array[] = $row["Stock"];
                $sub_array[] = '<input type="text" name="" id="Cantidad" style="width: 70px;">';
                $sub_array[] = '<input type="hidden" id="PrecioVenta" name="PrecioVenta" value="'.$row["PrecioVenta"].'"/>'.$row["PrecioVenta"];

                $sub_array[] = '<Button class="AddProducto" id="btnagregar"><i class="fa-solid fa-plus"></i></Button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecors" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data);
            echo json_encode($results);
            break;

        case "listarinventario":
            $datos = $producto -> Producto();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = $row["Producto"];
                $sub_array[] = $row["Empresa"];
                $sub_array[] = $row["Stock"];
                $sub_array[] = $row["PrecioVenta"];
                $sub_array[] = '<Button class="Editar" onClick="Editar()" id=""><i class="fa-solid fa-pen-to-square"></i></Button>
                                <Button class="Eliminar" onClick="Eliminar()" id=""><i class="fa-solid fa-trash"></i></Button>';
                $data[] = $sub_array;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecors" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data);
            echo json_encode($results);
            break;

        case "inventarioreabastecer":
            $datos = $producto -> Producto();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = $row["Producto"];
                $sub_array[] = $row["Stock"];
                $sub_array[] = '<input type="text" name="" style="width: 70px;">';

                $sub_array[] = $row["PrecioVenta"];
                $sub_array[] = '<Button class="AddProducto" onClick="agregar()" id=""><i class="fa-solid fa-plus"></i></Button>';

                $data[] = $sub_array;
            }
            $results = array(
                "sEcho" => 1,
                "iTotalRecors" => count($data),
                "iTotalDisplayRecords" => count($data),
                "aaData" => $data);
            echo json_encode($results);
            break;

        
    }

?>