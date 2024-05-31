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
            <H4>AÑADIR PROVEEDOR</H4>
            Nombre:
            <input id="Nombre"type="text" placeholder="Nombre"/>
            Apellido Paterno:
            <input id="Paterno" type="text" placeholder="Apellido Paterno"/>
            Apellido Materno:
            <input id="Materno" type="text" placeholder="Apellido Materno"/>
            Sexo:
            <select name="Sexo" id="Sexo">
              <option value="1">Masculino</option>
              <option value="2">Femenino</option>
              <option value="3">Otro</option>
            </select>
            Direccion:
            <input id="Direccion" type="text" placeholder="Direccion"/>
            Telefono:
            <input id="Telefono" type="tel" placeholder="Telefono"/>
            Curp:
            <input id="Curp" type="text" placeholder="Curp" style="text-transform: uppercase;"/>
            RFC:
            <input id="RFC" type="text" placeholder="RFC" style="text-transform: uppercase;"/>
            Empresa:
            <input id="Empresa" type="text" placeholder="Empresa">
            <button id="Registrar">Registrar</button>

          </form>
          <a href="ventas.php">Regresar</a>

        </div>

    
      <?php require_once("js.php"); ?>
    <script type="text/JAVASCRIPT" src="Nuevo_Proveedor.js"></script>
</body>
