<?php // var_dump($datos); ?>
<form method='post' name='<?php echo \core\Array_Datos::contenido("form_name", $datos); ?>' action="<?php echo \core\URL::generar($datos['controlador_clase'].'/validar_'.$datos['controlador_metodo']); ?>" enctype='multipart/form-data' onsubmit="return validarForm();">
    <fieldset><legend>Habilidad</legend>
	<?php echo \core\HTML_Tag::form_registrar($datos["form_name"], "post"); ?>
	
	<input id='id' name='id' type='hidden' value='<?php echo \core\Array_Datos::values('id', $datos); ?>' />
	
        <label for="nombre">Nombre:</label><input id='nombre' name='nombre' type='text' size='100'  maxlength='100' value='<?php echo \core\Array_Datos::values('nombre', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('nombre', $datos); ?>
	<br />
        
        <div>
            <div class="col_100">
                <b>Tipo de habilidad:</b><br />
                <?php
                $siglasTipos = \modelos\skills::getTipos();
                //var_dump($siglasTipos);
                foreach ($siglasTipos as $sigla) {
                    $nombreTipo = \modelos\skills::getNombreTipo($sigla['tipo']);
                    $checked = '';
                    if(isset($datos['values']['tipo']) && $sigla['tipo'] == $datos['values']['tipo'] ){
                        $checked = "checked='checked'";
                    }
                    echo "<input name='tipo' type='radio' value='{$sigla['tipo']}' $checked/> $nombreTipo";
                }
                ?>
            </div>
        </div>

        <b>Descripcion:</b><br/>
        <textarea id="descripcion" name="descripcion" maxlength='1000' cols="120" rows="3"><?php echo \core\Array_Datos::values('descripcion', $datos); ?></textarea>
        <br/>
        
	<input type='submit' value='Enviar' class="btn-default botonAdmin" style="background:rgb(160,216,118);"/>
        <input type='reset' value='Restablecer' class="btn-default botonAdmin"/>
        <button type='button' onclick='window.location.assign("<?php echo \core\URL::generar($datos['controlador_clase']); ?>");' class="btn-default botonAdmin">Cancelar</button>
        
        <?php echo \core\HTML_Tag::span_error('errores_validacion', $datos); ?>
        
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
    
    function Valida (){
        if (IsChk('equipo_id')){
            //ok, hay al menos 1 elemento chequeado envía el form!
            return true;
        } else {
            //ni siquiera uno chequeado no envía el form
            alert ('Chequeame un elemento!');
            return false;
        }
    }
    
    function IsChk(chkName){
        var found = false;
        var chk = document.getElementsByName(chkName+'[]');
        for (var i=0 ; i < chk.length ; i++){
            found = chk[i].checked ? true : found;
        }
        return found;
    }
    
    function validarForm(){
	ok=true;
	
        //validarNombre_via();
	//validarNum_portal();
	
	//ok=false;	//Si devolvemos false, no se envia el formulario
	return ok;
    }
</script>
