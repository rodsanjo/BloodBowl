<center>
    <?php
        //$divImag = "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>";
        $divImag = "<div class='col-xs-12 col-sm-6 col-md-6 col-lg-4'>";
    ?>
    
    <div class='col-md-12'>
        <img src="<?php echo URL_APPLICATION_ROOT; ?>recursos/imagenes/portadaCaja.png" alt="portadaCaja3" title="Caja edición 3" style='width: 40%;'/>
    </div>
    
    <?php
        //Imagenes de wallpapers a mostrar
//        $wallpapers = array(1,2,3,4,5,6);
//        foreach ($wallpapers as $key => $num) {
        for( $num = 1; $num < 7 ; $num++ ){
            echo $divImag;
            echo "<img src='".URL_APPLICATION_ROOT."recursos/imagenes/fondo/web/wallpapers$num.jpg' alt='wallpapers$num' title='wallpapers$num' style='width: 100%;'/>";
            echo "</div>";
        }
    ?>
    
</center>
