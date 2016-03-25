<div id="jugadores">
<?php
//var_dump($datos);
$controlador = $datos['controlador_clase'];
if(isset($datos['values']['order_type']))
    $orden = $datos['values']['order_type'];
else
    $orden = 'desc';

echo \core\HTML_Tag::a_boton_onclick("btn_derch button", array("players", "form_insertar"), "<span class='glyphicon glyphicon-user' aria-hidden='true'>+</span>", array('title' => 'Nuevo jugador'));

include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_jugadores.php";

?>
</div>
                

<script type="text/javascript">
/**
 * Función para ordenar mediante ajax la lista de jugadores
 */
$(document).ready(function(){        
    //Mostrar por ajax la imagen previa
    $(".orden_columna").click(function(event){
        var x = $(event.target);
        field = x.data('field');
        orden = x.data('ord');
        //jugadores = x.data('datos');
        //var imagenWeb = event.target.getAttribute('data-url');
        //alert(field);
        
        //$(id).html('<p style="text-align: center;margin-top: 5%;"><img src="../home/recursos/imagenes/ajax-loader.gif" /></p>');

        //Ordenar por el campo: 3 formas:
        ordenarTabla(field,orden); //it works
        //conAjax1(imagenWeb); //it works
        //conAjax2(imagenWeb); //it works
    });
});

function ordenarTabla(field,order,jugadores){
    //alert(order);
    jQuery.post(
        host+name_app+'/players/star_players'
        //,alert(host+name_app+'/players/star_players')
        ,{is_ajax: "true", field: field, order_type: order }
        ,function(data, textStatus, jqXHR) {
            $("#view_content").html(data);
        }
        
    );
}

</script>