
$(document).ready(function(){
    
    $('#table_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            
        ],
        "ajax": {
            url: "controlador/producto.php?op=listar",
            type: "post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 3,
        "order": [[0, "asc"]],
        "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "",
            "sInfoEmpty":      "",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });

    $.post("controlador/venta.php?op=registrar",function(data){
        console.log(data);
        data=JSON.parse(data);
        $('#idVenta').val(data.idVenta);
    });

});



$(document).on("click", "#btnagregar", function() {
    var idVenta = $("#idVenta").val();
    var idProducto = $("#idProducto").val();
    var PrecioVenta = $("#PrecioVenta").val();
    var Cantidad = $("#Cantidad").val();
    var Stock = $("#Stock").val();

    // Convertir las variables a números para asegurar la comparación correcta
    var cantidad = parseFloat(Cantidad);
    var stock = parseFloat(Stock);

    // Verificar si la cantidad está vacía, no es un número o es mayor que el stock
    if (isNaN(cantidad) || cantidad <= 0 || cantidad > stock) {
        swal.fire({
            title: 'Venta',
            text: 'Error En La Cantidad',
            icon: 'error'
        });
    } else {
        $.post("controlador/venta.php?op=guardardetalle", {
            idVenta: idVenta,
            idProducto: idProducto,
            PrecioVenta: PrecioVenta,
            Cantidad: Cantidad
        }, function(data) {
            console.log(data);
            listar(idVenta);

            $.post("controlador/venta.php?op=calculo", { idVenta: idVenta }, function(data) {
                console.log(data);
                data = JSON.parse(data);
                $("#txttotal").html(data.Total);
            });
        });
    }
});

function listar(idVenta){

    $('#tabla_venta').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            
        ],
        "ajax": {
            url: "controlador/venta.php?op=listardetalle",
            type: "post",
            data:{idVenta:idVenta}
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "order": [[0, "asc"]],
        "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "",
            "sInfoEmpty":      "",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });
}


function eliminar(idTempVenta, idVenta) {
    if (confirm("¿Desea Eliminar El Registro?")) {
        $.post("controlador/venta.php?op=eliminardetalle", { idTempVenta: idTempVenta }, function(data) {
            console.log(data);
        });

        $.post("controlador/venta.php?op=calculo", { idVenta: idVenta }, function(data) {
            console.log(data);
            data = JSON.parse(data);
            $("#txttotal").html(data.Total);
        });

        listar(idVenta);

        alert("Registro Eliminado");
    }
}



$(document).on("click", "#Cobrar", function() {
    var idVenta = $("#idVenta").val();

    $.post("controlador/venta.php?op=calculo", { idVenta: idVenta }, function(data) {
        data = JSON.parse(data);
        console.log(data);
        if (data.Total == null) {
            alert('Error No Hay Productos Agregados');
        } else {
            $.post("controlador/venta.php?op=guardar", { idVenta: idVenta }, function(data) {
                alert('Venta Registrada Correctamente con Nro: V-' + idVenta);
                location.reload();
            });
        }
    });
});
