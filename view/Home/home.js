function init(){}

$(document).ready(function(){
    let usu_id = $("#usu_idx").val();
    let rol_id = $("#rol_idx").val();
    
    if (rol_id == 1) {

        $.post("../../controller/ticket.php?op=total_usuario", {usu_id : usu_id}, function(data){
            data = JSON.parse(data);
            $("#lbltotal").html(data.total);
        });
    
        $.post("../../controller/ticket.php?op=usuario_abiertos", {usu_id : usu_id}, function(data){
            data = JSON.parse(data);
            $("#lblabiertos").html(data.total);
        });
    
        $.post("../../controller/ticket.php?op=usuario_cerrados", {usu_id : usu_id}, function(data){
            data = JSON.parse(data);
            $("#lblcerrados").html(data.total);
        });

        $.post("../../controller/ticket.php?op=grafica_usuario",{usu_id: usu_id}, function(data){
            data = JSON.parse(data);
            console.log(data);

            new Morris.Bar({
                element: 'grafica',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value'],
            });
        });

    } else {
                $.post("../../controller/ticket.php?op=total_soporte", function(data){
            data = JSON.parse(data);
            $("#lbltotal").html(data.total);
        });
    
        $.post("../../controller/ticket.php?op=soporte_abiertos", function(data){
            data = JSON.parse(data);
            $("#lblabiertos").html(data.total);
        });
    
        $.post("../../controller/ticket.php?op=soporte_cerrados", function(data){
            data = JSON.parse(data);
            $("#lblcerrados").html(data.total);
        });

        $.post("../../controller/ticket.php?op=grafica_soporte",function(data){
            data = JSON.parse(data);
            console.log(data);

            new Morris.Bar({
                element: 'grafica',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value'],
            });
        });
    }  
});

init();