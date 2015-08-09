<div>
    <h2><span style="color:brown;">Raza:</span> <i><?php echo \core\Array_Datos::values('raza', $datos); ?></i></h2>
    <?php include "form_and_inputs.php"; ?>
    <script type='text/javascript'>
        window.document.getElementById("referencia").readOnly='readonly';                
    </script>
</div>