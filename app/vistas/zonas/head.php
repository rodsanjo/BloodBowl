<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Mostrar sitios para móviles en escala correcta con viewport-->
<meta name="viewport" content="width=750, initial-scale=0.5">

<title><?php echo TITULO; ?></title>
<link href="<?php echo URL_ROOT ?>favicon.png" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo URL_ROOT ?>favicon.png" rel="icon" type="image/x-icon" /> 

<meta name="title" content="Home"/>

<meta name="Description" content="Home" />
<meta name="rating" content="General"/>
<meta name="Generator" content="con qué se ha hecho" />
<meta name="Origen" content="Quíen lo ha hecho: Jergo" />
<meta name="Author" content="nombre del autor: Jorge" />
<meta name="Locality" content="Madrid, España" />
<meta name="Lang" content="es" />
<meta name="Viewport" content="maximum-scale=10.0" />
<meta name="revisit-after" content="1 days" />
<meta name="robots" content="NOINDEX,NOFOLLOW,NOARCHIVE,NOSNIPPET, NOYDIR" />

<!-- for Google -->
<meta name="description" content="Aplicaciones de la jerga cotidiana" />
<meta name="keywords" content="" />

<!-- for Facebook -->
<meta property="og:title" content="jergapps" />
<meta property="og:type" content="article" />
<meta property="og:image" content="http://www.jergapps.com/images/logo.png" />
<meta property="og:url" content="http://www.jergapps.com/" />
<meta property="og:description" content="Aplicaciones de la jerga cotidiana" />

<!-- for Twitter -->
<meta name="twitter:card" content="summary" />
<meta name="twitter:title" content="jergapps" />
<meta name="twitter:description" content="Aplicaciones de la jerga cotidiana" />
<meta name="twitter:image" content="http://www.jergapps.com/images/logo.png" />

<?php 
    include PATH_HOME."app/vistas/zonas/head_bootstrap.php";
?>

<link rel="stylesheet" type="text/css" href="<?php echo URL_HOME_ROOT ?>recursos/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT ?>recursos/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT.'recursos/css/'.\core\Distribuidor::get_controlador_instanciado(); ?>.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT ?>recursos/css/print.css" media="print"/> 

<?php if (isset($_GET["administrator"])): ?>
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT; ?>recursos/css/administrator.css" />
<?php endif; ?>

<!--[if lte IE 7]>
    <link rel="stylesheet" href="<?php echo URL_HOME_ROOT ?>recursos/css/ie7.css" />
<![endif]-->

<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/f_cookies.js"></script>
<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/idiomas.js"></script>

<script type="text/javascript" src=""></script>
<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/jquery/jquery-1.10.2.js"></script>

<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/funciones.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/funciones.js"></script>

<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/ajax.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/ajax.js"></script>
