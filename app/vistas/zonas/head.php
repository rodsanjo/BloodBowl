<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta http-equiv="Content-Type" content="text/html" charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Mostrar sitios para móviles en escala correcta con viewport-->
<meta name="viewport" content="width=750, initial-scale=0.5">

<title><?php echo TITULO; ?></title>
<link href="<?php echo URL_ROOT ?>favicon.png" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo URL_ROOT ?>favicon.png" rel="icon" type="image/x-icon" /> 

<meta name="title" content="Blood Bowl"/>
<meta name="Description" content="Boardgame" />
<meta name="rating" content="General"/>
<meta name="Generator" content="jequeto framework" />
<meta name="Origen" content="Vallekas" />
<meta name="Author" content="Jergo" />
<meta name="Locality" content="Madrid, España" />
<meta name="Lang" content="es" />
<meta name="Viewport" content="maximum-scale=10.0" />
<meta name="revisit-after" content="1 days" />
<meta name="robots" content="NOINDEX,NOFOLLOW,NOARCHIVE,NOSNIPPET, NOYDIR" />

<!-- for Google -->
<meta name="description" content="Aplicaciones de la jerga cotidiana" />
<meta name="keywords" content="blood bowl, juego de mesa, partidos, deporte, razas, touchdown, boardgame" />

<!-- for Facebook -->
<meta property="og:title" content="Blood Bowl" />
<meta property="og:type" content="web" />
<meta property="og:image" content="http://jergapps.zz.mu/bloodbowl/recursos/imagenes/BloodBowl.png" />
<meta property="og:url" content="http://jergapps.zz.mu/bloodbowl/" />
<meta property="og:description" content="Blood Bowl" />

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
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT ?>recursos/css/menu_up.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL_ROOT.'recursos/css/'.\core\Distribuidor::get_controlador_instanciado(); ?>.css" />
<link rel="stylesheet" type="text/css" href="<?php echo URL_HOME_ROOT ?>recursos/css/print.css" media="print"/>

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

<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/config.js"></script>
<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/funciones.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/funciones.js"></script>
<script type="text/javascript" src="<?php echo URL_HOME_ROOT ?>recursos/js/ajax.js"></script>
<script type="text/javascript" src="<?php echo URL_ROOT ?>recursos/js/ajax.js"></script>
