<div>
    <h2>Modificar jugador: <i><?php echo \core\Array_Datos::values('nombre', $datos); ?></i></h2>
    <?php include "form_and_inputs.php"; ?>
    
    <?php
        if($datos['controlador_metodo'] != 'form_insertar'){
            $id = \core\Array_Datos::values('id', $datos);
            //echo \core\HTML_Tag::a_boton_onclick("Borrar", array("players", "form_borrar", $id));
            $uri = \core\URL::http_generar('players/form_borrar');
            $onclick = "onclick='submit_post_request_form(\'$uri\', \'$id\')";
            echo "<input type='button' $onclick value='Borrar' class='btn-default botonAdmin' style='background:rgb(255,167,115);float: right;'/>";
        }
    ?>
    <script type='text/javascript'>
        window.document.getElementById("referencia").readOnly='readonly';                
    </script>
</div>