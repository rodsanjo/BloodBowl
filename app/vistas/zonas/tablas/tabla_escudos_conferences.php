<?php
//var_dump($datos);
foreach ($datos['conferences'] as $key => $conf) {
    echo "<div class='col-md-6 col-xs-12'>";
        echo "<h1 class='text-center' title='{$conf['nombre']}'><small>{$conf['siglas']}</small></h1>";
        foreach ($datos['equipos'] as $equipo) {
            //var_dump($equipo);
            if( $conf['siglas'] == $equipo['equipo']['conferencia_siglas'] ){
                echo "<div class='col-md-4 col-xs-6'>";
                    $nombre_carpeta = \modelos\ficheros::getNombreCarpeta( $equipo['equipo']['id'] );
                    $img = ($equipo['equipo']["escudo"]) ? "<img class='img_escudo_cuadrado' src='".URL_ROOT."recursos/ficheros/teams/$nombre_carpeta/".$equipo['equipo']["escudo"]."' alt='{$equipo['equipo']['raza']}' title='{$equipo['equipo']['raza']}'/>" :"";
                    ?>
                    <div class="img_escudo col-md-1"/>
                        <center>
                            <a href="#<?php echo str_replace(' ','',$equipo['equipo']['raza']); ?>">
                                <?php echo $img; ?>
                            </a>
                        </center>
                    </div>
                </div>
        <?php
            }
        }
    echo "</div>";
}
