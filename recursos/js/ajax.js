$(document).ready(function(){
     //Función para ordenar mediante ajax la lista de jugadores
    //Mostrar por ajax la imagen previa
    $(".orden_columna").click(function(event){
        var x = $(event.target);
        field = x.data('field');
        orden = x.data('ord');
        //jugadores = x.data('datos');
        //var imagenWeb = event.target.getAttribute('data-url');
        //alert(field);
        
        //imagen cargando
        //$(view_content).html('<p style="text-align: center;margin-top: 5%;"><img src="../../home/recursos/imagenes/ajax-loader.gif" /></p>');

        //Ordenar por el campo: 3 formas:
        ordenarTabla(field,orden); //it works
        //conAjax1(imagenWeb); //it works
        //conAjax2(imagenWeb); //it works
    });    
});

function ordenarTabla(field,order){
    //alert(order);
    jQuery.post(
        host+name_app+'/players/index'
        ,{is_ajax: "true", field: field, order_type: order }
        ,function(data, textStatus, jqXHR) {
            $("#view_content").html(data);
        }
        
    );
}

//Team sheet. Hoja de equipo
function setTeamSheet(){
    
    $('select#selected_team').on('change',function(){
        var team_id = $(this).val();
        console.log(team_id);
        
        jQuery.post(
            host+name_app+'/teams/raza'
            ,{is_ajax: "true", team_id: team_id}
            ,function(data, textStatus, jqXHR) {
                $("#team_sheet").html(data);
            }

        );
    });
    
}


