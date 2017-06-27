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
                        <div class="" style="width: 200px;">
                            <div class="btn-group" role="group">                            
                                <img width="32" height="32" alt="small-cart-icon" src="../../Files/img/cart-bg.png" style="background: #F15A23;">
                                <a style="text-decoration: none; color: #333;" data-toggle="dropdown"><span id="cart-total">Total Carro :  $<?= $precio_total ?></span><span class="caret"></span></a>                           
                                <ul class="dropdown-menu">
                                    <li><a href="carroDeCompra.php">Ver Carro<samp class="glyphicon glyphicon-shopping-cart" style="float: right;"></samp></a></li>
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
                            $nombreProducto = htmlspecialchars($_REQUEST['busqueda']);
                            $producto = $control->getProductoByNombre($nombreProducto);
                            $nombreSubCategoria = "";
                            if ($producto->getIdProducto() != "") {
                                $idSubCategoria = $producto->getIdSubCategoria();
                                $subcategoria = $control->getSubcategoriaByID($idSubCategoria);
                                $nombreSubCategoria = $subcategoria->getNombreSubCategoria();
                                $idCategoria = $subcategoria->getIdCategoria();
                            } else {
                                $nombreSubCategoria = "Resultado Busqueda";
                            }
                            ?>

                            <style type="text/css">
                                input[type='number'], input[type='text'], input[type='password'], textarea {
                                    background: #F8F8F8;
                                    border: 1px solid #E4E4E4;
                                    padding: 7px;
                                    margin-left: 0px;
                                    margin-right: 0px;
                                    font-size: 14px;
                                }

                                /************* button ***********/
                                #button-cart { height:35px; line-height:35px; padding:0 15px; background:#F15A23; color:#fff; font-size:14px; font-weight:normal; text-transform:uppercase; -webkit-transition: all 0.3s ease-in-out; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; -ms-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; }
                                #button-cart:hover { background:#444; color:#fff; -webkit-transition: all 0.3s ease-in-out; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; -ms-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; }
                                .box-product > div .cart a.button, .box-product > div .cart input.button, .product-grid > div .cart a.button, .product-grid > div .cart input.button, .product-list > div .cart a.button, .product-list > div .cart input.button { background:#eee; color:#555; }
                                .box-product > div .cart a.button:hover, .box-product > div .cart input.button:hover, .product-grid > div .cart a.button:hover, .product-grid > div .cart input.button:hover, .product-list > div .cart a.button:hover, .product-list > div .cart input.button:hover { background:#F15A23; color:#fff; opacity:1; }
                                a.button, input.button { cursor: pointer; color:#fff; font-size: 12px; font-weight: bold; background:#F15A23; border:none; -webkit-box-shadow:inset 0px 0px 5px rgba(0, 0, 0, .10); -moz-box-shadow:inset 0 0 5px rgba(0, 0, 0, .10); box-shadow:inset 0 0 5px rgba(0, 0, 0, .10); border-radius:2px; -webkit-border-radius:2px; -moz-border-radius:2px; -webkit-transition: all 0.3s ease-in-out; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; -ms-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; }
                                a.button { display: inline-block; text-decoration: none; padding: 6px 12px 6px 12px; }
                                input.button { margin:0; height:26px; line-height:26px; padding: 0px 10px; }
                                a.button:hover, input.button:hover { background:#444; color:#fff; -webkit-transition: all 0.3s ease-in-out; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; -ms-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; }
                                .buttons { border-top:1px solid #EEEEEE; overflow: auto; padding: 6px; margin-bottom: 20px; }
                                .buttons .left { float: left; text-align: left; }
                                .buttons .right { float: right; text-align: right; }
                                .buttons .center { text-align: center; margin-left: auto; margin-right: auto; }



                            </style>


                            <div style="padding-bottom: 10px;">
                                <div class="breadcrumb-new"> <a href="index.php">Home</a> » <a href="#"><?= $nombreSubCategoria ?></a></div>
                            </div>
                            <div id="alert"></div>

                            <?php if ($producto->getIdProducto() != "") { ?>
                                <div class="product-info">
                                    <div class="left">
                                        <div class="image"> 
                                            <img src="../../<?= $producto->getImagen()->getRutaImagen() ?>" title="#" alt="#" id="image" width="350" height="350">            
                                        </div>        
                                    </div>

                                    <div class="right" style="min-height: 350px;">
                                        <h1 style="text-align: left;"><?= $producto->getNombreProducto() ?></h1>
                                        <div class="description"> 
                                            <!--<span>Brand:</span> <a href="#">Apple</a><br>-->
                                            <span>Codigo Producto:</span> <?= $producto->getIdProducto() ?><br>
                                            <span>Stock:</span> <?= $producto->getStock() ?> unidades</div>
                                        <div class="price">Precio: <span class="price-old">$<?= $producto->getPrecio() ?></span>
                                            <div class="price-tag">$<?= $producto->getPrecio() ?></div>
                                            <br>
                                            <!--<span class="price-tax">Ex Tax: $101.00</span><br>-->
                                        </div>
                                        <div class="cart">
                                            <div>
                                                <div class="qty"> <strong>Cantidad:</strong>
                                                    <input type="number" value="1" min="1" max="<?= $producto->getStock() ?>"  name="cantidad" id="cantidad">                    
                                                    <div class="clear"></div>
                                                </div>
                                                <input type="button" class="button" id="button-cart" style="" value="Agregar al carro" onclick="agregarAlCarro(<?= $producto->getIdProducto() ?>)">
                                            </div>
                                        </div>
                                        <div class="review">
                                            <div></div>
                                        </div>          
                                    </div>
                                </div>

                                <div style=" padding: 5px; color: #333; font-size: 15px; font-weight: bold; text-align: center; border-top: 1px solid #EEEEEE;border-left: 1px solid #EEEEEE;border-right: 1px solid #EEEEEE; width: 150px;">
                                    Descripción
                                </div>
                                <div id="tab-description" class="review-list" style="display: block;">
                                    <?= $producto->getDescripcionProducto() ?>
                                </div>

                                <div style=" padding: 5px; color: #333; font-size: 15px; font-weight: bold; text-align: center; border-top: 1px solid #EEEEEE;border-left: 1px solid #EEEEEE;border-right: 1px solid #EEEEEE; width: 150px;">
                                    Consulta
                                </div>                            
                                <div id="alert2"></div>
                                <form id="fm-consulta" class="form-horizontal" method="Post">                           
                                    <div class="review-list" id="tab-review" style="display: block;">
                                        <input type="hidden" value="" name="asunto" id="asunto">                              
                                        <input type="hidden" id="destino" name="destino" value="joseline.cisternas@gmail.com">                                   
                                        <input type="hidden" id="idProductoConsulta" name="idProductoConsulta" value="<?= $producto->getIdProducto() ?>">
                                        <input type="hidden" id="nombreProductoConsulta" name="nombreProductoConsulta" value="<?= $producto->getNombreProducto() ?>">
                                        <input type="hidden" id="accion" name="accion" value=""> 

                                        <b>Ingrese su correo electronico:</b><br>
                                        <input type="text" value="" style="width: 300px" name="desde" id="desde">
                                        <br>
                                        <br>
                                        <b>Consulta:</b>
                                        <textarea style="width: 98%;" rows="8" cols="40" name="mensaje" id="mensaje"></textarea>
                                        <span style="font-size: 11px;"><span style="color: #FF0000;">Nota:</span> HTML no es permitido</span><br>    
                                        <div class="buttons">
                                            <div class="right"><input class="btn btn-warning" value="Enviar Consulta" onclick="enviarConsulta()" type="button"></div>
                                        </div>
                                    </div>
                                </form>


                            <?php } else { ?>
                                <div class="bg-warning" style="width: 400px; height: 70px; padding-top: 2px; text-align: center; margin: 0 auto; border: orangered 1px solid; border-radius: 15px;" >
                                    <h3>Sin resultado en la busqueda</h3>
                                </div>                                
                            <?php } ?>
                            <script>
                                $(document).ready(function () {

                                });
                                function enviarConsulta() {
                                    var asunto = "Consulta Por: " + document.getElementById("nombreProductoConsulta").value + " (id:" + document.getElementById("idProductoConsulta").value + ")";
                                    document.getElementById("asunto").value = asunto;
                                    document.getElementById("accion").value = "ENVIAR_CORREO";
                                    $.ajax({
                                        type: "POST",
                                        url: "../Servlet/enviarCorreo.php",
                                        data: $("#fm-consulta").serialize(),
                                        success: function (result) {
                                            var result = eval('(' + result + ')');
                                            if (result.errorMsg) {
                                                notificacion('Error, Su consulta no pudo ser enviada, intente nuevamente', 'danger', 'alert2');
                                            } else {
                                                notificacion('Su consulta a sido enviada de forma exitosa', 'success', 'alert2');
                                                document.getElementById("mensaje").value = "";
                                            }
                                        }
                                    });
                                }

                                function agregarAlCarro(id) {
                                    var cantidad = document.getElementById("cantidad").value;
                                    if (cantidad != "" && cantidad > 0) {
                                        var parametros = {"accion": "AGREGAR_ARTICULO", "idProducto": id, "cantidad": cantidad};
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
                                    } else {
                                        notificacion("Debe ingresar una cantidad mayor que 0.", 'warning', 'alert');
                                    }
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
