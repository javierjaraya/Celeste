<?php
session_start();
$idPerfil = 3;
$nombre = "Visitante";
$autentificado = "NO";
$precio_total = 0;
if (isset($_SESSION["autentificado"])) {
    if ($_SESSION["autentificado"] == "SI") {
        $idPerfil = $_SESSION["idPerfil"];
        $nombre = $_SESSION["nombre"];
        $run = $_SESSION["run"];
        $autentificado = "SI";
        include_once '../../Controlador/Celeste.php';
        $control = Celeste::getInstancia();
        $carritoCompra = $control->getCarritoCompra();
        $precio_total = number_format($carritoCompra->precio_total(), 0, ',', '.');
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
        <link rel="stylesheet" type="text/css" href="../../Files/Complementos/menuDespegable/estilo-menu.css" />

        <!-- CSS Part End-->

        <!-- JS Part Start-->
        <script type="text/javascript" src="../../Files/js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../Files/Complementos/datatables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../../Files/Complementos/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../../Files/Complementos/menuDespegable/js-menu.js"></script>
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

                <?php if ($autentificado == "SI") { ?>
                    <!-- CARRO -->
                    <div id="cart" class=""style="float: right; padding-top: 20px;">
                        <div class="" style="width: 200px;">
                            <div class="btn-group" role="group">                            
                                <img width="32" height="32" alt="small-cart-icon" src="../../Files/img/cart-bg.png" style="background: #F15A23;">
                                <a style="text-decoration: none; color: #333;" data-toggle="dropdown"><span id="cart-total">Total Carro :  $<?= $precio_total ?></span><span class="caret"></span></a>                           
                                <ul class="dropdown-menu">
                                    <li><a href="carroDeCompra.php">Ver Carro<samp class="glyphicon glyphicon-shopping-cart" style="float: right;"></samp></a></li>
                                    <li><a href="#">Pagar<samp class="glyphicon glyphicon-usd" style="float: right;"></samp></a></li>
                                </ul>
                            </div>
                        </div>                    
                    </div>
                <?php } ?>

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
            <div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center; margin-bottom: 20px;">
                <h4 class="TextoTituloFormulario"><strong>Administrar Usuarios</strong></h4>
            </div>
            <form action="enviarCorreo.php" class="form-horizontal" method="Post">

                <div class="col-md-12" id="subContenedor"  style="display: block; padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px; margin-bottom: 20px;">
                    <h5><strong>POR SU SEGURIDAD, ES NECESARIO QUE INGRESE LA INFORMACION CON LA CUAL SE REGISTRO:</strong></h5>
                    <hr style="border: orangered 1px solid;">
                    <div id="alert"></div>
                    <div class="form-group" id="groupRun">
                        <label for="run" class="col-sm-4 control-label">Run</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="run" name="run">
                        </div>
                    </div>
                    <div class="form-group" id="groupRun">
                        <label for="correo" class="col-sm-4 control-label">Correo Electronico</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="correo" name="correo">
                        </div>
                    </div>

                    <div class="buttons" style="text-align: center;" id="btnclaveNueva">
                        <div class="right"><input class="btn btn-warning" type="submit" onclick="CorroboraInformacion()" value="Confirmar"></div>
                    </div>
                </div>
                <input type="hidden" value="Recuperar Clave" name="asunto" id="asunto">
                <input type="hidden" value="" name="mensaje" id="mensaje">
                <input type="hidden" id="destino" name="destino" value="joseline.cisternas@gmail.com">
                <input type="hidden" id="desde" name="desde" value="Sistema web Celeste">
                <input type="hidden" id="nombreCompleto" name="nombreCompleto" value="">
                <input type="hidden" id="emailUsuario" name="emailUsuario" value="">
            </form>

            <script>
                function generaClaveRandom() {
                    var nombre = document.getElementById('nombreCompleto').value;
                    var min = 1000;
                    var max = 99999999;
                    var newPass = Math.floor(Math.random() * (max - min)) + min;
                    document.getElementById('mensaje').value = "Estimado/a " + nombre + ": Su nueva Clave es: " + newPass + ". Se Recomienda cambiar esta contraseña lo antes posible en la sección 'Mi Perfil'";
                    return newPass;

                }

                function CorroboraInformacion() {
                    var correoIngresado = document.getElementById('correo').value;
                    var runIngresado = document.getElementById('run').value;
                    if (correoIngresado != null && runIngresado != null) {
                        var url_json = '../Servlet/administrarUsuario.php';
                        $.ajax({
                            type: "POST",
                            url: url_json,
                            data: 'accion=BUSCAR_BY_ID&run=' + runIngresado,
                            success: function (data) {
                                var data = eval('(' + data + ')');
                                document.getElementById('run').value = data.run;
                                document.getElementById('emailUsuario').value = data.correoElectronico;
                                if (correoIngresado == data.correoElectronico && runIngresado == data.run) {
                                    var newPass = generaClaveRandom();
                                    var mensaje = document.getElementById('mensaje').value;
                                    document.getElementById('nombreCompleto').value = data.nombres + " " + data.apellidos;
                                    //falta hacer el update de la clave
                                    notificacion('Los datos coinciden, Su nueva clave será enviada al correo registrado en el sistema', 'success', 'alert');
                                } else {
                                    notificacion('Los Sentimos :( , los datos no coinciden. Intente nuevamente', 'warning', 'alert');
                                }
                            }
                        });
                    }else{
                      notificacion('Debe ingresar los datos solicitados', 'warning', 'alert');
                    }
                }

            </script>
            <?php include("footer.php"); ?>
            