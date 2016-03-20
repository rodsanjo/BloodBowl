<?php
//var_dump($datos);
foreach ($datos['equipos'] as $equipo) {
    //var_dump($equipo);
    echo "<div class='col-md-12'>";
        echo "<center><h2>{$equipo['equipo']['raza']}</h2></center>";
        $nombre_carpeta = \modelos\ficheros::getNombreCarpeta( $equipo['equipo']['id'] );
        $img = ($equipo['equipo']["escudo"]) ? "<img width='100px;' src='".URL_ROOT."recursos/ficheros/teams/$nombre_carpeta/".$equipo['equipo']["escudo"]."' alt='{$equipo['equipo']['raza']}' title='{$equipo['equipo']['raza']}'/>" :"";
        ?>
        <div class="img_escudo col-md-1"/>
            <center>
                <?php echo $img; ?>
            </center>
        </div>
        <div class="table_team col-md-11">
            <div class="col-md-12">
                <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cnt</th>
                        <th>Denominación</th>
                        <th>Coste</th>
                        <th>MO</th>
                        <th>FU</th>
                        <th>AG</th>
                        <th>AR</th>
                        <th>Habilidades</th>
                        <th>Normal</th>
                        <th>Doble</th>
                        <?php
                        if ( \core\Usuario::tiene_permiso('raza', 'form_borrar')) {
                            //echo '<th>Acciones</th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($equipo['jugadores'] as $key => $jugador) {
                        echo '<tr>';
                            echo "<td>{$jugador['num_min']}-{$jugador['num_max']}".\core\HTML_Tag::a_boton_onclick("", array("teams", "form_modificar_relacion", "{$jugador['id']}-{$equipo['equipo']['id']}"), "<span class='glyphicon glyphicon-pencil' aria-hidden='true' style='color:#428bca;'></span>")."</td>";
                            echo "<td>{$jugador['nombre']} &nbsp;&nbsp;".\core\HTML_Tag::a_boton_onclick("", array("players", "form_modificar", $jugador['id']), "<span class='glyphicon glyphicon-pencil' aria-hidden='true' style='color:#428bca;'></span>")."</td>";
                            //echo "<td class='edicion' data-id='{$jugador['id']}'>{$jugador['nombre']} &nbsp;&nbsp;<span class='glyphicon glyphicon-pencil' aria-hidden='true' style='color:#428bca;'></span></td>";
                            echo "<td>{$jugador['coste']}</td>";
                            echo "<td>{$jugador['mo']}</td>";
                            echo "<td>{$jugador['fu']}</td>";
                            echo "<td>{$jugador['ag']}</td>";
                            echo "<td>{$jugador['ar']}</td>";
                            echo "<td>{$jugador['habilidades']}</td>";
                            echo "<td>{$jugador['tipo_hab_normal']}</td>";
                            echo "<td>{$jugador['tipo_hab_doble']}</td>";
                            if ( \core\Usuario::tiene_permiso('raza', 'form_borrar')) {
        //                        echo "<td>
        //                            ".\core\HTML_Tag::a_boton_onclick("boton", array("raza", "form_modificar", $jugador['id']), "modificar")
        //                            .'<br/>'
        //                            .\core\HTML_Tag::a_boton_onclick("boton", array("raza", "form_borrar", $jugador['id']), "borrar")
        //                            ."</td>";
                            }
                        echo '</tr>';
                    }
                    ?>        
                </tbody>
            </table></div>
            <br/>
            <p>0-8 Fichas de SO: <?php echo $equipo['equipo']['coste_SO']; ?> monedas cada una.</p>
        </div>
    </div>
    <?php
            echo \core\HTML_Tag::boton_div_with_data("input-group-addon edicion_team", array("teams", "form_modificar", $equipo['equipo']['id']), "Modificar equipo de {$equipo['equipo']['raza']}", array('style' => 'color:#428bca;cursor:pointer;'));
    ?>
<!--    <br/>-->
    <?php
}
