<center>
    <?php
        //$divImag = "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>";
        $divImag = "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>";
    ?>
    
    <div class='col-md-12'>
        <div class='col-md-6' style="text-align: justify">
            <p>Bienvenidos a no una página cualquiera con información relativa a <b><i>Blood Bowl</i></b>, el mejor juego de la historia donde compiten razas fantásticas y se marcan touchdowns!!!</p>
            <p>
                Aquí encontraras los datos de los jugadores de cada equipo con los que considero óptimo jugar.
                Me parecen absurdos los "big guys" o "tipejos grandotes" con habilidades como solitario, cabeza hueca, siempre hambriento... dado que el juego ya tiene demasidas tiradas en cada partida para que además tengamos que meter más y hacer aún menos llevaderos los partidos para gente menos aficionada.
                Tambien me parece ilógico contratar a un jugadores estrella para jugar un único partido.
            </p>
            <p>
               Es por ello que no encontraras información actualizada a las nuevas ediciones, yo me quedo con las reglas de la 3ª edición y las mejoras que considero oportunas de las nuevas ediciones.
            </p>
        </div>
        <div class='col-md-6'>
            <img src="<?php echo URL_APPLICATION_ROOT; ?>recursos/imagenes/portadaCaja.png" alt="portadaCaja3" title="Caja edición 3" style='width: 100%;'/>
        </div>
    </div>
    
    <?php
        //Imagenes de wallpapers a mostrar
//        $wallpapers = array(1,2,3,4,5,6);
//        foreach ($wallpapers as $key => $num) {
        for( $num = 1; $num < 7 ; $num++ ){
            echo $divImag;
            echo "<img src='".URL_APPLICATION_ROOT."recursos/imagenes/fondo/web/wallpapers$num.jpg' alt='wallpapers$num' title='wallpapers$num' style='width: 100%;'/>";
            echo "</div>";
        }
    ?>
    
</center>
