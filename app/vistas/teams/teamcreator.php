<div id="equipos">
<?php
//var_dump($datos);

//include PATH_APPLICATION_APP."vistas/zonas/tablas/tabla_escudos.php";

?>
</div>

<div>
    Seleccione equipo
    <select name="selected_team" id="selected_team" onchange="setTeamSheet();">
    <?php
    $teams = new \modelos\teams();
    $currents_teams = $teams -> getTeams();
    foreach ($currents_teams as $key => $equipo) {
        echo '<option value="'.$equipo['id'].'">'.$equipo['raza'].'</option>';
    }
    ?>
    </select>
</div>
<h2>Hoja de equipo</h2>
<div id="team_sheet"></div>

