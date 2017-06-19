<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Celeste</title>
        <link href="../../Files/img/favicon2.png" rel="icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- CSS Part Start-->
        <link rel="stylesheet" type="text/css" href="../../Files/css/stylesheet.css" />        
        <link rel="stylesheet" type="text/css" href="../../Files/css/slideshow.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../../Files/js/colorbox/colorbox.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../../Files/css/carousel.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../../Files/css/estilos.css" />
        <!-- CSS Part End-->
        <!-- JS Part Start-->
        <script type="text/javascript" src="../../Files/js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="../../Files/js/jquery.nivo.slider.pack.js"></script>
        <script type="text/javascript" src="../../Files/js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="../../Files/js/colorbox/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="../../Files/js/tabs.js"></script>
        <script type="text/javascript" src="../../Files/js/jquery.easing-1.3.min.js"></script>
        <script type="text/javascript" src="../../Files/js/cloud_zoom.js"></script>
        <script type="text/javascript" src="../../Files/js/custom.js"></script>
        <script type="text/javascript" src="../../Files/js/jquery.dcjqaccordion.js"></script>
        <!-- JS Part End-->
    </head>
    <body background="../../Files/img/fondoflor1.jpg">
        <div class="main-wrapper">
            <!-- Header Parts Start-->
            <div id="header">
                <div id="logo"><a href="index.php"><img src="../../Files/img/log.png" title="Vivero Celeste" alt="ecommerce Html Template" /></a></div>
                <div id="search">
                    <div class="button-search"></div>
                    <form action="buscar.php" method="get" id="form-buscar">
                        <input type="text" value="" placeholder="" id="filter_name" name="search">
                    </form>
                </div>
                <!--Mini Cart Start-->
                Bienvenido/a:
                <?php
                if (isset($_SESSION['nombre'])) {
                    echo $_SESSION['nombre'];
                    ?>
                    <a href="loginOFF.php">cerrar sesion</a>
                    <?php
                } else {
                     echo "<a href='iniciarSesion.php' style='margin: 20px; color: orangered'>Inicia Sesión</a> o <a href='registrarUsuario.php' style='margin: 20px; color: orangered'>Registrate</a>";
                }
                ?>

            </div>

            <div id="menu"><span>Menu</span>
                <!--Top Navigation Start-->
                <?php include("../Menus/menuVisitante.php"); ?>
                <!--Top Navigation Start-->
            </div>
            <div id="container">
            <?php include("../Menus/menuLeft.php"); ?>


