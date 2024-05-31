$(document).on("click", "#Registrar", function() {    
    const idProveedor = getUrlParameter('d');
    const Nombre = $("#Nombre").val();
    const Paterno = $("#Paterno").val();
    const Materno = $("#Materno").val();
    const Sexo = $("#Sexo").val();
    const Direccion = $("#Direccion").val();
    const Telefono = $("#Telefono").val();
    const Curp = $("#Curp").val();
    const RFC = $("#RFC").val();
    const Empresa = $("#Empresa").val();
    console.log(Nombre);
    if(idProveedor){
        $.post("controlador/proveedor.php?op=modificarProveedor",{
            Nombre:Nombre,
            Paterno:Paterno,
            Materno:Materno,
            Sexo:Sexo,
            Direccion:Direccion,
            Telefono:Telefono,
            Curp:Curp,
            RFC:RFC,
            Empresa:Empresa,
            idProveedor:idProveedor
        }, function(data){
            alert("Proveedor Registrado Correctamente");
            window.location.href = 'Inventario_administrar.php';
        })
    }else{
        $.post("controlador/proveedor.php?op=agregarProveedor",{
            Nombre:Nombre,
            Paterno:Paterno,
            Materno:Materno,
            Sexo:Sexo,
            Direccion:Direccion,
            Telefono:Telefono,
            Curp:Curp,
            RFC:RFC,
            Empresa:Empresa
        }, function(data){
            alert("Proveedor Registrado Correctamente");
            window.location.href = 'Inventario_administrar.php';
        })
    }

})



var getUrlParameter = function getUrlParameter(sParam){
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i

    for (i = 0; i < sURLVariables.length; i++){
        sParameterName = sURLVariables[i].split('=')

        if (sParameterName[0] === sParam){
            return sParameterName[1] === undefined ? true : sParameterName[1]
        }
    }
};