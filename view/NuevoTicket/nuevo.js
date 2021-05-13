function init() {
  $("#ticket_form").on("submit", function (e) {
    guardaryeditar(e);
  });
}

$(document).ready(function () {
  $("#ticket_desc").summernote({
    height: 200,
    lang: "es-ES"
  });

  $.post("../../controller/categoria.php?op=combo", function (data, status) {
    $("#cat_id").html(data);
  });
});

function guardaryeditar(e) {
  e.preventDefault();
  let formData = new FormData($("#ticket_form")[0]);

  if($("#ticket_desc").summernote("isEmpty") || $("#tick_titulo") == ""){
    swal("Advertencia", "Campos Vacios", "warning");
  }else{
    $.ajax({
      url: "../../controller/ticket.php?op=insert",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (datos) {
        console.log(datos);
        $("#tick_titulo").val("");
        $("#ticket_desc").summernote("reset");
        swal("Correcto", "Se registró correctamente", "success");
      },
    });
  }
}

init();
