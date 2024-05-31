<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/ventas.css">
    <link rel="stylesheet" href="styles/Inventario.css">
    <script src="https://kit.fontawesome.com/d00178e030.js" crossorigin="anonymous"></script>
</head>
<body>
    <ul>
        <li><a href="ventas.php">Ventas</a></li>
        <li>
        <div class="dropdown">
            <button class="dropbtn active">Inventario 
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="Inventario_administrar.php"  class="active">Administrar</a>
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
        </div>
    </li>
    <li>
        <div class="dropdown">
                <button class="dropbtn">Proveedores 
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="Nuevo_Proveedor.php">Nuevo Proveedro</a>
                  <a href="Lista_proveedores.php">Ver Proveedores</a>
                </div>
        </li>
        <li>
        <div class="dropdown">
                <button class="dropbtn">Categorias 
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="Nueva_Categoria.php">Nueva Categoria</a>
                  <a href="Lista_Categorias.php">Ver Categorias</a>
                </div>
        </li>       
        <li><p id="user">Usuario</p></li>
        <li style="float:right"><a href="login.php" id="Salir">Salir</a></li>
    </ul>
    <div id="Lista-Categorias">
        <h4>Listado de Categorias</h4>
        
        <a href="Nueva_Categoria.php" class="Add">Añadir otro producto</a>
        <br>
            
        <div class="card-body">
            <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th id="Categoria">Categoria</th>
                        <th id="Rrefrigeracion">Rrefrigerado</th>
                        <th id="Opciones">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                                                    
                </tbody>
            </table>
        </div>
   
                
    </div>
    <?php require_once("js.php"); ?>
    <script type="text/JAVASCRIPT" src="Lista_Categoria.js"></script>
</body>
</html>