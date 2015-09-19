<?php
//Formulario de bscar
$lupa = '<span class="glyphicon glyphicon-search" aria-hidden="true"></span>';
?>
<form class="form_buscar" method='post' action='<?php echo \core\URL::generar("articulos/busqueda"); ?>' onsubmit='return(document.getElementById("buscar_nombre").value.length>0);'>
    <input type='submit' value='Buscar' title='Buscar'/>
    <?php echo \core\HTML_Tag::a_boton_onclick("btn_izq button", array("busqueda", "index"), $lupa, array('title' => 'Nuevo jugador')); ?>
    <input type='text' id='buscar_nombre' name='buscar_nombre' title='Introduzca el nombre o parte del nombre delrticulo a buscar'/>
</form>
