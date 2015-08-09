<form method='post' name='<?php echo \core\Array_Datos::contenido("form_name", $datos); ?>' action="<?php echo \core\URL::generar($datos['controlador_clase'].'/validar_'.$datos['controlador_metodo']); ?>" enctype='multipart/form-data' onsubmit="return validarForm();">
    <fieldset><legend></legend>
	<?php echo \core\HTML_Tag::form_registrar($datos["form_name"], "post"); ?>
	
	<input id='id' name='id' type='hidden' value='<?php echo \core\Array_Datos::values('id', $datos); ?>' />
	
        <input id='raza' name='raza' type='hidden' readonly size='100'  maxlength='100' value='<?php echo \core\Array_Datos::values('raza', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('raza', $datos); ?>
	<br />

        <label>Escudo:</label>
        <?php
            if ( isset($datos['values']['foto']) ){
                $check = "<img src='".URL_ROOT."recursos/imagenes/check.jpg' width='40px'/> 
                    <span class='alert alert-warning'><b>¡Cuidado!</b> Si selecciona una nueva imagen sustituirá a la anterior</span>
                    ";
            }else{
                $check = "<img src='".URL_ROOT."recursos/imagenes/no_check.jpg' width='40px'/> 
                    <div class='alert alert-info alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>
                        <b>¡Atendión!</b> Este equipo aún no tiene escudo
                    </div>
                    ";
            }
            echo $check;
        ?>
        
        <input id='escudo' name='escudo' type='file' size='100'  maxlength='50' value='<?php echo \core\Array_Datos::values('escudo', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('escudo', $datos); ?>
	<br />
        
        Coste S.O.: <input id='coste_SO' name='coste_SO' type='text' size='6'  maxlength='12' value='<?php echo \core\Array_Datos::values('coste_SO', $datos); ?>'/>
        &nbsp;monedas
        <?php echo \core\HTML_Tag::span_error('coste_SO', $datos); ?>
        <br/><br/>
                    
        Conferencia:
        <select id='conf' name="conferencia_siglas">
            <?php
                $datos['conferencias'] = \modelos\teams::getConferences();
                //Por defecto estará seleccionada la vivienda que es el primer elemento de la lista
                if (\core\Distribuidor::get_metodo_invocado() == "form_insertar") {
                    echo "<option disabled='true' selected='selected'>Seleccione la conferencia</option>";
                }
                foreach ($datos['conferencias'] as $key => $conferencia) {
                    $value = "value = '{$conferencia['siglas']}'";
                    $selected = (\core\datos::values('conferencia_siglas', $datos) == $conferencia['siglas']) ? " selected='selected' " : "";
                    //echo "<option $value $selected>{$conferencia['nombre_es']} ({$conferencia['siglas']})</option>\n";
                    echo "<option $value $selected>{$conferencia['nombre']}</option>\n";
                }
            ?>
        </select>
        <br/><br/>
        

        Lado oscuro:
                
        <?php 
            if ( isset($datos['values']['lado_oscuro']) && $datos['values']['lado_oscuro'] == 1){
                ?>
                <input id='lado_oscuro_bien' name='lado_oscuro' type='radio' value='0'/>Del bien 
                <input id='lado_oscuro_mal' name='lado_oscuro' type='radio' value='1' checked="checked"/>Del mal
                <?php
            }else{
                ?>
                <input id='lado_oscuro_bien' name='lado_oscuro' type='radio' value='0' checked="checked"/>Del bien 
                <input id='lado_oscuro_mal' name='lado_oscuro' type='radio' value='1'/>Del mal
                <?php
            }
        echo \core\HTML_Tag::span_error('lado_oscuro', $datos); ?>
        <br/><br/>
        
	<?php echo \core\HTML_Tag::span_error('errores_validacion', $datos); ?>
	<br/>
        
	<input type='submit' value='Actualizar' class="btn-default botonAdmin"/>
        <input type='reset' value='Restablecer' class="btn-default botonAdmin"/>
<!--        <button type='button' onclick='window.location.assign("<?php echo \core\URL::generar($datos['controlador_clase']); ?>");' class="btn-default botonAdmin">Cancelar</button>-->
        <button type='button' onclick='window.close();' class="btn-default botonAdmin">Cerrar</button>
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
    function validarPrecio(){
	var valor = document.getElementById("coste_SO").value;
	var patron=/\d{1,}/i;
	if(!patron.test(valor)){
            document.getElementById("error_coste_SO").innerHTML="Este campo debe contener números.";
            ok = false;
	}else{
            document.getElementById("error_coste_SO").innerHTML="";
	}                      
    }
    
    function validarForm(){
	ok=true;
	
        validarPrecio();
	
	//ok=false;	//Si devolvemos false, no se envia el formulario
	return ok;
    }
</script>
