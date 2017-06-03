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
                    <th>Coste total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($equipo['jugadores'] as $key => $jugador) {
                    echo '<tr>';
                        echo "<td>{$jugador['num_min']}-{$jugador['num_max']}</td>";
                        echo "<td>{$jugador['nombre']} &nbsp;&nbsp;</td>";
                        echo '<td id="coste_'.$key.'">'.$jugador['coste'].'</td>';
                        echo '<td>
                            <select name="num_'.$key.'" id="num_'.$key.'" onchange="calcular('."'".$key."'".');">';
                            for($i = $jugador['num_min']; $i <= $jugador['num_max']; $i++) {
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                        echo '</select></td>';
                        echo '<td>
                            <input type="text" name="costeParcial_'.$key.'" id="costeParcial_'.$key.'" readonly="readonly">
                            </td>';
                    echo '</tr>';
                }
                
                //Otros: Fichas de S.O., médico, factor de hinchas
                $otros = array(
                    'so' => array( 0,8,'Segunda oportunidad', $equipo['equipo']['coste_SO'] )
                    ,'medico' => array(0,1, 'Médico', 50000 )
                    ,'ff' => array(1,10, 'Factor de hinchas', 10000)
                );
                foreach ($otros as $key => $value) {
                    echo '<tr>';
                        echo "<td>{$value[0]}-{$value[1]}</td>";
                        echo "<td>{$value[2]}</td>";
                        echo '<td id="coste_'.$key.'">'.$value[3].'</td>';
                        echo '<td>
                            <select name="num_'.$key.'" id="num_'.$key.'" onchange="calcular('."'".$key."'".');">';
                            for($i = $value[0]; $i <= $value[1]; $i++) {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                        echo '</select></td>';
                        echo '<td>
                            <input type="text" name="costeParcial_'.$key.'" id="costeParcial_'.$key.'" readonly="readonly">
                            </td>';
                    echo '</tr>';
                }
                ?>        
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"></td>
                    <td id="resultado"><b id="suma">1.000.000</b></td>
                </tr>
            </tfoot>
        </table></div>
    </div>
</div>