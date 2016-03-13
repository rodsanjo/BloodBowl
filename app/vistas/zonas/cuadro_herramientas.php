<?php
//Formulario de bscar
$lupa = '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>';
?>
<div id="cuadro_herramientas">
    <form class="form_buscar" method='post' action='<?php echo \core\URL::generar("search/index"); ?>' onsubmit='return(document.getElementById("buscar_nombre").value.length>0);'>
    <!--    <input type='submit' value='Buscar' title='Buscar'/>-->
        <button type='submit' style="float: left;"><?php echo $lupa; ?></button>
        <select id='buscar_en' name="buscar_en" >
            <option value='players' >Jugadores</option>
            <option value='teams' >Equipos o razas</option>
            <option value='skills' >Habilidades</option>
        </select>
        <input type='text' id='buscar_nombre' name='nombre' title='Introduzca el nombre o parte del nombre a buscar'/>
    </form>
</div>