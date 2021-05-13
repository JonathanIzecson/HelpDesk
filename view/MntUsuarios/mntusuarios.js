let tabla;

function init() {
    $("#usuario_form").on("submit", function (e) {
      guardaryeditar(e);
    });
}

function guardaryeditar(e) {
  e.preventDefault();
  let formData = new FormData($("#usuario_form")[0]);  

  $.ajax({
    url: "../../controller/usuario.php?op=guardaryeditar",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#usuario_form")[0].reset();
      $("#modalmantenimiento").modal("hide");
      $("#usuario_data").DataTable().ajax.reload();
      swal("Correcto", "Se guardó correctamente", "success");
    },
  }); 
}


$(document).ready(function(){

    tabla = $("#usuario_data")
    .dataTable({
      aProcessing: true,
      aServerSide: true,
      dom: "Bfrtip",
      searching: true,
      lengthChange: false,
      colReorder: true,
      buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
      ajax: {
        url: "../../controller/usuario.php?op=listar",
        type: "post",
        dataType: "json",
        /* data: { usu_id: usu_id }, */
        error: function (e) {
          console.log(e.responseText);
        },
      },
      bDestroy: true,
      responsive: true,
      bInfo: true,
      iDisplayLength: 10,
      autoWidth: false,
      language: {
        sProcessing: "Procesando...",
        sLengthMenu: "Mostrar _MENU_ registros",
        sZeroRecords: "No se encontraron resultados",
        sEmptyTable: "Ningún dato disponible en esta tabla",
        sInfo: "Mostrando un total de _TOTAL_ registros",
        sInfoEmpty: "Mostrando un total de 0 registros",
        sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
        sInfoPostFix: "",
        sSearch: "Buscar:",
        sUrl: "",
        sInfoThousands: ",",
        sLoadingRecords: "Cargando...",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        oAria: {
          sSortAscending:
            ": Activar para ordenar la columna de manera ascendente",
          sSortDescending:
            ": Activar para ordenar la columna de manera descendente",
        },
      },
    })
    .DataTable();
});

function borrar(usu_id) {
    swal({
        title: "Estas seguro?",
        text: "El usuario será eliminado",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No!",
        closeOnConfirm: false,
        closeOnCancel: true
      },
      function(isConfirm) {
        if (isConfirm) {
          $.post("../../controller/usuario.php?op=delete",{usu_id: usu_id}, function(){
    
          });
          swal({
            title: "Usuario Eliminado!",
            text: "El usuario ha sido eliminado correctamente",
            type: "success",
            confirmButtonClass: "btn-success"
          });
          
          $("#usuario_data").DataTable().ajax.reload();
        }
      });
}

$("#btnnuevo").on("click",function() {
  $("#modalmantenimiento").modal("show");
  $("#lbltitulomodal").html("Registrar Usuario");
});

function editar(usu_id) {
  $.post("../../controller/usuario.php?op=mostrar",{usu_id: usu_id},function (data){
    data = JSON.parse(data);
    
    $("#usu_id").val(data.usu_id);
    $("#usu_nom").val(data.usu_nom);
    $("#usu_ape").val(data.usu_ape);
    $("#usu_correo").val(data.usu_correo);
    $("#usu_pass").val(data.usu_pass);
    $("#rol_id").val(data.rol_id).trigger("change");

  });
  $("#modalmantenimiento").modal("show");
  $("#lbltitulomodal").html("Editar Usuario");
}


init();