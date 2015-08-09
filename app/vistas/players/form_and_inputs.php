<form method='post' name='<?php echo \core\Array_Datos::contenido("form_name", $datos); ?>' action="<?php echo \core\URL::generar($datos['controlador_clase'].'/validar_'.$datos['controlador_metodo']); ?>" enctype='multipart/form-data' onsubmit="return validarForm();">
    <fieldset><legend>Datos del jugador</legend>
	<?php echo \core\HTML_Tag::form_registrar($datos["form_name"], "post"); ?>
	
	<input id='id' name='id' type='hidden' value='<?php echo \core\Array_Datos::values('id', $datos); ?>' />
	
        <label for="nombre">Denominación:</label><input id='nombre' name='nombre' type='text' size='100'  maxlength='100' value='<?php echo \core\Array_Datos::values('nombre', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('nombre', $datos); ?>
	<br />
        
        Posición:        
        <select id='posicion' name="posicion">
            <?php
            $datos['posiciones'] = \modelos\players::getPosiciones();
            //Por defecto estará seleccionada la vivienda que es el primer elemento de la lista
            if (\core\Distribuidor::get_metodo_invocado() == "form_insertar") {
                echo "<option disabled='true' selected='selected'>Seleccione una posición</option>";
            }
            foreach ($datos['posiciones'] as $key => $posicion) {
                $value = "value = '{$posicion['id']}'";
                $selected = (\core\datos::values('posicion', $datos) == $posicion['posicion']) ? " selected='selected' " : "";
                //echo "<option $value $selected>{$conferencia['nombre_es']} ({$conferencia['siglas']})</option>\n";
                echo "<option $value $selected>{$posicion['posicion']}</option>\n";
            }
            ?>
        </select>
        <br/>
        
        Raza:<br/>
        <?php
        $datos['equipos'] = \modelos\players::getTeams();
        foreach ($datos['equipos'] as $key => $equipo) {
            $value = "value = '{$equipo['id']}'";
            $selected = (\core\datos::values('equipo_id', $datos) == $equipo['id']) ? " selected='selected' " : "";
            echo "<input id='raza' name='raza' type='checkbox' $value>{$equipo['raza']}\n";
        }
        ?>

<!--        <select id='raza' name="raza">
            <?php/*
            $datos['equipos'] = \modelos\players::getTeams();
            if (\core\Distribuidor::get_metodo_invocado() == "form_insertar") {
                echo "<option disabled='true' selected='selected'>Seleccione raza</option>";
            }
            foreach ($datos['equipos'] as $key => $equipo) {
                $value = "value = '{$equipo['id']}'";
                $selected = (\core\datos::values('equipo_id', $datos) == $equipo['id']) ? " selected='selected' " : "";
                echo "<option $value $selected>{$equipo['raza']}</option>\n";
            }
            */?>
        </select>-->
        <?php echo \core\HTML_Tag::span_error('raza', $datos); ?>
        <br/>
        
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
        <br/>
        
        Habilidades:<br/>
        <textarea id="resenha" name="resenha" maxlength='300' cols="120" rows="3"><?php echo \core\Array_Datos::values('resenha', $datos); ?></textarea>
        <br/>
        
        Tipo de habilidades normales:<br />
        <input id='hab_norm' name='hab_norm' type='checkbox' value='G' />Generales
        <input id='hab_norm' name='hab_norm' type='checkbox' value='F' />Fuerza
        <input id='hab_norm' name='hab_norm' type='checkbox' value='A' />Agilidad
        <input id='hab_norm' name='hab_norm' type='checkbox' value='G' />Pase
        <br />
        
        Tipo de habilidades con resultado doble:<br />
        <input id='hab_dbl' name='hab_dbl' type='checkbox' value='G' />Generales
        <input id='hab_dbl' name='hab_dbl' type='checkbox' value='F' />Fuerza
        <input id='hab_dbl' name='hab_dbl' type='checkbox' value='A' />Agilidad
        <input id='hab_dbl' name='hab_dbl' type='checkbox' value='G' />Pase
        <br />
        
        Precio:<input id='precio' name='precio' type='text' size='8'  maxlength='12' value='<?php echo \core\Array_Datos::values('precio', $datos); ?>'/>
        monedas
        <?php echo \core\HTML_Tag::span_error('precio', $datos); ?>
        <br />
        
        <label for="num_min">Cantidad mínima:</label><input id='num_min' name='num_min' type='text' size='1'  maxlength='2' value='<?php echo \core\Array_Datos::values('num_min', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('num_min', $datos); ?>
        
        <label for="num_max">Cantidad máxima:</label><input id='num_max' name='num_max' type='text' size='1'  maxlength='2' value='<?php echo \core\Array_Datos::values('num_max', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('num_max', $datos); ?>
        
        <br/>
        Jugador estrella: <input id='jug_estrella' name='jug_estrella' type='checkbox' value='1' />
        <br/>
        
        <label>Foto:</label>
        <?php
            if ( isset($datos['values']['foto']) ){
                $check = "<img src='".URL_ROOT."recursos/imagenes/check.jpg' width='40px'/> 
                    <span class='alert alert-warning'><b>¡Cuidado!</b> Si selecciona una nueva imagen sustituirá a la anterior</span>
                    ";
            }else{
                $check = "<img src='".URL_ROOT."recursos/imagenes/no_check.jpg' width='40px'/> 
                    <div class='alert alert-info alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <b>¡Atendión!</b> Este jugador aún no tiene ninguna imagen
                    </div>
                    ";
            }
            echo $check;
        ?>
        
        <input id='foto' name='foto' type='file' size='100'  maxlength='50' value='<?php echo \core\Array_Datos::values('foto', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('foto', $datos); ?>
	<br />
        
	<?php echo \core\HTML_Tag::span_error('errores_validacion', $datos); ?>
	
	<input type='submit' value='Enviar' class="btn-default botonAdmin"/>
        <input type='reset' value='Restablecer' class="btn-default botonAdmin"/>
        <button type='button' onclick='window.location.assign("<?php echo \core\URL::generar($datos['controlador_clase']); ?>");' class="btn-default botonAdmin">Cancelar</button>
        <!--<button type='button' onclick='window.location.assign("<?php echo $datos['url_cancelar']; ?>");' class="btn-default botonAdmin">Cancelar</button>-->
    </fieldset>
</form>

<script type="text/javascript">
    var ok = false;
    var f = <?php echo \core\Array_Datos::contenido("form_name", $datos); ?>
    
    function validarNum_portal(){
        //var nombre_via = f.nombre_via.value;
        var num_portal = f.num_portal.value;
        //alert(num_min_jug+" - "+num_max_jug);
	var patron=/^\d{0,}$/;
	if(!patron.test(num_portal)){
            document.getElementById("error_num_portal").innerHTML="Debe escribir solo números, 0 en caso de s/n, almacena el número de portal o el numero de plaza de garaje o el numero de local.";                
            ok = false;
	}else{
            document.getElementById("error_num_portal").innerHTML="";
	}
    }
    function validarNombre_via(){
	var valor = document.getElementById("nombre_via").value;
	var patron=/[\wñ]{1,}/i;
	if(!patron.test(valor)){
            document.getElementById("error_nombre_via").innerHTML="Este campo debe contener al menos 1 carácter.";
            ok = false;
	}else{
            document.getElementById("error_nombre_via").innerHTML="";
	}                      
}
    
    function validarForm(){
	ok=true;
	
        validarNombre_via();
	validarNum_portal();
	
	//ok=false;	//Si devolvemos false, no se envia el formulario
	return ok;
    }
</script>
