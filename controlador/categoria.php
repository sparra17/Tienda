<?php
    require_once ("../config/conexion.php");
    require_once ("../modelo/Categoria.php");

    $categoria = new Categoria();

    switch($_GET["op"]){

        case "listar":
            $datos = $categoria -> Categoria();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = $row["Categoria"];

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