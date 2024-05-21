$(document).ready(function(){
    console.log("test");
    $.post("controlador/sucursal.php?op=combo", function(data){
        $("#idSucursal").html(data)
    });
});