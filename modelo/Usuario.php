<?php
    class Usuario extends Conectar{
        public function login(){
            $conectar = parent::Conexion();
            if (isset($_POST['enviar'])) {
                $idSucursal = $_POST['idSucursal'];
                $Usuario = $_POST['Usuario'];
                $Pass = $_POST['Pass'];
                if(empty($Usuario) and empty($Pass)){
                    exit();
                }else{
                    $sql = "SP_Acceso ?,?,?";
                    $query = $conectar -> prepare($sql);
                    $query -> bindValue(1,$idSucursal);
                    $query -> bindValue(2,$Usuario);
                    $query -> bindValue(3,$Pass);
                    $query -> execute();

                    $resultado = $query -> fetch();
                    if(is_array($resultado) and count($resultado) > 0){
                        $_SESSION['idEmpleado'] = $resultado['idEmpleado'];
                        $_SESSION['Nombre'] = $resultado['Nombre'];
                        $_SESSION['Paterno'] = $resultado['Paterno'];
                        $_SESSION['idPuesto'] = $resultado['idPuesto'];
                        $_SESSION['Usuario'] = $resultado['Usuario'];
                        

                        header("Location:".conectar::ruta()."ventas.php");
                    }else{
                        exit();
                    }
                }
            }else{
                exit();
            }
        }
    }
?>