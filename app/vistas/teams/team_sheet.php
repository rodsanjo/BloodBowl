<div id="hoja_equipo">
<?php
//var_dump($datos);
$controlador = $datos['controlador_clase'];

$equipo = $datos['equipos'][0];
//var_dump($equipo);
echo "<div class='col-md-12' style='clear: both;'>";
    ?>
    <div class="table_team col-md-12">
        <div class="col-md-12">
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cnt</th>
                    <th>Denominación</th>
                    <th>Coste</th>
                    <th>Número</th>
                    <th>Costes parciales</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $num_players = count($equipo['jugadores']);
                foreach ($equipo['jugadores'] as $key => $jugador) {
                    echo '<tr>';
                        echo "<td>{$jugador['num_min']}-{$jugador['num_max']}</td>";
                        echo "<td>{$jugador['nombre']} &nbsp;&nbsp;</td>";
                        echo '<td id="coste_'.$key.'">'.$jugador['coste'].'</td>';
                        echo '<td>
                            <input type="text" name="num_'.$key.'" value="0" size="1" maxlength="2" onblur="recalcular('.$key.','.$jugador['coste'].',this.value,'.$num_players.')"/>';
                        echo '</td>';
                        echo '<td><div id="costeParcial_'.$key.'" >0</div></td>';
                    echo '</tr>';
                }
                
                //Otros: Fichas de S.O., médico, factor de hinchas
                $otros = array(
                    'so' => array( 0,8,'Segunda oportunidad', $equipo['equipo']['coste_SO'] )
                    ,'medico' => array(0,1, 'Médico', '50.000' )
                    ,'ff' => array(1,10, 'Factor de hinchas', '10.000')
                );
                $j = $key+1;
                foreach ($otros as $key => $value) {
                    echo '<tr>';
                        echo "<td>{$value[0]}-{$value[1]}</td>";
                        echo "<td>{$value[2]}</td>";
                        echo '<td id="coste_'.$j.'">'.$value[3].'</td>';
                        echo '<td>
                            <input type="text" name="num_'.$j.'" value="0" size="1" maxlength="2" onblur="recalcular('.$j.','.$value[3].',this.value,'.$num_players.')"/>';
                        echo '</td>';
                        echo '<td><div id="costeParcial_'.$j.'" >0</div></td>';
                    echo '</tr>';
                    $j++;
                }
                ?>        
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td><b>Valoración del equipo:</b></td>
                    <td><b><div id="team_value">0</div></b></td>
                </tr>
            </tfoot>
        </table></div>
    </div>
</div>