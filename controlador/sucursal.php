<?php
    require_once ("../config/conexion.php");
    require_once ("../modelo/Sucursal.php");

    $sucursal = new Sucursal();

    switch($_GET["op"]){

        case "mostrar":
            $datos = $sucursal -> sucursales();
            if (is_array($datos) == true and count($datos) >0){
                foreach($datos as $row){
                    $output["idCategoria"] = $row["idCategoria"];
                    $output["Categoria"] = $row["Categoria"];
                }
                echo json_encode($output);
            }
            break;

        //case "eliminar":
          //  $categoria -> DeleteCategorias($_POST["idCategoria"]);
            //break;

        case "combo":
            $datos = $sucursal -> sucursales();
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.="<option value='".$row["idSucursal"]."'>".$row["Sucursal"]."</option>";
                }
                echo $html;
            }
            break;
    }
?>