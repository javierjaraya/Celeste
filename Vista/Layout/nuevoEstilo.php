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
                    <div class="col-md-3">
                        <?php include("../Menus/menuLeft.php"); ?>
                    </div>
                    <div class="col-md-9">

                        <div class="container">
                            <!-- CONTENIDO AQUI-->
                            aqui van el conteido
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="footer" >
                <div class="col-md-12">
                    <div class="contact">
                        <ul>
                            <li class="address">Chillàn, Chile</li>
                            <li class="address">Viveroceleste@gmail.com</li>
                            <li class="fono">fono: 962501107</li>
                            <li class="fax">Horario de atencion : Lunes a Sabado, 11:00 hasta 18:30</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="powered">Desarrollo UBB&nbsp;|&nbsp;
                        <div class="payments_types"> 
                            <img src="../../Files/img/payment_paypal.png" alt="paypal" title="PayPal">
                <!--            <img src="../../Files/img/payment_visa.png" alt="visa" title="Visa"></div>-->
                        </div>
                    </div>
                </div>
                </div>
            </div>
    </body>
</html>