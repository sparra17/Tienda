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
                $sub_array[] = $row["Refrigeracion"];
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

        case "combo":
                $datos = $categoria -> Categoria();
                if(is_array($datos)==true and count($datos)>0){
                    $html="";
                    $html.="<option selected>Seleccionar</option>";
                    foreach($datos as $row){
                        $html.="<option value='".$row["idCategoria"]."'>".$row["Categoria"]."</option>";
                    }
                    echo $html;
                }
                break;
        case "guardarCategoria":
                $categoria->agregarCategoria($_POST["Categoria"],$_POST["Refrigeracion"]);
                break;
        case "modificarCategoria":
                $categoria->modificarCategoria($_POST['Categoria'],$_POST['Refrigeracion'],$_POST['idCategoria']);
                break;
        case "eliminarCategoria":
            $categoria->eliminarCategoria($_POST["idCategoria"]);
            break;
    }

?>