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

            <!-- CUERPO -->
            <div class="row">
                <div class="container">
                    <div class="col-md-3">
                        <?php include("../Menus/menuLeft.php"); ?>
                    </div>
                    <div class="col-md-9">

                        <div class="row">

                            <?php
                            $idSubCategoria = htmlspecialchars($_REQUEST['sub']);
                            $subcategoria = $control->getSubcategoriaByID($idSubCategoria);
                            ?>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="breadcrumb-new"> <a href="index.php">Home</a> » <a href="#"><?= $subcategoria->getNombreSubCategoria() ?></a></div>
                                    <div class="box">            
                                        <!--<div class="box-heading"><span>Featured</span></div>-->
                                        <h1> <?= $subcategoria->getNombreSubCategoria() ?> </h1>
                                        <div class="product-filter">
                                            <!--<div class="display"><b>Display</b></div>-->
                                            <div class="limit"><b>Ver:</b>
                                                <select id="por_pagina" onchange="load(1)">
                                                    <option selected="selected" value="12">12</option>
                                                    <option value="24">24</option>
                                                    <option value="40">40</option>
                                                    <option value="80">80</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                            <div class="sort"><b>Ordernar por:</b>
                                                <select id="orden" onchange="load(1)">
                                                    <option selected="selected" value="Defecto">Defecto</option>
                                                    <option value="A-Z">Nombre (A - Z)</option>
                                                    <option value="Z-A">Nombre (Z - A)</option>
                                                    <option value="Menor-Mayor">Precio (Menor < Mayor)</option>
                                                    <option value="Mayor-Menor">Precio (Mayor > Menor)</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div id="loader" class="text-center"><img src="../../Files/img/loader.gif"></div>
                                        <div id="alert"></div>
                                        <div class="outer_div">
                                            <!-- Datos Productos aqui -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    load(1);
                                });

                                function load(page) {
                                    idSubCategoria = getParameterByName("sub");
                                    idCategoria = getParameterByName("cat");
                                    por_pagina = document.getElementById("por_pagina").value;
                                    orden = document.getElementById("orden").value;
                                    var parametros = {"accion": "LISTADO_BY_ID_SUBCATEGORIA_PAGINACION", "page": page, "por_pagina": por_pagina, "orden": orden, "idCategoria": idCategoria, "idSubCategoria": idSubCategoria};
                                    $("#loader").fadeIn('slow');
                                    $.ajax({
                                        url: '../Servlet/administrarProducto.php',
                                        data: parametros,
                                        beforeSend: function (objeto) {
                                            $("#loader").html("<img src='../../Files/img/loader.gif'>");
                                        },
                                        success: function (data) {
                                            $(".outer_div").html(data).fadeIn('slow');
                                            $("#loader").html("");
                                        }
                                    });
                                }

                                function agregarAlCarro(id) {
                                    var parametros = {"accion": "AGREGAR_ARTICULO", "idProducto": id, "cantidad": 1};
                                    $("#loader").fadeIn('slow');
                                    $.ajax({
                                        url: '../Servlet/administrarCarroCompra.php',
                                        data: parametros,
                                        beforeSend: function (objeto) {
                                            $("#loader").html("<img src='../../Files/img/loader.gif'>");
                                        },
                                        success: function (data) {
                                            var data = eval('(' + data + ')');
                                            if (data.success == true) {
                                                $("#loader").html("");
                                                if (data.stock == true) {
                                                    $("#cart-total").html("Total Carro :  $" + number_format(data.precio_total, 0));
                                                    notificacion("Producto agregado correctamente. Total Carro: $" + number_format(data.precio_total, 0), 'success', 'alert');
                                                } else {
                                                    notificacion("No hay mas stock disponible para este producto.", 'warning', 'alert');
                                                }
                                            } else {
                                                location.href = data.url;
                                            }
                                        }
                                    });
                                }

                                function number_format(amount, decimals) {
                                    amount += ''; // por si pasan un numero en vez de un string
                                    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

                                    decimals = decimals || 0; // por si la variable no fue fue pasada

                                    // si no es un numero o es igual a cero retorno el mismo cero
                                    if (isNaN(amount) || amount === 0)
                                        return parseFloat(0).toFixed(decimals);

                                    // si es mayor o menor que cero retorno el valor formateado como numero
                                    amount = '' + amount.toFixed(decimals);

                                    var amount_parts = amount.split('.'),
                                            regexp = /(\d+)(\d{3})/;

                                    while (regexp.test(amount_parts[0]))
                                        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

                                    return amount_parts.join('.');
                                }
                            </script>


                            <?php include("footer.php"); ?>