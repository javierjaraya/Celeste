<?php
session_start();
$idPerfil = 3;
$nombre = "Visitante";
$autentificado = "NO";
if (isset($_SESSION["autentificado"])) {
    if ($_SESSION["autentificado"] == "SI") {
        $idPerfil = $_SESSION["idPerfil"];
        $nombre = $_SESSION["nombre"];
        $run = $_SESSION["run"];
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
        <link rel="stylesheet" type="text/css" href="../../Files/Complementos/menuDespegable/estilo-menu.css" />

        <link rel="stylesheet" type="text/css" href="../../Files/Complementos/bootcomplete/dist/bootcomplete.css" media="screen" />
        <!-- CSS Part End-->

        <!-- JS Part Start-->
        <script type="text/javascript" src="../../Files/js/jquery-2.2.3.min.js"></script>
        <script type="text/javascript" charset="utf8" src="../../Files/Complementos/datatables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="../../Files/Complementos/jquery-easyui-1.4.2/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="../../Files/Complementos/menuDespegable/js-menu.js"></script>
        
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
                        <div class="" style="width: 160px;">
                            <div class="btn-group" role="group">                            
                                <img width="32" height="32" alt="small-cart-icon" src="../../Files/img/cart-bg.png" style="background: #F15A23;">
                                <a style="text-decoration: none; color: #333;" data-toggle="dropdown"><span id="cart-total">Total Carro :  $0</span><span class="caret"></span></a>                           
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

            <!-- CUERPO -->
            <div class="row">
                <div class="container">
                    <div class="col-md-3">
                        <?php include("../Menus/menuLeft.php"); ?>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12" style="padding: 5px; border: orangered 1px solid; border-radius: 15px; text-align: center;  margin-bottom: 20px;">
                                <h4 class="TextoTituloFormulario"><strong>INGRESE SUS DATOS PARA INICIAR SESIÓN</strong></h4>
                            </div>
                            <div class="col-md-12" style="padding: 3%; align-content: center; border: orangered 1px solid; border-radius: 15px;">      
                                <div  class="row">
                                    <div id="alert"></div>    
                                    <form id="fmlogin" class="form-horizontal">
                                        <div id="fmlogin" class="form-group">
                                            <label for="inputRun" class="col-sm-4 control-label">Run</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="inputRun" name="inputRun" placeholder="112223337">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-sm-4 control-label">Contraseña</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Contraseña">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <div class="checkbox">
                                                    <label style="width: 200px;">
                                                        <a href="restablecerClave.php">Olvido su contraseña</a>                                
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <a onclick="validarLogin()" class="btn btn-warning">Ingresar</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>





                        <script>
                            function validarLogin() {
                                $.ajax({
                                    type: "POST",
                                    url: "../Servlet/login.php",
                                    data: $("#fmlogin").serialize(),
                                    success: function (result) {
                                        console.log(result);
                                        var result = eval('(' + result + ')');
                                        if (!result.success) {
                                            notificacion(result.mensaje, 'danger', 'alert');
                                        } else {
                                            location.href = result.pagina;
                                        }
                                    }
                                });
                            }
                        </script>

                        <!--Middle Part End-->
                        <?php include("footer.php"); ?>