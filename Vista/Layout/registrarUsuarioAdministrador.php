<?php
session_start();
$idPerfil = 3;
$nombre = "Visitante";
if (isset($_SESSION["autentificado"])) {
    if ($_SESSION["autentificado"] == "SI") {
        $idPerfil = $_SESSION["idPerfil"];
        $nombre = $_SESSION["nombre"];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Celeste</title>
        <link href="../../Files/img/favicon2.png" rel="icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- CSS Part Start-->
        <link rel="stylesheet" type="text/css" href="../../Files/css/stylesheet.css" />
        <!--<link rel="stylesheet" type="text/css" href="../../Files/css/slideshow.css" media="screen" />-->
        <link rel="stylesheet" type="text/css" href="../../Files/js/colorbox/colorbox.css" media="screen" />
        <!--<link rel="stylesheet" type="text/css" href="../../Files/css/carousel.css" media="screen" />-->
        <link rel="stylesheet" type="text/css" href="../../Files/css/estilos.css" />
        <link rel="stylesheet" type="text/css" href="../../Files/css/glyphicon.css" />
        <link rel="stylesheet" type="text/css" href="../../Files/css/notificaciones.css" />
        <link rel="stylesheet" type="text/css" href="../../Files/Complementos/datatables/css/jquery.dataTables.css">
        <!--         Bootstrap 3.3.6 
                <link rel="stylesheet" type="text/css" href="../../Files/Complementos/bootstrap/css/bootstrap.css" />-->
        <!-- CSS Part End-->

        <!-- JS Part Start-->
        <!--<script type="text/javascript" src="../../Files/js/jquery-1.7.1.min.js"></script>        -->
        <script type="text/javascript" src="../../Files/js/jquery-2.2.3.min.js"></script>
        <!-- <script type="text/javascript" src="../../Files/js/jquery.nivo.slider.pack.js"></script>-->
        <!-- <script type="text/javascript" src="../../Files/js/jquery.jcarousel.min.js"></script> -->
        <script type="text/javascript" src="../../Files/js/colorbox/jquery.colorbox-min.js"></script>
        <!--<script type="text/javascript" src="../../Files/js/tabs.js"></script>-->
        <!--<script type="text/javascript" src="../../Files/js/jquery.easing-1.3.min.js"></script>-->
        <!--<script type="text/javascript" src="../../Files/js/cloud_zoom.js"></script>-->
        <!--<script type="text/javascript" src="../../Files/js/custom.js"></script>-->
        <!--<script type="text/javascript" src="../../Files/js/jquery.dcjqaccordion.js"></script>-->
        <script type="text/javascript" src="../../Files/js/jquery.validate.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <!--<script src="../../Files/Complementos/bootstrap/js/bootstrap.min.js"></script>-->
        <!-- Usabilidad -->
        <script src="../../Files/js/notificaciones.js"></script>
        <script src="../../Files/js/ValidaCamposFormulario.js"></script>
        <script src="../../Files/js/validarut.js"></script>
        <script type="text/javascript" charset="utf8" src="../../Files/Complementos/datatables/jquery.dataTables.js"></script>
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
                <div style="text-align: right">
                <h8>Bienvenido/a:</h8>
                  <?php
                if ($nombre != "Visitante") {
                    echo $_SESSION['nombre'];
                    ?>
                    <a href="../Servlet/loginOFF.php" style='margin: 20px; color: orangered'>cerrar sesion</a>
                    <?php
                } else {
                    echo "<a href='iniciarSesion.php' style='margin: 20px; color: orangered'>Inicia Sesión</a> o <a href='registrarUsuario.php' style='margin: 20px; color: orangered'>Registrate</a>";
                }
                ?>
                    </div>

            </div>

            <div id="menu"><span>Menu</span>
                <!--Top Navigation Start-->
                <?php include("../Menus/menuVisitante.php"); ?>
                <!--Top Navigation Start-->
            </div>
            <div id="container">  
                <div>
                    <div class="cajaFormulario" style=" padding: 3%; align-content: center;">
                        <h2 class="TextoTituloFormulario" style="border: orangered 1px solid; border-radius: 15px; text-align: center ; padding: 1%"><strong>FORMULARIO DE REGISTRO</strong></h2><br><br>
                        <div style="padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
                            <legend class="TextoTituloFormulario" ><strong>COMPLETAR DATOS PERSONALES</strong> </legend>  <a style="float: right">(*) Campos Obligatorios</a><br><br>
                            <hr style="border: orangered 1px solid;"> <br><br>
                            <div id="alert"></div>
                            <form id="fmusuario" method="post" >
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="runUsuario"><strong>Run (*)</strong></label>
                                    <input class="inputFormulario" id="runUsuario" name="runUsuario" type="text" placeholder="Ingrese su run sin puntos ni guión. ej: 112223337" onkeyup="eliminarCaracteres()"><br><br>
                                </div>
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="nombresUsuario"><strong>Nombres (*)</strong></label>
                                    <input class="inputFormulario" id="nombresUsuario" name="nombresUsuario" type="text"><br><br>
                                </div>
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="apellidosUsuario"><strong>Apellidos (*)</strong></label>
                                    <input class="inputFormulario" id="apellidosUsuario" name="apellidosUsuario" type="text"><br><br>
                                </div>
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="emailUsuario"><strong>E-Mail (*)</strong></label>
                                    <input class="inputFormulario" id="emailUsuario" name="emailUsuario" type="text" placeholder="ejemplo@celeste.cl"><br><br>
                                </div>
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="sexo"><strong>Sexo (*)&nbsp;&nbsp;&nbsp; </strong></label>
                                    <label class="checkbox" >
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<input  type="radio" id="sexoM" name="sexo" value="Masculino" checked="checked" >&nbsp;<a class="TextoFormulario">Masculino</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input  type="radio" id="sexoF" name="sexo" value="Femenino" >&nbsp;<a class="TextoFormulario">Femenino</a>
                                    </label><br><br>
                                </div>
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="telefonoUsuario"><strong>Telefono (*)</strong></label>
                                    <input class="inputFormulario" id="telefonoUsuario" name="telefonoUsuario" type="text" placeholder="Ej: 988776655"><br><br>
                                </div>
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="direccionUsuario"><strong>Dirección (*)</strong></label>
                                    <input class="inputFormulario" id="direccionUsuario" name="direccionUsuario" type="text"><br><br>
                                </div>
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="idPerfil"><strong>Perfil de Usuario (*)</strong></label>                                    
                                    <select  class="inputFormulario" id="idPerfil" name="idPerfil" required style=" width: 428.73px">                                        
                                    </select><br><br>                                    
                                </div> 
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="contrasenaUsuario"><strong>Contraseña (*)</strong></label>
                                    <input class="inputFormulario" type="password" id="contrasenaUsuario" name="contrasenaUsuario" placeholder="Ingrese una clave entre 4 y 8 digitos"><br><br>
                                </div>
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="contrasenaRepetidaUsuario"><strong>Repetir Contraseña (*) </strong></label>
                                    <input class="inputFormulario" type="password" id="contrasenaRepetidaUsuario" name="contrasenaRepetidaUsuario" placeholder="Repita la Clave"><br><br>
                                </div>
                                <div style="text-align: center">
                                    <a id="boton" onclick="guardarUsuario()" class="button" style="margin: 20px"><i class="icon-lock"> </i> Registrar Usuario</a>
                                </div>
                                <input type="hidden" id="accion" name="accion" value="AGREGAR">
                            </form>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        cargarPerfiles();
                    });
                    function guardarUsuario() {
                        if (validarUsuario()) {
                            $.ajax({
                                type: "POST",
                                url: "../Servlet/administrarUsuario.php",
                                data: $("#fmusuario").serialize(),
                                success: function (result) {
                                    console.log(result);
                                    var result = eval('(' + result + ')');
                                    if (result.errorMsg) {
                                        notificacion(result.errorMsg, 'danger', 'alert');
                                    } else {
                                        notificacion(result.mensaje, 'success', 'alert');
                                        window.location = "iniciarSesion.php";//cambiar
                                    }
                                }
                            });
                        }
                    }
                    function cargarPerfiles() {
                        var url_json = '../Servlet/administrarPerfil.php?accion=LISTADO';
                        $.getJSON(
                                url_json,
                                function (datos) {
                                    $.each(datos, function (k, v) {
                                        var contenido = "<option value='" + v.idPerfil + "'>" + v.nombrePerfil + "</option>";
                                        $("#idPerfil").append(contenido);
                                    });
                                }
                        );
                    }

                </script>
                <!--Middle Part End-->
                <?php include("footer.php"); ?>
