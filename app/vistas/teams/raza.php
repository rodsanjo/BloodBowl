<div id="equipos">
<?php
//var_dump($datos);
$controlador = $datos['controlador_clase'];

echo \core\HTML_Tag::a_boton_onclick("btn_derch button", array("players", "form_insertar"), "<span class='glyphicon glyphicon-user' aria-hidden='true'>+</span>", array('title' => 'Nuevo jugador'));

foreach ($datos['equipos'] as $equipo) {
    echo "<h2>Equipo de {$equipo['equipo']['raza']}</h2>";
    ?>
    <img class="img_escudo" style="float:right"/>
    <div class="col-md-12">
        <table class="table table-striped">
        <thead>
            <tr>
                <th>Cnt&nbsp;</th>
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
    <?php
            echo \core\HTML_Tag::boton_div_with_data("input-group-addon edicion_team", array("teams", "form_modificar", $equipo['equipo']['id']), "Modificar equipo de {$equipo['equipo']['raza']}", array('style' => 'color:#428bca;cursor:pointer;'));
    ?>
    <br/>
    <?php
}
//Altas por CSV
if ( \core\Usuario::tiene_permiso('raza', 'altaCSV')) {
    echo '<input class="btn_derch" type="button" value="Altas por CSV" onclick="abrirVentana_altasCSV()"/>';
    //echo \core\HTML_Tag::a_boton_onclick("boton", array("raza", "altaCSV", $equipo['equipo']['id']), "Altas por CSV");
}
?>
</div>