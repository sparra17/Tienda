$(document).on("click", "#Registrar", function() {
  const idCategoria = getUrlParameter("d");
  const Categoria = $("#Categoria").val();
  const Refigerado = $("#Refrigerado").val();
  if (idCategoria) {
    $.post(
      "controlador/categoria.php?op=modificarCategoria",
      {
        Categoria: Categoria,
        Refigerado: Refigerado,
      },
      function (data) {
        alert("Categoria modificada");
        window.location.href="Listar_Categoria.php";
      }
    );
  } else {
    $.post(
      "controlador/categoria.php?op=modificarCategoria",
      {
        Categoria: Categoria,
        Refigerado: Refigerado,
      },
      function (data) {
        alert("Categoria agregada");
        window.location.href="Listar_Categoria.php";
      }
    );
  }
});

var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
    sURLVariables = sPageURL.split("&"),
    sParameterName,
    i;

  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split("=");

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined ? true : sParameterName[1];
    }
  }
};
