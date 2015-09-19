<div >
    <h2>Borrar jugador</h2>
    <?php //include "form_and_inputs.php"; ?>
    
    <form method='post' name='<?php echo \core\Array_Datos::contenido("form_name", $datos); ?>' action="<?php echo \core\URL::generar($datos['controlador_clase'].'/validar_'.$datos['controlador_metodo']); ?>" enctype='multipart/form-data' onsubmit="return validarForm();">
    <fieldset><legend>Datos del jugador</legend>
	<?php echo \core\HTML_Tag::form_registrar($datos["form_name"], "post"); ?>
	
	<input id='id' name='id' type='hidden' value='<?php echo \core\Array_Datos::values('id', $datos); ?>' />
	
        <label for="nombre">Denominación:</label><input id='nombre' name='nombre' type='text' size='100'  maxlength='100' value='<?php echo \core\Array_Datos::values('nombre', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('nombre', $datos); ?>
	<br/><br/>
        
        <b>Posición:</b>
        <select id='posicion_id' name="posicion_id">
            <?php
            $datos['posiciones'] = \modelos\players::getPosiciones();
            //Por defecto estará seleccionada la vivienda que es el primer elemento de la lista
            if (\core\Distribuidor::get_metodo_invocado() == "form_insertar") {
                echo "<option disabled='true' selected='selected'>Seleccione una posición</option>";
            }
            foreach ($datos['posiciones'] as $key => $posicion) {
                $value = "value = '{$posicion['id']}'";
                $selected = (\core\datos::values('posicion_id', $datos) == $posicion['id']) ? " selected='selected' " : "";
                //echo "<option $value $selected>{$conferencia['nombre_es']} ({$conferencia['siglas']})</option>\n";
                echo "<option $value $selected>{$posicion['posicion']}</option>\n";
            }
            ?>
        </select>
        <br/><br/>
        
        <table class="table table-striped"><tr>
                <td>
        <label for="mo">Movimiento:</label><input id='mo' name='mo' type='text' size='1'  maxlength='2' value='<?php echo \core\Array_Datos::values('mo', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('mo', $datos); ?>
        </td><td>
        <label for="fu">Fuerza:</label><input id='fu' name='fu' type='text' size='1'  maxlength='2' value='<?php echo \core\Array_Datos::values('fu', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('fu', $datos); ?>
        </td><td>
        <label for="ag">Agilidad:</label><input id='ag' name='ag' type='text' size='1'  maxlength='2' value='<?php echo \core\Array_Datos::values('ag', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('ag', $datos); ?>
        </td><td>
        <label for="ar">Armadura:</label><input id='ar' name='ar' type='text' size='1'  maxlength='2' value='<?php echo \core\Array_Datos::values('ar', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('ar', $datos); ?>
        </td>
        </tr></table>
        
        <b>Habilidades:</b><br/>
        <textarea id="habilidades" name="habilidades" maxlength='300' cols="120" rows="3"><?php echo \core\Array_Datos::values('habilidades', $datos); ?></textarea>
        <br/><br/>
        
        <b>Coste:</b><input id='coste' name='coste' type='text' size='8'  maxlength='12' value='<?php echo \core\Array_Datos::values('coste', $datos); ?>'/>
        monedas
        <?php echo \core\HTML_Tag::span_error('precio', $datos); ?>
        <br/><br/>

        ¿Estás seguro de que quieres eliminar al jugador?
	<input type='submit' value='Borrar' class="btn-default botonAdmin" style="background:rgb(255,167,115);"/>
        <input type='reset' value='Restablecer' class="btn-default botonAdmin"/>
        <button type='button' onclick='window.location.assign("<?php echo \core\URL::generar($datos['controlador_clase']); ?>");' class="btn-default botonAdmin" style="background: rgb(160,216,118)">Cancelar</button>
        
        <?php echo \core\HTML_Tag::span_error('errores_validacion', $datos); ?>
        
        <!--<button type='button' onclick='window.location.assign("<?php echo $datos['url_cancelar']; ?>");' class="btn-default botonAdmin">Cancelar</button>-->
        
    </fieldset>
</form>
    
    <script type='text/javascript'>
        $(" [type=reset] ").css("display", "none");
        $(" [type=submit] ").value("Borrar");
        
        var formulario = <?php echo \core\Array_Datos::contenido("form_name", $datos); ?>;
        window.document.getElementById("nombre").readOnly='readonly';
        window.document.getElementById("posicion").readOnly='readonly';
        window.document.getElementById("raza").readOnly='readonly';
        window.document.getElementById("mo").readOnly='readonly';
        window.document.getElementById("fu").readOnly='readonly';
        window.document.getElementById("ag").readOnly='readonly';
        window.document.getElementById("ar").readOnly='readonly';
        window.document.getElementById("hab_norm").readOnly='readonly';
        window.document.getElementById("hab_dbl").readOnly='readonly';
        window.document.getElementById("coste").readOnly='readonly';
        window.document.getElementById("num_min").readOnly='readonly';
        window.document.getElementById("num_max").readOnly='readonly';
        window.document.getElementById("jug_estrella").readOnly='readonly';
        window.document.getElementById("foto").readOnly='readonly';
        
        window.document.getElementById("resenha").readOnly='readonly';
        document.getElementById("habilidades").style.display = "none";

        function modificar_permisos() {
                $(" [type=checkbox] ").removeAttr("disabled");
                $(" [type=submit], [type=reset], [type=button], button#btn_checked_all ").css("display", "inline");
                $(" button#btn_modificar, button#btn_cancelar ").css("display", "none");
        }

        function chequear_todo() {
                $(" [type=checkbox] ").attr("checked", "checked");

        }

    </script>
</div>