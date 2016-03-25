<div id="jugadores">
<?php
//var_dump($datos);
$controlador = $datos['controlador_clase'];
//var_dump($controlador);

//Altas por CSV
if ( \core\Usuario::tiene_permiso('skills', 'altasCSV')) {
    echo '<input class="btn_derch" type="button" value="Altas por CSV" onclick="abrirVentana_altasCSV()"/>';
}
echo \core\HTML_Tag::a_boton_onclick("btn_derch button", array($controlador, "form_insertar"), "<span class='glyphicon glyphicon-send' aria-hidden='true'> +</span>", array('title' => 'Nueva habilidad'));

include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_habilidades_resumen.php";
include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_habilidades.php";

//Altas por CSV
if ( \core\Usuario::tiene_permiso('raza', 'altaCSV')) {
    echo '<input class="btn_derch" type="button" value="Altas por CSV" onclick="abrirVentana_altasCSV()"/>';
    //echo \core\HTML_Tag::a_boton_onclick("boton", array("raza", "altaCSV", $equipo['equipo']['id']), "Altas por CSV");
}
?>
</div>