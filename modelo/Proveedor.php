

<?php
    class Proveedor extends Conectar{
        public function Proveedor(){
            $conectar = parent::Conexion();
            $sql = "SP_ListarProveedores";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);
        }
        public function agregarProveedor($Nombre,$Paterno,$Materno,$Sexo,$Direccion,$Telefono,$Curp,$RFC,$Empresa){
            $conectar = parent::Conexion();
            $sql = "SP_InProveedores ?, ?, ?, ?, ?, ?, ?, ?, ?";

            $query = $conectar->prepare($sql);
            $query->bindValue(1,$Nombre);
            $query->bindValue(2,$Paterno);
            $query->bindValue(3,$Materno);
            $query->bindValue(4,$Sexo);
            $query->bindValue(5,$Direccion);
            $query->bindValue(6,$Telefono);
            $query->bindValue(7,$Curp);
            $query->bindValue(8,$RFC);
            $query->bindValue(9,$Empresa);
            $query->execute();
        }

        public function modificarProveedor($Nombre,$Paterno,$Materno,$Sexo,$Direccion,$Telefono,$Curp,$RFC,$Empresa,$idProveedor){
            $conectar = parent::Conexion();
            $sql = "ModificarProveedor ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$Nombre);
            $query->bindValue(2,$Paterno);
            $query->bindValue(3,$Materno);
            $query->bindValue(4,$Sexo);
            $query->bindValue(5,$Direccion);
            $query->bindValue(6,$Telefono);
            $query->bindValue(7,$Curp);
            $query->bindValue(8,$RFC);
            $query->bindValue(9,$Empresa);
            $query->bindValue(10,$idProveedor);
            $query->execute();

        }

        public function eliminarProveedor($idProveedor){
            $conectar = parent::Conexion();
            $sql = "EliminarProveedor ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$idProveedor);
            $query->execute();

        }
    }
?>