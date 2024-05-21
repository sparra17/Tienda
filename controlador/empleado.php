<?php
    require_once ("../config/conexion.php");
    require_once ("../modelo/Empleado.php");

    $empleado = new Empleado();

    switch($_GET["op"]){

        case "listar":
            $datos = $empleado -> Empleado();
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();

                $sub_array[] = $row["Nombre"] . " " . $row["Paterno"] . " " . $row["Materno"];
                $sub_array[] = $row["Sexo"];
                $sub_array[] = '<input type="text" name="" style="width: 70px;" readonly>';
                $sub_array[] = $row["Puesto"];
                $sub_array[] = $row["Direccion"];
                $sub_array[] = $row["Telefono"];
                $sub_array[] = $row["Curp"];
                $sub_array[] = $row["RFC"];
                $sub_array[] = $row["Sueldo"];
                $sub_array[] = $row["Horario"];


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