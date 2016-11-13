<center>
    <?php
        //$divImag = "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>";
        $divImag = "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>";
    
        //Imagenes de wallpapers a mostrar
        $cajaEdicion = array(1,2,3, '3_ZonaMortal' ,5);
        foreach ($cajaEdicion as $key => $num) {
            echo $divImag;
            echo "<img src='".URL_APPLICATION_ROOT."recursos/imagenes/cajas/cajaEdicion$num.jpg' alt='cajaEdicion$num' title='cajaEdicion$num' style='width: 100%;'/>";
            echo "</div>";
        }
    ?>
    
</center>
