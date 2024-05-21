

<?php
    class Empleado extends Conectar{
        public function Empleado(){
            $conectar = parent::Conexion();
            $sql = "SP_ListarEmpleados";
            $query = $conectar -> prepare($sql);
            $query -> execute();
            return $query -> fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>