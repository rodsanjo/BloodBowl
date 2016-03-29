<?php
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
    <h1><small>Categorías de habilidades</small></h1>
    <?php
    foreach ($tipos as $tipo => $habilidades) {
        if( count($habilidades) > 1 ){
            echo "<ul>";
            echo "<li><h2><small>{$habilidades[0]}</small></h2>";
            unset($habilidades[0]);
            echo '<ul class="list-inline">';
            foreach ($habilidades as $key => $hab_nomb) {
                if($key != 1 ){
                    echo " - ";
                }
                $hab_nomb_hash = str_replace(" ", "", $hab_nomb);
                //echo "<div class='col-lg-2 col-md-3 col-sm-4'><a href='#$hab_nomb'>$hab_nomb</a></div>";
                echo "<li><a href='#$hab_nomb_hash'>$hab_nomb</a></li>";
            }
            echo "</ul></ul>";
        }
    }
    //echo "<br/>";
    ?>
</div>