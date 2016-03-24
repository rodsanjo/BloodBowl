<div id="conferencia">
    <h1 class="text-center"><small><?php echo $datos['conf']['nombre'] ?></small></h1>
<?php
//var_dump($datos);
if( $datos['conf']['siglas'] == 'TMU' ){
    include PATH_APPLICATION_APP."vistas/zonas/tabla_escudos.php";
}else{
    include PATH_APPLICATION_APP."vistas/zonas/tabla_escudos.php";
    include PATH_APPLICATION_APP."vistas/zonas/tabla_equipo.php";
}
?>
</div>