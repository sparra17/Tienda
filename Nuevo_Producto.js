$(document).ready(function(){
    var idProducto = getUrlParameter('d');

    if (idProducto) {
    $.post("controlador/producto.php?op=mostrarproductosID",{idProducto,idProducto}, function(data){
        console.log(data)
        data=JSON.parse(data);

        $("#Producto").val(data.Producto);
        $("#Caducidad").val(data.Caducidad);
        $("#Lote").val(data.Lote);
        $("#idProveedor").val(data.idProveedor);
        $("#idCategoria").val(data.idCategoria);
        $("#Stock").val(data.Stock);
        $("#PrecioVenta").val(data.PrecioVenta);
        $("#PrecioCompra").val(data.PrecioCompra);
    });
    }


    console.log("test");
    $.post("controlador/proveedor.php?op=combo", function(data){
        $("#idProveedor").html(data)
    });

    $.post("controlador/categoria.php?op=combo", function(data){
        $("#idCategoria").html(data)
    });
});

$(document).on("click", "#Registrar", function() {
    var idProducto = getUrlParameter('d');
    var Producto = $("#Producto").val();
    var Caducidad = $("#Caducidad").val();
    var Lote = $("#Lote").val();
    var idProveedor = $("#idProveedor").val();
    var idCategoria = $("#idCategoria").val();
    var Stock = $("#Stock").val();
    var PrecioCompra = $("#PrecioCompra").val();
    var PrecioVenta = $("#PrecioVenta").val();
    
    if (idProducto) {
        $.post("controlador/producto.php?op=ModificarProducto", {
            idProducto: idProducto,
            Producto: Producto,
            Caducidad: Caducidad,
            Lote: Lote,
            idProveedor: idProveedor,
            idCategoria: idCategoria,
            Stock: Stock,
            PrecioVenta: PrecioVenta,
            PrecioCompra: PrecioCompra
        }, function(data){
            alert('Producto Modificado Correctamente');
            window.location.href = 'Inventario_administrar.php';
        });
    } else {
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
            window.location.href = 'Inventario_administrar.php';
        });
    }
});



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