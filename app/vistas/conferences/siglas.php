<div id="conferencia">
    <h1 class="text-center"><small><?php echo $datos['conf']['nombre'] ?></small></h1>
<?php
//var_dump($datos);
if( $datos['conf']['siglas'] == 'TMU' ){
    echo "<div class='hidden_stuffs'>";
    include PATH_APPLICATION_APP."vistas/zonas/tabla_equipo.php";
    echo "</div>";
}else{
    include PATH_APPLICATION_APP."vistas/zonas/tabla_equipo.php";
}
?>
</div>