<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-page">
        <img src="img/perro.jpg">
        <div class="form">
          <form class="login-form">
            <input type="hidden" name="idProducto" id="idProducto">
            <H4>AÑADIR PRODUCTO</H4>
            <input type="text" name="Producto" id="Producto" placeholder="Producto"/>
            Caducidad:
            <input type="date" name="Caducidad" id="Caducidad" placeholder="Caducidad"/>
            <input type="text" name="Lote" id="Lote" placeholder="Lote"/>
            Proveedor:
            <select name="idProveedor" id="idProveedor">
            </select>
            Categoria:
            <select name="idCategoria" id="idCategoria">
            </select>
            <input type="text" name="Stock" id="Stock" placeholder="Stock"/>
            <input type="text" name="PrecioVenta" id="PrecioVenta" placeholder="Precio Venta"/>
            <input type="text" name="PrecioCompra" id="PrecioCompra" placeholder="Precio Compra"/>

            <button id="Registrar">Registrar</button>
            <a href="Inventario_administrar.php">Regresar</a>
          </form>
        </div>
      </div>
      <?php require_once("js.php"); ?>
    <script type="text/JAVASCRIPT" src="Nuevo_Producto.js"></script>
</body>
</html>