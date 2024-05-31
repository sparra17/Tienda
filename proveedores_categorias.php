<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores Y categorias</title>
    <link rel="stylesheet" href="styles/Inventario.css">
    <script src="https://kit.fontawesome.com/d00178e030.js" crossorigin="anonymous"></script>
</head>
<body>
    <ul>
        <li><a href="ventas.php">Ventas</a></li>
        <li>
            <li>
                <div class="dropdown">
                    <button class="dropbtn">Inventario 
                      <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                      <a href="Inventario_administrar.php">Administrar</a>
                      <a href="Inventario_reabastecer.php">Reabastecer</a>
                    </div>
            </li>
            <li><div class="dropdown">
                <button class="dropbtn">Empleados 
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="Nuevo_Empleado.php">Registrar</a>
                  <a href="Corregir_Empleado.php">Corregir datos</a>
                </div></li>
            <li><a href="proveedores_categorias.php">Proveedores y Categorias</a></li>
        <li><p id="user">Usuario</p></li>
        <li style="float:right"><a href="login.php" id="Salir">Salir</a></li>
    </ul>
    <div id="Lista-Producto">
        <h4>Listado de Categorias</h4>
        <a href="proveedores_categorias_add.php" class="Add">Añadir categorias o proveedor</a>
        <br>

           
            <div class="card-body">
            <table id="table_cat" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                    <th id="Categoria">Categoria</th>
                        <th id="Opciones">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                                                    
                </tbody>
            </table>
        </div>
          
    </div>
    <div id="Lista-Producto2">
        <h4>Listado de Proveedor</h4>
        <a href="proveedores_categorias_add.php" class="Add">Añadir categorias o proveedor</a>
        <br>
 
            <div class="card-body">
                <table id="table_prov" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                    <thead>
                        <tr>
                        <th id="Proveedor">Proveedor</th>
                        <th id="Opciones">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                                                        
                    </tbody>
                </table>
            </div>
    </div>
    <?php require_once("js.php"); ?>
    <script type="text/JAVASCRIPT" src="proveedores_categorias.js"></script>
</body>
</html>