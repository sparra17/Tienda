<?php
    require_once ("../config/conexion.php");
    require_once ("../modelo/Proveedor.php");

    $proveedor = new Proveedor();

    switch($_GET["op"]){

        case "listar":
            $datos = $proveedor -> Proveedor();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = $row["Empresa"];

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

    }

?>