function init() {}

$(document).ready(function () {
  let tick_id = getUrlParameter('ID');
  listardetalle(tick_id)

  $("#tickd_desc").summernote({
    height: 200,
    lang: "es-ES",
  });
});

$(document).on('click','#btnenviar',function(){
  let tick_id = getUrlParameter('ID');
  let usu_id = $("#usu_idx").val();
  let tickd_descrip = $("#tickd_desc").val();

  if($("#tickd_desc").summernote("isEmpty")){
    swal("Advertencia", "Campo Vacio", "warning");
  }else{
    $.post("../../controller/ticket.php?op=insertdetalle",{tick_id: tick_id, usu_id: usu_id, tickd_descrip: tickd_descrip},function (){
      $("#tickd_desc").summernote('reset');
      swal("Correcto", "Se registró correctamente", "success");
      listardetalle(tick_id);
    });
  }

});

$("#btncerrarticket").on("click",function(){
  swal({
    title: "Estas seguro?",
    text: "Ya no podrás comentar nada acerca de este ticket",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Si",
    cancelButtonText: "No!",
    closeOnConfirm: false,
    closeOnCancel: true
  },
  function(isConfirm) {
    if (isConfirm) {

      let tick_id = getUrlParameter('ID');
      let usu_id = $("#usu_idx").val();
      $.post("../../controller/ticket.php?op=update",{tick_id: tick_id, usu_id: usu_id}, function(){

      });
      swal({
        title: "Ticket Cerrado!",
        text: "El Ticket se ha cerrado correctamente",
        type: "success",
        confirmButtonClass: "btn-success"
      });
      
      listardetalle(tick_id);
    }
  });
});

function listardetalle(tick_id){
  $.post("../../controller/ticket.php?op=listardetalle",{tick_id: tick_id},function (data){
    $("#lbldetalle").html(data);
  });

  $.post("../../controller/ticket.php?op=mostrar",{tick_id: tick_id},function(data){
    console.log(data);
    data = JSON.parse(data);
    console.log(data.tick_descripcion);
    $("#lblidticket").html("Detalle ticket - " + data.tick_id);
    $("#lblestado").html(data.tick_estado);
    $("#lblnombre").html(data.usu_nom + ' '+ data.usu_ape);
    $("#lblfecha").html(data.fecha_crea);
    $("#lblid").html(data.tick_id);
    $("#cat_id").val(data.cat_nom);
    $("#tick_titulo").val(data.tick_titulo);
    $("#tick_descrip").html(data.tick_descripcion);

    if(data.tick_estado_cerrar == 'Cerrado'){
      $("#paneldetalle").hide();
    }
  });
}

let getUrlParameter = function getUrlParameter(sParam) {
  let sPageUrl = decodeURIComponent(window.location.search.substring(1)),
    sUrlVariables = sPageUrl.split("&"),
    sParameterName,
    i;


  for (i = 0; i < sUrlVariables.length; i++) {
    sParameterName = sUrlVariables[i].split("=");

    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined ? true : sParameterName[1];
    }
  }
};

init();
