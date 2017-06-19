<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Celeste</title>
        <link href="../../Files/img/favicon2.png" rel="icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- CSS Part Start-->
        <link rel="stylesheet" type="text/css" href="../../Files/css/stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="../../Files/css/estilos.css" />
        <link rel="stylesheet" type="text/css" href="../../Files/css/slideshow.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../../Files/js/colorbox/colorbox.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../../Files/css/carousel.css" media="screen" />
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
                <div>
                    <div class="cajaFormulario" style=" padding: 3%; align-content: center;">
                        <h2 class="TextoTituloFormulario" style="border: orangered 1px solid; border-radius: 15px; text-align: center ; padding: 1%"><strong>FORMULARIO DE REGISTRO</strong></h2><br><br>
                        <div style="padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
                            <legend class="TextoTituloFormulario" ><strong>COMPLETA TUS DATOS PERSONALES</strong> </legend>  <a style="float: right">(*) Campos Obligatorios</a><br><br>
                            <hr style="border: orangered 1px solid;"> <br><br>
                            <form id="fmusuario" method="post" >
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="runUsuario"><strong>Run (*)</strong></label>
                                    <input class="inputFormulario" id="runUsuario" name="runUsuario" type="text" placeholder="112223337"><br><br>
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
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<input  type="radio" id="sexoM" name="sexo" value="Masculino">&nbsp;<a class="TextoFormulario">Masculino</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                                    <label class="TextoFormulario" for="contrasenaUsuario"><strong>Contraseña (*)</strong></label>
                                    <input class="inputFormulario" type="password" id="contrasenaUsuario" name="contrasenaUsuario" placeholder="Ingrese una clave entre 4 y 8 digitos"><br><br>
                                </div>
                                <div class="divformulario">
                                    <label class="TextoFormulario" for="contrasenaRepetidaUsuario"><strong>Repetir Contraseña (*) </strong></label>
                                    <input class="inputFormulario" type="password" id="contrasenaRepetidaUsuario" name="contrasenaRepetidaUsuario" placeholder="Repita su Clave"><br><br>
                                </div>
                                <div style="text-align: center">
                                    <input  type="radio"  id="TerminosyCondiciones" name="TerminosyCondiciones" value="Femenino" >&nbsp;<i class="TextoFormulario">Al registrarte estás aceptando los<a style="color: orangered"> términos y condiciones</a></i><br><br>
                                    <a id="boton" onclick="guardarCliente()" class="button" style="margin: 20px"><i class="icon-lock"> </i> Registrar mis Datos</a>
                                </div>
                                <input type="hidden" id="accion" name="accion" value="">
                                <input type="hidden" id="idPerfil" name="idPerfil" value="3">
                            </form>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">

                    $(function () {
                    });
                    function validar() {
                        return true;
                    }
                    function guardarCliente() {
                        document.getElementById("accion").value = "AGREGAR";
//                        if (validar()) {
                        //console.log("validado");
                        $('#fmusuario').form('submit', {
                            url: "../Servlet/administrarUsuario.php",
                            onSubmit: function () {
                                return $(this).form('validate');
                            },
                            success: function (result) {
                                console.log(result);
                                var result = eval('(' + result + ')');
                                if (result.errorMsg) {
                                    $.messager.alert('Error', result.errorMsg);
                                } else {
                                    $.messager.show({
                                        title: 'Aviso',
                                        msg: result.mensaje
                                    });
                                    window.location = "iniciarSesion.php";
                                }
                            }
                        });
//                        }
                    }


                </script>
                <!--Middle Part End-->
                <?php include("footer.php"); ?>