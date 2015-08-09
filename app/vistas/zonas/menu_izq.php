<!--<h3><?php //echo iText('leyenda_menu', 'dicc'); ?></h3>-->
<ul id="menu" class="menu">
    <?php echo \core\HTML_Tag::li_menu("item", array("inicio"), "Inicio"); ?>
    <li><span title="<?php echo iText('Equipos', 'dicc'); ?>"><?php echo iText('Equipos', 'dicc'); ?></span>
        <ul id="list_team">
            <?php
            $teams = new \modelos\teams();
            $currents_teams = $teams -> getTeams();
            //$currents_teams = \modelos\teams::getTeams();            
            foreach ($currents_teams as $key => $team) {           
                $_team = str_replace(' ','-', $team['raza']);
                $title = ucwords($team['raza']);
                echo "<li>";
                echo \core\html_tag::a_boton_onclick('subitem',array('teams',"raza/$_team", $team['id']), $team['raza'], array( 'title' => "$title" ));
                echo "</li>";
            }
            ?>
        </ul>
    </li>
    <?php echo \core\HTML_Tag::li_menu("item", array("jugadores"), "Jugadores"); ?>
    <?php echo \core\HTML_Tag::li_menu("item", array("tacticas"), "Tácticas"); ?>
    <?php echo \core\HTML_Tag::li_menu("menu_adm", array("usuarios"), "Usuarios"); ?>
</ul>
