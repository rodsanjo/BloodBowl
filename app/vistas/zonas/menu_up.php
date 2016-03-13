<div id='cssmenu'>
    <ul>
        <?php echo \core\HTML_Tag::li_menu("item", array("inicio"), "Inicio"); ?>
        <li class='active has-sub'><a><span>Equipos</span></a>
            <ul>
                <?php echo \core\HTML_Tag::li_menu("active has-sub", array("teams"), "Mis oficiales"); ?>
                <?php
                    $teams = new \modelos\teams();
                    $currents_teams = $teams -> getTeams();
                    //$currents_teams = \modelos\teams::getTeams();            
                    foreach ($currents_teams as $key => $team) {           
                        $_team = str_replace(' ','-', $team['raza']);
                        $title = ucwords($team['raza']);
                        echo "<li class='has-sub'>";
                        echo \core\html_tag::a_boton('',array('teams',"raza",$_team, $team['id']), $team['raza'], array( 'title' => "$title" ));
                        echo "</li>";
                    }
                ?>
            </ul>
        </li>
        <?php echo \core\HTML_Tag::li_menu("item", array("players"), "Jugadores"); ?>
        <?php echo \core\HTML_Tag::li_menu("item", array("skills"), "Habilidades"); ?>
        <?php echo \core\HTML_Tag::li_menu("item", array("tacticas"), "Tácticas"); ?>
        <?php echo \core\HTML_Tag::li_menu("item", array("enlaces"), "Links"); ?>
        <?php echo \core\HTML_Tag::li_menu("menu_adm", array("usuarios"), "Usuarios"); ?>
    </ul>
</div>
