<div id="conferencia">
    
<?php
//var_dump($datos);
if( $datos['conf']['siglas'] == 'TMU' ){
    echo "<h1 class='text-center'>{$datos['conf']['nombre']}</h1>";
    include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_escudos_conferences.php";
    include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_equipo.php";
}else{
    ?>
    <h1 class="text-center"><small><?php echo $datos['conf']['nombre'] ?></small></h1>
    <?php
    include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_escudos.php";
    include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_equipo.php";
}
?>
</div>