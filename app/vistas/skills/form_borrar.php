<div >
    <h2>Borrar habilidad: <i><?php echo \core\Array_Datos::values('nombre', $datos); ?></i></h2>
    <?php include "form_and_inputs.php"; ?>
    <script type='text/javascript'>
        $(" [type=reset] ").css("display", "none");
        $(" [type=submit] ").value("Borrar");
        
        var formulario = <?php echo \core\Array_Datos::contenido("form_name", $datos); ?>;
        window.document.getElementById("nombre").readOnly='readonly';
        window.document.getElementById("tipo").readOnly='readonly';

        document.getElementById("descripcion").style.display = "none";

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