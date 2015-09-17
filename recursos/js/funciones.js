host = ''; //Host
host = '/web/jergapps'; //'http://localhost/web/jergapps';
name_app = '/BloodBowl'

/**
 * Función jquery que gestiona el menú izquierdo mostrando y ocultando las distintas opciones
 */
$(document).ready(function() {
    $("div#menu_izq li span").click (function () {
//        $("div#menu_izq li ul").slideToggle(3000);
        if ($("div#menu_izq li ul").is(":hidden") ) {
            $("div#menu_izq li ul").slideDown(3000);
        }else{
            $("div#menu_izq li ul").slideUp(2000);
        }
    });
    $("a").click (function () {
        $(this).css('color','blueviolet');
    });
});


/**
 * Menú de opción de Idioma
 */
$(document).ready(function(){
    $("#idioma").mouseenter(function(){
        $("#idioma a").fadeIn(1000);
    });
    $("#idioma").mouseleave(function(){
        $("#idioma a").fadeOut(500);
    });
    
    $("#menu").click(function () { 			 	
            $("span#opcion_loc").slideToggle();
        }               
    );

    $("li.item").click(
        function () { 			 	
            $("span.desplegable").slideToggle();
        }               
    );
        //Desplegar el carrito lateral
    $("#btn_desplegar_carrito").click(
        function(){
            $("#carrito_oculto").slideToggle();  
        }
    );
});

/**
 * Función para desplegar las acciones de edición disponibles sobre un jugador o equipo
 */
$(document).ready(function() {
    $("td.edicion_player").dblclick (function (event) {
        var x = $(event.target);
        jugador_id = x.data('id');
        ventanaEdicionJugador(jugador_id);
        //alert(jugador_id);
        url = host+name_app+'/players/form_modificar';
        ventana=window.open(url,'Edicion Jugador','width=700, height=700');
        ventana.window.moveTo(200,50);
        ventana.window.focus();
    });
    $(".edicion_team").click (function (event) {
        var x = $(event.target);
        equipo_id = x.data('id');
        url = x.data('url');
        //alert(url+jugador_id);
        ventana=window.open(url+equipo_id,'Edicion Raza','width=475, height=600');
        ventana.window.moveTo(200,50);
        ventana.window.focus();
        
    });
});

function ventanaEdicionJugador(jugador_id){
    //alert(jugador_id);
    url = host+name_app+'/players/';
    ventana=window.open(url,'Edicion Jugador','width=700, height=700');
    ventana.window.moveTo(200,50);
    ventana.window.focus();
}

//it doesn't work'
function ejecutarYCerrarVentana(uri){
    alert(uri)
    $.ajax({
        method:'POST'
        ,url: host+name_app+uri
        ,data: { is_ajax: true
            , imagenWeb: imagenWeb
            ,form_id: form_id
            ,id: id
            ,raza: raza
            ,coste_SO: coste_SO
            ,conferencia_siglas: conferencia_siglas
            ,lado_oscuro: lado_oscuro
        }
        ,statusCode: { //esto es opcional
            404: function() {
                alert( "page not found" );
            }
        }
        ,success: function(data) {
            $('#rightColumn').html( data );
        }
    })
}

function abrirVentana_altasCSV(){
    url = host+name_app+'/teams/altasCSV';
    //url = '<?php echo URL_ROOT ?>teams/altasCSV';
    //alert(url);
    ventana2=window.open(url,'Alta por CSV','width=600, height=600');
    ventana2.window.moveTo(300,100);
    ventana2.window.focus();
}

function insertarFichero_altasCSV(){
    
}