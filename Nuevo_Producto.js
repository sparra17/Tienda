$(document).ready(function(){
    console.log("test");
    $.post("controlador/proveedor.php?op=combo", function(data){
        $("#idProveedor").html(data)
    });

    $.post("controlador/categoria.php?op=combo", function(data){
        $("#idCategoria").html(data)
    });
});

$(document).on("click", "#Registrar", function() {

    var Producto = $("#Producto").val();
    var Caducidad = $("#Caducidad").val();
    var Lote = $("#Lote").val();
    var idProveedor = $("#idProveedor").val();
    var idCategoria = $("#idCategoria").val();
    var Stock = $("#Stock").val();
    var PrecioCompra = $("#PrecioCompra").val();
    var PrecioVenta = $("#PrecioVenta").val();
    
    $.post("controlador/producto.php?op=GuardarProducto", {
        Producto: Producto,
        Caducidad: Caducidad,
        Lote: Lote,
        idProveedor: idProveedor,
        idCategoria: idCategoria,
        Stock: Stock,
        PrecioVenta: PrecioVenta,
        PrecioCompra: PrecioCompra
        
    }, function(data){
        alert('Producto Registrado Correctamente');
    });

});

