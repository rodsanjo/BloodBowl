<div class="col-md-12">
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Habilidad</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <?php
            if ( \core\Usuario::tiene_permiso($controlador, 'form_borrar')) {
                echo '<th>Acciones</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($datos['habilidades'] as $key => $hab) {
            echo '<tr>';
                $hab_nomb_hash = str_replace(" ", "", $hab['nombre']);
                //echo "<td class='edicion_jugador' data-id='{$jugador['id']}'>{$jugador['nombre']} <span class='glyphicon glyphicon-pencil' aria-hidden='true' style='color:#428bca;'></span></td>";
                //$hab_nombr = str_replace(" ", "", $hab['nombre']);
                echo "<td id='$hab_nomb_hash'><b>{$hab['nombre']}</b></td>";
                echo "<td>{$hab['tipo']}</td>";
                echo "<td>{$hab['descripcion']}</td>";
                if ( \core\Usuario::tiene_permiso('skills', 'form_borrar')) {
                    echo "<td>
                          ".\core\HTML_Tag::a_boton_onclick("", array($controlador, "form_modificar", $hab['id']), "<span class='glyphicon glyphicon-pencil' aria-hidden='true' style='color:#428bca;'></span>")
                          ."&nbsp;&nbsp;&nbsp;"
                          .\core\HTML_Tag::a_boton_onclick("", array($controlador, "form_borrar", $hab['id']), "<span class='glyphicon glyphicon-trash' aria-hidden='true' style='color:#428bca;'></span>")
//                            ".\core\HTML_Tag::a_boton_onclick("boton", array("raza", "form_modificar", $jugador['id']), "modificar")
//                            .'<br/>'
//                            .\core\HTML_Tag::a_boton_onclick("boton", array("raza", "form_borrar", $jugador['id']), "borrar")
                        ."</td>";
                }
            echo '</tr>';
        }
        ?>        
    </tbody>
</table></div>