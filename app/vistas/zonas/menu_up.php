<div id='cssmenu'>
    <ul>
        <li class='active has-sub'>
        <?php echo \core\HTML_Tag::a_boton("item", array("inicio"), "Inicio"); ?>
            <ul>
                <li class='has-sub'>
                    <?php 
                    echo \core\HTML_Tag::a_boton("", array("inicio","ediciones"), "Ediciones", array( 'title' => "Ediciones") );
                    ?>
                </li>
                <li class='has-sub'>
                    <?php 
                    echo \core\HTML_Tag::a_boton("", array("inicio","oficiales"), "Mis equipos", array( 'title' => "Mis equipos oficiales") );
                    ?>
                </li>
            </ul>
        </li>
        <li class='active has-sub'>
            <?php
            echo \core\HTML_Tag::a_boton("", array("teams"), "Equipos", array( 'title' => "Mis equipos oficiales") );
            echo "<ul>";
                    $teams = new \modelos\teams();
                    $currents_teams = $teams -> getTeams();
                    //$currents_teams = \modelos\teams::getTeams();            
                    foreach ($currents_teams as $key => $team) {           
                        $_team = str_replace(' ','-', $team['raza']);
                        $title = ucwords($team['raza']);
                        echo "<li class='has-sub'>";
                        echo \core\html_tag::a_boton('',array('teams',"raza",$_team ), $team['raza'], array( 'title' => "$title" ));
                        echo "</li>";
                    }
                ?>
            </ul>
        </li>
        
        <li class='active has-sub'><a>Especies</a>
            <ul>
                <?php 
                $especies = array('humanos','orcos','enanos','elfos','caos','animales','criaturas','ultratumba');
                foreach ($especies as $key => $especie) {
                    echo "<li class='has-sub'>";
                    echo \core\html_tag::a_boton('',array('teams',"especie", $especie), $especie, array( 'title' => "$especie" ));
                    echo "</li>";
                }
                ?>
            </ul>
        </li>
        
        <?php
        $teams = new \modelos\teams();
        $confs = $teams -> getConferences();
        echo "<li class='active has-sub'>";
        echo \core\html_tag::a_boton('',array('conferences',"siglas",$confs[0]['siglas'] ), 'Conferencias', array( 'title' => "{$confs[0]['nombre_es']}" ));
        ?>
            <ul>
                <?php
                    unset($confs[0]);
                    foreach ($confs as $key => $conf) {    
                        echo "<li class='active has-sub'>";
                        echo \core\html_tag::a_boton('',array('conferences',"siglas",$conf['siglas'] ), $conf['nombre_es'], array( 'title' => "{$conf['siglas']}" ));
                        echo "</li>";
                    }
                ?>
            </ul>
        </li>
        
        <li class='active has-sub'>
        <?php echo \core\HTML_Tag::a_boton("item", array("players"), "Jugadores"); ?>
            <ul>
                <li class='has-sub'>
                    <?php 
                    echo \core\HTML_Tag::a_boton("", array("players","starplayers"), "Jugadores estrella", array( 'title' => "Jugadores estrella") );
                    ?>
                </li>
            </ul>
        </li>
        
        <?php echo \core\HTML_Tag::li_menu("item", array("skills"), "Habilidades"); ?>
        <?php echo \core\HTML_Tag::li_menu("item", array("tacticas"), "Tácticas"); ?>
        <?php echo \core\HTML_Tag::li_menu("item", array("enlaces"), "Links"); ?>
        <?php echo \core\HTML_Tag::li_menu("menu_adm", array("usuarios"), "Usuarios"); ?>
    </ul>
</div>
