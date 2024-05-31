<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/ventas.css">
    <script src="https://kit.fontawesome.com/d00178e030.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    
</head>
<body>
    <ul>
        <li><a href="ventas.php" class="active">Ventas</a></li>
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

      <input type="hidden" name="idVenta" id="idVenta">

    <div>
    <div id="Lista-Producto">
        <h4>Listado de inventario</h4>
    
        <br>
        <div class="card-body">
            <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th >Producto</th>
                        <th>Exstencia</th>
                        <th>Cantidad Añadir</th>
                        <th>Precio</th>
                        <th>Añadir</th>
                    </tr>
                </thead>
                <tbody>
                                                
                </tbody>
            </table>
        </div>
    </div>
    <div id="Lista-Venta">
        <h4>Listado de Venta</h4>
        <br>

            <div class="card-body">
            <table id="tabla_venta" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th id="Nombre">Producto</th>
                        <th id="Precio">Precio</th>
                        <th id="Cantidad">Cantidad</th>
                        <th id="PrecioVenta">Total</th>
                        <th id="eliminar">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                                                    
                </tbody>
            </table>
        </div>
            <p style="font-size: 25px;">Total:</p>
            <p style="font-size: 25px;" id="txttotal">0</p>
            <button id="Cobrar">Cobrar</button>
    </div>
    </div>

    <?php require_once("js.php"); ?>
    <script type="text/JAVASCRIPT" src="ventas.js"></script>
</body>
</html>