<div id="equipos">
<?php
//var_dump($datos);
$controlador = $datos['controlador_clase'];

echo \core\HTML_Tag::a_boton_onclick("btn_derch button", array("players", "form_insertar"), "<span class='glyphicon glyphicon-user' aria-hidden='true'>+</span>", array('title' => 'Nuevo jugador'));

if( !empty($datos['equipos']) ){
    include PATH_APPLICATION_APP."vistas/zonas/tabla_escudos.php";
    include PATH_APPLICATION_APP."vistas/zonas/tabla_equipo.php";
}

//Altas por CSV
if ( \core\Usuario::tiene_permiso('raza', 'altaCSV')) {
    echo '<input class="btn_derch" type="button" value="Altas por CSV" onclick="abrirVentana_altasCSV()"/>';
    //echo \core\HTML_Tag::a_boton_onclick("boton", array("raza", "altaCSV", $equipo['equipo']['id']), "Altas por CSV");
}
?>
</div>