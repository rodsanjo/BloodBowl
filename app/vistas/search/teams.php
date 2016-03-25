<div id="equipos">
<?php
//var_dump($datos);
$controlador = $datos['controlador_clase'];

echo \core\HTML_Tag::a_boton_onclick("btn_derch button", array("players", "form_insertar"), "<span class='glyphicon glyphicon-user' aria-hidden='true'>+</span>", array('title' => 'Nuevo jugador'));

if( !empty($datos['equipos']) ){
    include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_escudos.php";
    include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_equipo.php";
}else{
    echo "<p>No se ha encontrado ningún resultado</p>";
}

?>
</div>