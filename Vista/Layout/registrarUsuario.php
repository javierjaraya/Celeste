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

        <link rel="stylesheet" type="text/css" href="../../Files/Complementos/bootcomplete/dist/bootcomplete.css" media="screen" />
        <!-- CSS Part End-->

        <!-- JS Part Start-->
        <script type="text/javascript" src="../../Files/js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../Files/Complementos/datatables/jquery.dataTables.js"></script>

        <script type="text/javascript" src="../../Files/Complementos/bootcomplete/dist/jquery.bootcomplete.js"></script>
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

                <!-- BUSCAR -->
                <div class="col-md-7" style="padding-top: 20px; z-index: 1040;">                                     
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" id="buscar"  name="buscar" value="" onkeyup="buscar(this.value)" placeholder="Buscar productos..." >
                            <div class="input-group-addon" style="padding: 0px;"><a onclick="resultadoBusqueda()" class="btn btn-warning btn-xs" style="margin: 0px; padding-top: 5px; height: 32px;">Buscar</a></div>
                        </div>
                    </div>
                </div>

                <!-- SCRIPT BUSCAR -->
                <script type="text/javascript">
                    function buscar(cadena) {
                        if (cadena.length > 2) {
                            $('#buscar').bootcomplete({
                                url: '../Servlet/administrarProducto.php?accion=BUSCAR',
                                minLength: 3,
                                dataParams: {
                                    cadena: $("#buscar").val()
                                }
                            });
                            document.getElementById("buscar").focus();
                        }
                    }

                    function resultadoBusqueda() {
                        var busqueda = $("#buscar").val();
                        window.location = "resultadoBusqueda.php?busqueda=" + busqueda;
                    }
                </script>

                <div class="col-md-4">
                    <div style="text-align: right">
                        <h8>Bienvenido/a</h8>
                        <?php
                        if ($nombre != "Visitante") {
                            echo ": " . $_SESSION['nombre'];
                            ?>
                            <a href="../Servlet/loginOFF.php" style='margin: 20px; color: orangered'>cerrar sesion</a>
                            <?php
                        } else {
                            echo "";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- MENU -->
            <div class="row" style="padding-left: 10px; padding-right: 10px;">

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
                                    <h7 class="TextoTituloFormulario" >COMPLETA TUS DATOS PERSONALES</h7><i style="float: right">(*) Campos Obligatorios</i>
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
                                            <label class="col-sm-3 control-label" for="emailUsuarioRepetido"><strong>Repetir E-Mail (*)</strong></label>
                                            <div class="col-sm-6">
                                                <input class="form-control" id="emailUsuarioRepetido" name="emailUsuarioRepetido" type="text" placeholder="ejemplo@celeste.cl">
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
                                            <label class="col-sm-3 control-label" for="telefonoUsuario">Teléfono (*)</label>
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
                                        </div>
                                        <div style="text-align: center">
                                            <input  type="checkbox"  id="TerminosyCondiciones" name="TerminosyCondiciones" value="Femenino" >&nbsp;<i class="TextoFormulario">Al registrarte estás aceptando los<a onclick="AbreTerminosyCondiciones()" style="color: orangered"> términos y condiciones</a></i><br><br>
                                        </div>
                                        <div class="form-group" style="text-align: center">
                                            <div class="col-sm-offset-2 col-sm-9">
                                                <a onclick="guardarCliente()" class="btn btn-warning"><i class="icon icon-next"> </i> Registrar mis Datos</a>
                                            </div>
                                        </div>

                                        <input type="hidden" id="accion" name="accion" value="AGREGAR">
                                        <input type="hidden" id="idPerfil" name="idPerfil" value="2">
                                    </form>
                                </div>
                            </div>

                            <!-- DIALOGO MODAL TERMINOS Y CONDICIONES-->
                            <div class="modal fade bs-example-modal-md" id="dg-modela" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <section id="panel-modal">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <img id="logo-modal" src="../../Files/img/log.png" width="100px" style="float: left;">
                                                <label class="titulo-modal" style="width: 350px; padding-top: 50px;"><h3 class="modal-title" id="modalLabel"></h3></label>
                                            </div>
                                            <form id="fm" method="POST" >
                                                <div class="modal-body">
                                                    <section class="row">                            
                                                        <section class="col-md-12">
                                                            <div id="nombresGroup" class="form-group has-feedback">
                                                                Bienvenido a Celeste. Estos Términos y Condiciones regulan el acceso en Chile a nuestro sitio web y su uso por todo usuario o consumidor. 
                                                                En este sitio podrás usar, sin costo alguno, nuestro software, para visitar y adquirir, si lo deseas, los productos y servicios que se exhiben aquí. 
                                                                Te recomendamos leer atentamente estos términos y condiciones.                                   
                                                            </div>

                                                        </section>                           
                                                    </section><!-- Fin Row-->
                                                </div>
                                                <div class="modal-footer">
                                                    <a class="btn btn-default" data-dismiss="modal">Cerrar</a>
                                                </div>
                                            </form>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <!-- END DIALOGO MODAL-->

                            <script type="text/javascript">
                                function AbreTerminosyCondiciones() {
//                                    document.getElementById("fm").reset();
//                                    document.getElementById('accion').value = "AGREGAR";
                                    $('#modalLabel').html("Terminos y Condiciones");
                                    $('#dg-modela').modal(this)//CALL MODAL MENSAJE
                                }

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
                                                        setTimeout(function(){window.location = "iniciarSesion.php";},3000);
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
