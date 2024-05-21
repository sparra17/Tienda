<?php
    require_once("config/conexion.php");
    if (isset($_POST["enviar"]) and $_POST["enviar"] == "si"){
        require_once("modelo/Usuario.php");
        $usuario = new Usuario();
        $usuario->login();
    }
?>
<script src="modelo/Sucursal.php"></script>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/JAVASCRIPT" src="login.js"></script>
</body>
</head>
<body>
    <div class="login-page">
        <img src="img/perro.jpg">
        <div class="form">
          <form class="login-form" method="post" id="login_form">
            Sucursal:
            <select name="idSucursal" id="idSucursal">
            </select>
            
            <input type="text" name="Usuario" id="Usuario" placeholder="Username"/>
            <input type="password" name="Pass" id="Pass" placeholder="Password"/>

            <div>
            <input type="hidden" name="enviar" class="form-control" value="si">
            <button type="submit">Ingresar</button>
            </div>
          </form>
        </div>
      </div>
  
      <footer>
        <div class="contenedor-pie-pagina">
          <p>Conecta con el administrador<br>correo@correo.com</p>
        </div>
      </footer>
    </body>
      
</html>