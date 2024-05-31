<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Categoria o productos</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="login-page">
        <img src="img/perro.jpg">
        <div class="form">
          <form class="login-form" method="post">
            <H4>AÑADIR CATEGORIA</H4>
            <input type="hidden" name="idCategoria" id="idCategoria">
            Nombre:
            <input name="Categoria" id="Categoria" type="text" placeholder="Categoria"/>
            Refrigerado:
            <select name="Refrigerado" id="Refrigerado">
              <option value=1>Refrigerado</option>
              <option value=0>No Refrigerado</option>
            </select>
            <button id="Registrar">Añadir</button>
          </form>
        </div>
        <a href="ventas.php">Regresar</a>
    </div>
    <?php require_once("js.php"); ?>
    <script type="text/JAVASCRIPT" src="Nueva_Categoria.js"></script>
</body>
</html>