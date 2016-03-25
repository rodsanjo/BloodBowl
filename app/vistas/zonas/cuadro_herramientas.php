<?php
//Formulario de bscar
$lupa = '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>';
?>
<div id="cuadro_herramientas">
    <form class="form_buscar navbar-form navbar-right" method='post' action='<?php echo \core\URL::generar("search/index"); ?>' onsubmit='return(document.getElementById("buscar_nombre").value.length>0);'>
    <!--    <input type='submit' value='Buscar' title='Buscar'/>-->
        <button class="btn-default form-group form-control" type='submit' style="float: left;"><?php echo $lupa; ?></button>
        <select id='buscar_en' class="form-group form-control" name="buscar_en" >
            <option value='skills' >Habilidades</option>
            <option value='players' >Jugadores</option>
            <option value='teams' >Equipos o razas</option>
        </select>
        <input type='text' id='buscar_nombre' class="form-group form-control" name='nombre' title='Introduzca el nombre o parte del nombre a buscar'/>
    </form>
</div>