<?php
//Titulo de la aplicación
define('TITULO', 'Blood Bowl');

/*Multiaplicacion: Si es multiaplicacion usaremos la carpeta "home"*/
/*la siguiente variable deberemos definirla al comenzar la aplicación*/
$multiaplicacion = true;
//xdebug_start_code_coverage();
//print "<pre>"; print_r($GLOBALS); print "</pre>";

// Definiciones constantes
define("DS", DIRECTORY_SEPARATOR);

/**
 * @const strin Path donde están alojadas las aplicaciones
 */
define("PATH_ROOT", dirname(__DIR__).DS ); // Finaliza en DS
/**
 * @const string Path donde está alojada la aplicación que se ejecuta
 */
define("PATH_APPLICATION", __DIR__.DS);

// Path de la carpeta app de la aplicación que se ejecuta
define("PATH_APP", __DIR__.DS."app".DS ); // Finaliza en DS
define("PATH_APPLICATION_APP", __DIR__.DS."app".DS ); // Finaliza en DS

/**
 * Carpeta que aloja la aplicación que se ejecuta
 */
define("APPLICATION_FOLDER", str_replace(PATH_ROOT, "", __DIR__));

/**
 * URL_ROOT es la url que incluye esquema, servidor y carpeta en la que está alojada la aplicación o, lo que es equivalente, el fichero index.php que se ejecuta para arrancar la aplicación.
 */
define("URL_ROOT", (isset($_SERVER['REQUEST_SCHEME'])?$_SERVER['REQUEST_SCHEME']:($_SERVER['SERVER_PORT']==80?"http":"https"))."://".$_SERVER['SERVER_NAME'].str_replace("index.php", '', $_SERVER['SCRIPT_NAME'])); // Finaliza en DS

/**
 * URL_ACTUAL es la url que incluye esquema, servidor y la uri.
 * Para que al cambiar de idioma nos mantenga en la misma página, y no vuelva al inicio de la aplicación.
 * @author Jorge
 */
define("URL_ACTUAL", (isset($_SERVER['REQUEST_SCHEME'])?$_SERVER['REQUEST_SCHEME']:($_SERVER['SERVER_PORT']==80?"http":"https"))."://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']); // Finaliza en DS

define("URL_APPLICATION_ROOT", URL_ROOT);

/**
 * Multiaplicacion: Si es multiaplicacion usaremos la carpeta "home"
 * @const string Path donde está alojada al aplicación home o framework
 */
if($multiaplicacion){
    define("PATH_HOME", dirname(__DIR__).DS."home".DS);
    define("URL_HOME_ROOT", dirname(URL_ROOT)."/home/");
}else{
    define("PATH_HOME", PATH_APPLICATION);
    define("URL_HOME_ROOT", URL_APPLICATION_ROOT);
}

//Para comprobar el valor de las constantes
//print_r(URL_HOME_ROOT);
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    
    <title><?php echo TITULO; ?></title>
    <link href="<?php echo URL_ROOT ?>favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="<?php echo URL_ROOT ?>favicon.png" rel="icon" type="image/x-icon" /> 
    
    <link rel="stylesheet" type="text/css" href="<?php echo URL_HOME_ROOT; ?>recursos/css/mantenimiento.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URL_APPLICATION_ROOT; ?>recursos/css/mantenimiento.css">

    <script type="text/javascript" src="<?php echo URL_HOME_ROOT; ?>recursos/js/updating.js"></script>
</head>

<body>
    <div id="view_content">
        <div id="mantenimiento">
            <div class="mantenimiento_box">
                <?php
                    $src = URL_ROOT.'recursos/imagenes/logo.jpg';
                    if( !file_exists($src)){
                        $src = URL_ROOT.'recursos/imagenes/logo.png';
                    }
                ?>
                <img  height="100px" src="<?php echo $src; ?>">
                <table>
                    <tr class="banner">
                        <td class="banner_icono" rowspan="2">
                            <img src="<?php echo URL_HOME_ROOT; ?>recursos/imagenes/updating.png">
                        </td>
                        <td class="banner_alerta">en mantenimiento</td>
                        <td class="banner_icono" rowspan="2">
                            <img src="<?php echo URL_HOME_ROOT; ?>recursos/imagenes/updating.png">
                        </td>
                    </tr>
                    <tr>
                        <td class="banner_alerta">maintenance</td>
                    </tr>
                </table>

                <div class="mantenimiento_mensaje">
                    <div class="mensaje">
                        <h4>Lo sentimos,</h4>
                        <p>Actualmente la aplicación se encuentra en proceso de actualización, disculpe las molestias.</p>
                    </div>
                    <hr class="mantenimiento_rule">
                    <div class="mensaje">
                        <h4>Sorry,</h4>
                        <p>The application is being updated at the moment, sorry for the inconvenience.</p>
                    </div>
                </div>
            </div>

        </div> 
    </div>
    <div class="footer">
        <p class="copyright">&copy; <?php  echo date('Y').' '.TITULO; ?> - <span class="i18n" id_translate="COPYRIGHT">Todos los derechos reservados : All right reserved</span></p>
    </div>
</body>
</html>