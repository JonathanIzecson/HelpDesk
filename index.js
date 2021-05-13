function init() {}

$(document).ready(function () {});

$(document).on("click", "#btnAcceso", function () {
  if ($("#rol").val() == 1) {
    $("#lblAcceso").html("Acceso Soporte");
    $("#btnAcceso").html("Acceso Usuario");
    $("#rol").val(2);
    $("#imgrol").attr("src","public/2.png");
  }else{
    $("#lblAcceso").html("Acceso Usuario");
    $("#btnAcceso").html("Acceso Soporte");
    $("#rol").val(1);
    $("#imgrol").attr("src","public/1.png");
  }
});

init();
