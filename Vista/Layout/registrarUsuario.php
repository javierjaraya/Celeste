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

        <!-- CSS Part Start-->     
        <link rel="stylesheet" type="text/css" href="../../Files/css/estilos.css" />     
        <link rel="stylesheet" type="text/css" href="../../Files/css/notificaciones.css" />
        <link rel="stylesheet" type="text/css" href="../../Files/Complementos/datatables/css/jquery.dataTables.css">
        <!-- CSS Part End-->

        <!-- JS Part Start-->
        <script type="text/javascript" src="../../Files/js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../Files/Complementos/datatables/jquery.dataTables.js"></script>
        <!-- JS Part End-->

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" type="text/css" href="../../Files/Complementos/bootstrap/css/bootstrap.css" />
        <script src="../../Files/Complementos/bootstrap/js/bootstrap.min.js"></script>

        <!-- Usabilidad -->
        <script src="../../Files/js/notificaciones.js"></script>

    </head>

    <body background="../../Files/img/fondoflor1.jpg">
        <div class="container" style="background: #fff; margin-top: 20px; border-radius: 5px 5px 0px 0px;">
            <!-- HEADER -->
            <div class="row" style="padding: 10px;">
                <div class="col-md-1">
                    <a href="index.php"><img src="../../Files/img/log.png" title="Vivero Celeste" /></a>
                </div>
                <div class="col-md-7" style="padding-top: 20px;">
                    <input type="text" class="form-control" value="" placeholder="Buscar...." id="buscar-filter" name="search">                    
                </div>
                <div class="col-md-4">
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
            </div>
            <!-- MENU -->
            <div class="row" style="padding: 10px;">

                <div id="menu"><span>Menu</span>
                    <!--Top Navigation Start-->
                    <?php
                    if ($idPerfil == 1) {
                        include("../Menus/menuAdministrador.php");
                    } else if ($idPerfil == 2) {
                        include("../Menus/menuCliente.php");
                    } else if ($idPerfil == 3) {
                        include("../Menus/menuVisitante.php");
                    }
                    ?>
                    <!--Top Navigation Start-->
                </div>
            </div>

            <!-- CUERPO -->
            <div class="row">
                <div class="container">
                    
                    <div class="col-md-12">

                        <div class="row"> 



                            <div class="cajaFormulario" style=" padding: 3%; align-content: center;">
                                <h2 class="TextoTituloFormulario" style="border: orangered 1px solid; border-radius: 15px; text-align: center ; padding: 1%"><strong>FORMULARIO DE REGISTRO</strong></h2><br><br>
                                <div style="padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
                                    <legend class="TextoTituloFormulario" ><strong>COMPLETA TUS DATOS PERSONALES</strong> </legend>  <a style="float: right">(*) Campos Obligatorios</a><br><br>
                                    <hr style="border: orangered 1px solid;"> <br><br>
                                    <div id="alert"></div>
                                    <form id="fmusuario" method="post" >
                                        <div class="divformulario">
                                            <label class="TextoFormulario" for="runUsuario"><strong>Run (*)</strong></label>
                                            <input class="inputFormulario" id="runUsuario" name="runUsuario" type="text" placeholder="112223337" onkeyup="eliminarCaracteres()"><br><br>
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
                                            <label class="TextoFormulario" for="contrasenaUsuario"><strong>Contraseña (*)</strong></label>
                                            <input class="inputFormulario" type="password" id="contrasenaUsuario" name="contrasenaUsuario" placeholder="Ingrese una clave entre 4 y 8 digitos"><br><br>
                                        </div>
                                        <div class="divformulario">
                                            <label class="TextoFormulario" for="contrasenaRepetidaUsuario"><strong>Repetir Contraseña (*) </strong></label>
                                            <input class="inputFormulario" type="password" id="contrasenaRepetidaUsuario" name="contrasenaRepetidaUsuario" placeholder="Repita su Clave"><br><br>
                                        </div>
                                        <div style="text-align: center">
                                            <input  type="checkbox"  id="TerminosyCondiciones" name="TerminosyCondiciones" value="Femenino" >&nbsp;<i class="TextoFormulario">Al registrarte estás aceptando los<a style="color: orangered"> términos y condiciones</a></i><br><br>
                                            <a id="boton" onclick="guardarCliente()" class="button" style="margin: 20px"><i class="icon-lock"> </i> Registrar mis Datos</a>
                                        </div>
                                        <input type="hidden" id="accion" name="accion" value="AGREGAR">
                                        <input type="hidden" id="idPerfil" name="idPerfil" value="2">
                                    </form>
                                </div>
                            </div>

                            <script type="text/javascript">

                                function guardarCliente() {
                                    if (document.getElementById('TerminosyCondiciones').checked) {
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
                                                        window.location = "iniciarSesion.php";
                                                    }
                                                }
                                            });
                                        }
                                    } else {
                                        notificacion('Primero debe aceptar los términos y condiciones', 'warning', 'alert');
                                    }
                                }
                            </script>
                            <!--Middle Part End-->
                            <?php include("footer.php"); ?>
