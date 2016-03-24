<?php
//var_dump($datos);
foreach ($datos['equipos'] as $equipo) {
    //var_dump($equipo);
    echo "<div class='col-md-2 col-xs-4'>";
        $nombre_carpeta = \modelos\ficheros::getNombreCarpeta( $equipo['equipo']['id'] );
        $img = ($equipo['equipo']["escudo"]) ? "<img class='img_escudo_cuadrado' src='".URL_ROOT."recursos/ficheros/teams/$nombre_carpeta/".$equipo['equipo']["escudo"]."' alt='{$equipo['equipo']['raza']}' title='{$equipo['equipo']['raza']}'/>" :"";
        ?>
        <div class="img_escudo col-md-1"/>
            <center>
                <a href="#<?php echo $equipo['equipo']['raza']; ?>">
                    <?php echo $img; ?>
                </a>
            </center>
        </div>
    </div>
<?php
}
