<div >
    <h2>Borrar jugador</h2>
    <?php include "form_and_inputs.php"; ?>
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
        window.document.getElementById("precio").readOnly='readonly';
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