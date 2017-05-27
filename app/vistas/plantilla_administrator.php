<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php 
        include PATH_APPLICATION_APP."vistas/zonas/head.php";
    ?>   
</head>
<body>
    <section >
        <div id="encabezado" class="teu">
            <div id="conexion">
            <?php 
                //include PATH_APPLICATION_APP."vistas/zonas/form_login.php";
            ?>  
            </div>
            <?php 
                include PATH_APPLICATION_APP."vistas/zonas/encabezado.php";
            ?>
        </div>
        <div id="menu_up">
            <?php 
                include PATH_APPLICATION_APP."vistas/zonas/menu_up.php";
            ?>		
        </div>
    </section>
    <section id="contenido">
        <div class="teu">
            <div id="sidebar_left">
                <div id="menu_izq">
                    <?php 
                        //include PATH_APPLICATION_APP."vistas/zonas/menu_izq.php";
                    ?>		
                </div>
                <div>
                    <?php 
                        //include PATH_APPLICATION_APP."vistas/zonas/cuadro_herramientas.php";
                    ?>
                </div>
            </div>
            <div id="view_content">
                <?php
                    echo $datos['view_content'];
                ?>
            </div>
            <div id="rigth_column">
                <?php 
                    //include PATH_APPLICATION_APP."vistas/zonas/rigth_column.php";
                ?>		
            </div>
           
       </div> 
    </section>

    <section id="piej" class="pie">          
        <div>
            <?php 
                include PATH_HOME."app/vistas/zonas/pie.php";
            ?>
        </div>
        <div id="conexion cuadro_login">
            <?php 
                include PATH_APPLICATION_APP."vistas/zonas/form_login.php";
            ?>  
        </div>    
    </section>
    
    <!--Para poder enviar los formularios con el id oculto-->
    <?php echo \core\HTML_Tag::post_request_form(); ?>
<?php
if (isset($_SESSION["alerta"])) {
    echo <<<heredoc
<script type="text/javascript" />
    alert("{$_SESSION["alerta"]}");
    var alerta = '{$_SESSION["alerta"]}';
</script>
heredoc;
    unset($_SESSION["alerta"]);
}
elseif (isset($datos["alerta"])) {
    echo <<<heredoc
<script type="text/javascript" />
    // alert("{$datos["alerta"]}");
    var alerta = '{$datos["alerta"]}';
</script>
heredoc;
}
?>	
	
<div id='globals'>
    <?php
  //      var_dump($datos);
//        print "<pre>"; 
//          print_r($GLOBALS);
//          print("\$_GET "); print_r($_GET);
//          print("\$_POST ");print_r($_POST);
//          print("\$_COOKIE ");print_r($_COOKIE);
//          print("\$_REQUEST ");print_r($_REQUEST);
//          print("\$_SESSION ");print_r($_SESSION);
//          print("\$_SERVER ");print_r($_SERVER);
//        print "</pre>";
//            print("xdebug_get_code_coverage() ");
//            var_dump(xdebug_get_code_coverage());
    ?>
</div>
    
</body>
</html>