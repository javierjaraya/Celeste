<?php
session_start();
$idPerfil = 3;
$nombre = "Visitante";
$autentificado = "NO";
if (isset($_SESSION["autentificado"])) {
    if ($_SESSION["autentificado"] == "SI") {
        $idPerfil = $_SESSION["idPerfil"];
        $nombre = $_SESSION["nombre"];
        $autentificado = "SI";
    }
} else {
    header('Location: index.php');
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
        <script src="../../Files/js/ValidaCamposFormulario.js"></script>
        <script src="../../Files/js/validarut.js"></script>

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
                            <div class="cajaFormulario" style=" padding: 1%; align-content: center;">
                                <h4 class="TextoTituloFormulario" style="border: orangered 1px solid; border-radius: 15px; text-align: center ; padding: 1%;"><strong>FORMULARIO DE REGISTRO</strong></h4><br>
                                <div style="padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">
                                    <h7 class="TextoTituloFormulario" >COMPLETAR DATOS PERSONALES</h7><i style="float: right">(*) Campos Obligatorios</i>
                                    <hr style="border: orangered 1px solid;"> <br>
                                    <div id="alert"></div>
                                    <form id="fmusuario" class="form-horizontal" method="post" >    
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="runUsuario">Run(*)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control " id="runUsuario" name="runUsuario" type="text" placeholder="112223337" onkeyup="eliminarCaracteres()">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="nombresUsuario">Nombres (*)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="nombresUsuario" name="nombresUsuario" type="text">                                     
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="apellidosUsuario">Apellidos (*)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="apellidosUsuario" name="apellidosUsuario" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="emailUsuario"><strong>E-Mail (*)</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="emailUsuario" name="emailUsuario" type="text" placeholder="ejemplo@celeste.cl">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="sexo">Sexo (*)</label>
                                            <div class="col-sm-6">
                                                <div class="col-md-3">
                                                    <input  type="radio" id="sexoM" name="sexo" value="Masculino" checked="checked" >&nbsp;&nbsp;Masculino
                                                </div>
                                                <div class="col-md-3">
                                                    <input  type="radio" id="sexoF" name="sexo" value="Femenino" >&nbsp;&nbsp;Femenino
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="telefonoUsuario">Telefono (*)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="telefonoUsuario" name="telefonoUsuario" type="text" placeholder="Ej: 988776655">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="direccionUsuario">Dirección (*)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="direccionUsuario" name="direccionUsuario" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="idPerfil">Perfil de Usuario (*)</label>                                    
                                            <div class="col-sm-6">
                                                <select  class="form-control" id="idPerfil" name="idPerfil" required >                                        
                                                </select> 
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="contrasenaUsuario">Contraseña (*)</label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="password" id="contrasenaUsuario" name="contrasenaUsuario" placeholder="Ingrese una clave entre 4 y 8 digitos">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="contrasenaRepetidaUsuario"><strong>Repetir Contraseña (*) </strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" type="password" id="contrasenaRepetidaUsuario" name="contrasenaRepetidaUsuario" placeholder="Repita su Clave">
                                            </div>
                                        </div><br>
                                        <div class="form-group" style="text-align: center">
                                            <div class="col-sm-offset-2 col-sm-9">
                                                <a onclick="guardarCliente()" class="btn btn-warning"><i class="icon icon-next"> </i> Registrar Usuario</a>
                                            </div>
                                        </div>

                                        <input type="hidden" id="accion" name="accion" value="AGREGAR">
                                    </form>
                                </div>
                            </div>

                            <script type="text/javascript">

                                $(function () {
                                    cargarPerfiles();
                                });
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

                                function guardarCliente() {
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
                                                    window.location = "administrarUsuarios.php";
                                                }
                                            }
                                        });
                                    }
                                }
                            </script>
                            <!--Middle Part End-->
                            <?php include("footer.php"); ?>
