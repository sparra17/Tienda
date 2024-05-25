<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/ventas.css">
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
            <a href="Inventario_administrar.php" >Administrar</a>
            <a href="Inventario_reabastecer.php" class="active">Reabastecer</a>
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
        <h4>Listado de inventario</h4>
        <input type="text" id="buscador" placeholder="Buscador de productos">
        <br>

            <div class="card-body">
            <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th id="Nombre">Producto</th>
                        <th id="Existencia">Existencia</th>
                        <th id="Cantidad">Cantidad Añadir</th>
                        <th id="Precio">Precio</th>
                        <th id="Add">AÑADIR</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
                
    </div>
    <div id="Lista-Venta">
        <h4>Listado de productos nuevos</h4>
        <br>
            <table class="tabla-venta">
                <thead>
                    <tr>
                        <th id="Nombre">Producto</th>
                        <th id="Precio">Precio</th>
                        <th id="Cantidad">Cantidad</th>
                        <th id="Precio">Total</th>
                        <th id="Delete">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Pan</td>
                        <td>1</td>
                        <td>30</td>
                        <td>30</td>
                        <td><button class="Basura"><i class="fa-solid fa-trash"></i></button></td>
                    <tr>
                        <td>Pan</td>
                        <td>1</td>
                        <td>30</td>
                        <td>30</td>
                        <td><button class="Basura"><i class="fa-solid fa-trash"></i></button></td>
                    </tr>
                </tbody>
            </table>
            <button id="Cobrar">Añadir al inventario</button>
    </div>
    <?php require_once("js.php"); ?>
    <script type="text/JAVASCRIPT" src="ventas.js"></script>
</body>
</html>