<div class="col-md-12">
        <table class="table table-striped">
        <thead>
            <tr>
                <th><div class='orden_columna' title='denominacion' data-field='nombre' data-ord="<?php echo $orden; ?>" >Denominación</th>
                <th><div class='orden_columna' title='coste' data-field='coste' data-ord="<?php echo $orden; ?>" >Coste</div></th>
                <th><div class='orden_columna' title='movimiento' data-field='mo' data-ord="<?php echo $orden; ?>" >MO</div></th>
                <th><div class='orden_columna' title='fuerza' data-field='fu' data-ord="<?php echo $orden; ?>" >FU</th>
                <th><div class='orden_columna' title='agilidad' data-field='ag' data-ord="<?php echo $orden; ?>" >AG</th>
                <th><div class='orden_columna' title='armadura' data-field='ar' data-ord="<?php echo $orden; ?>" >AR</th>
                <th>Habilidades</th>
                <th><div class='orden_columna' title='habilidades normales' data-field='tipo_hab_normal' data-ord="<?php echo $orden; ?>" >Normal</div></th>
                <th><div class='orden_columna' title='habilidades con dobles' data-field='tipo_hab_doble' data-ord="<?php echo $orden; ?>" >Doble</div></th>
                <th>Equipos</th>
                <?php
                if ( \core\Usuario::tiene_permiso('raza', 'form_borrar')) {
                    //echo '<th>Acciones</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($datos['jugadores'] as $key => $jugador) {
                echo '<tr>';
                    //echo "<td class='edicion_jugador' data-id='{$jugador['id']}'>{$jugador['nombre']} <span class='glyphicon glyphicon-pencil' aria-hidden='true' style='color:#428bca;'></span></td>";
                    echo "<td>{$jugador['nombre']} &nbsp;&nbsp;".\core\HTML_Tag::a_boton_onclick("", array("players", "form_modificar", $jugador['id']), "<span class='glyphicon glyphicon-pencil' aria-hidden='true' style='color:#428bca;'></span>")."</td>";
                    echo "<td>{$jugador['coste']}</td>";
                    echo "<td>{$jugador['mo']}</td>";
                    echo "<td>{$jugador['fu']}</td>";
                    echo "<td>{$jugador['ag']}</td>";
                    echo "<td>{$jugador['ar']}</td>";
                    echo "<td>{$jugador['habilidades']}</td>";
                    echo "<td>{$jugador['tipo_hab_normal']}</td>";
                    echo "<td>{$jugador['tipo_hab_doble']}</td>";
                    echo "<td>";
                    if(isset($jugador['equipos'])){
                        foreach ($jugador['equipos'] as $equipo) {
                            echo $equipo.'<br/>';
                        }
                    }
                    echo "</td>";
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
