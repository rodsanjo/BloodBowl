<?php
//require dirname(realpath(__FILE__)).'/app/core/configuracion.php';
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

//Titulo de la aplicación
define('TITULO', 'Blood Bowl');

//Para comprobar el valor de las constantes
//print_r(URL_HOME_ROOT);

// Preparar el autocargador de clases.
// Este y el contenido en \core\Autoloader() serán los únicos require/include de toda la aplicación
require PATH_HOME.'app/core/autoloader.php'; 
//$autoloader = new \core\Autoloader();
$autoloader = new \core\Autoloader(array(APPLICATION_FOLDER => true));
//spl_autoload_register(array('\core\Autoloader', 'autoload'));

//require_once PATH_APP."core/aplicacion.php";
// Cargamos la aplicación
$aplicacion = new \core\Aplicacion();
//\core\Aplicacion::iniciar();

//print "<pre>"; print_r($_SESSION); print "</pre>";

// Fin de index.php