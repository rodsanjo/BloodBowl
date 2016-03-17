<div id="jugadores">
<?php
//var_dump($datos);
$controlador = $datos['controlador_clase'];
//var_dump($controlador);

//Altas por CSV
if ( \core\Usuario::tiene_permiso('skills', 'altasCSV')) {
    echo '<input class="btn_derch" type="button" value="Altas por CSV" onclick="abrirVentana_altasCSV()"/>';
}
echo \core\HTML_Tag::a_boton_onclick("btn_derch button", array($controlador, "form_insertar"), "<span class='glyphicon glyphicon-send' aria-hidden='true'> +</span>", array('title' => 'Nueva habilidad'));

//habilidades por tipo:
$tipos['G'][] = 'Generales';
$tipos['P'][] = 'Pase';
$tipos['A'][] = 'Agilidad';
$tipos['F'][] = 'Fuerza';
$tipos['M'][] = 'Mutación';
$tipos['O'][] = 'Otros';
foreach ($datos['habilidades'] as $key => $hab) {
    switch ($hab['tipo']) {
        case 'G':
            $tipos['G'][] = $hab['nombre'];
            break;
        case 'P':
            $tipos['P'][] = $hab['nombre'];
            break;
        case 'A':
            $tipos['A'][] = $hab['nombre'];
            break;
        case 'F':
            $tipos['F'][] = $hab['nombre'];
            break;
        case 'M':
            $tipos['M'][] = $hab['nombre'];
            break;
        default:
            $tipos['O'][] = $hab['nombre'];
            break;
    }
}


?>
    <div id="lista_habs">
        <h2>Categorías de habilidades</h2>
        <?php
        foreach ($tipos as $tipo => $habilidades) {
            if( count($habilidades) > 1 ){
                echo "<ul>";
                echo "<li><h1><small>{$habilidades[0]}</small></h1>";
                unset($habilidades[0]);
                echo '<ul class="list-inline">';
                foreach ($habilidades as $key => $hab_nomb) {
                    //$hab_nombr = str_replace(" ", "", $hab_nomb);
                    //echo "<div class='col-lg-2 col-md-3 col-sm-4'><a href='#$hab_nomb'>$hab_nomb</a></div>";
                    echo "<li><a href='#$hab_nomb'>$hab_nomb</a></li>";
                }
                echo "</ul></ul><br/>";
            }
        }
        echo "<br/>";
        ?>
    </div>


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
                //echo "<td class='edicion_jugador' data-id='{$jugador['id']}'>{$jugador['nombre']} <span class='glyphicon glyphicon-pencil' aria-hidden='true' style='color:#428bca;'></span></td>";
                //$hab_nombr = str_replace(" ", "", $hab['nombre']);
                echo "<td id='{$hab['nombre']}'><b>{$hab['nombre']}</b></td>";
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
<?php
//Altas por CSV
if ( \core\Usuario::tiene_permiso('raza', 'altaCSV')) {
    echo '<input class="btn_derch" type="button" value="Altas por CSV" onclick="abrirVentana_altasCSV()"/>';
    //echo \core\HTML_Tag::a_boton_onclick("boton", array("raza", "altaCSV", $equipo['equipo']['id']), "Altas por CSV");
}
?>
</div>