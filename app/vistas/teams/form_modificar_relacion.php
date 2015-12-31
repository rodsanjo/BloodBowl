<div>
    <h2><span style="color:brown;">Raza:</span> <i><?php echo \core\Array_Datos::values('raza', $datos); ?></i></h2>
<form method='post' name='<?php echo \core\Array_Datos::contenido("form_name", $datos); ?>' action="<?php echo \core\URL::generar($datos['controlador_clase'].'/validar_'.$datos['controlador_metodo']); ?>" enctype='multipart/form-data' onsubmit="return validarForm();">
    <fieldset><legend>Cantidad de jugadores por equipo</legend>
	<?php echo \core\HTML_Tag::form_registrar($datos["form_name"], "post"); ?>
	
	<input id='id' name='id' type='hidden' value='<?php echo \core\Array_Datos::values('id', $datos); ?>' />
        <input id='id' name='jugador_id' type='hidden' value='<?php echo \core\Array_Datos::values('jugador_id', $datos); ?>' />
        <input id='id' name='equipo_id' type='hidden' value='<?php echo \core\Array_Datos::values('equipo_id', $datos); ?>' />
	
        <table class="table table-striped"><tr>
        <td>
        <label for="num_min">Número minimo:</label><input id='num_min' name='num_min' type='text' size='1'  maxlength='2' value='<?php echo \core\Array_Datos::values('num_min', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('num_min', $datos); ?>
        </td><td>
        <label for="num_max">Número máximo:</label><input id='num_max' name='num_max' type='text' size='1'  maxlength='2' value='<?php echo \core\Array_Datos::values('num_max', $datos); ?>'/>
	<?php echo \core\HTML_Tag::span_error('num_max', $datos); ?>
        </td>
        </tr></table>
        
	<?php
        if($datos['controlador_metodo'] == 'form_insertar'){
            $input_value = 'Enviar';
        }else{
            $input_value = 'Modificar';
        }
        ?>
        
	<input type='submit' value='<?php echo $input_value; ?>' class="btn-default botonAdmin" style="background:rgb(160,216,118);"/>
        <input type='reset' value='Restablecer' class="btn-default botonAdmin"/>
        <button type='button' onclick='window.location.assign("<?php echo \core\URL::generar($datos['controlador_clase']); ?>");' class="btn-default botonAdmin">Cancelar</button>
        
        <?php echo \core\HTML_Tag::span_error('errores_validacion', $datos); ?>
        
        <!--<button type='button' onclick='window.location.assign("<?php echo $datos['url_cancelar']; ?>");' class="btn-default botonAdmin">Cancelar</button>-->
        <?php
        if($datos['controlador_metodo'] != 'form_modificar_relacion' && \core\Usuario::tiene_permiso('teams', 'validar_form_modificar_relacion') ){
            $id = \core\Array_Datos::values('id', $datos);
            //echo \core\HTML_Tag::a_boton_onclick("Borrar", array("players", "form_borrar", $id));
            $uri = \core\URL::http_generar('players/form_borrar');
            //$onclick = "onclick='submit_post_request_form(\'$uri\', \'$id\')";
            $onclick = \core\URL::generar($datos['controlador_clase'].'/form_borrar/'.$id);
            echo "<a href=\"$onclick\"><input type='button' value='Borrar' class='btn-default botonAdmin' style='background:rgb(255,167,115);float: right;'/></a>";
        }?>
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
    <script type='text/javascript'>
        window.document.getElementById("referencia").readOnly='readonly';                
    </script>
</div>