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

                <?php if($autentificado == "SI"){ ?>
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
<?php
$idSubCategoria = htmlspecialchars($_REQUEST['sub']);
$idProducto = htmlspecialchars($_REQUEST['idProducto']);
$subcategoria = $control->getSubcategoriaByID($idSubCategoria);
$producto = $control->getProductoByID($idProducto);
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
    <div class="breadcrumb-new"> <a href="index.php">Home</a> » <a href="#"><?= $subcategoria->getNombreSubCategoria() ?></a></div>
</div>

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
                    <input type="number" value="1" min="1" max="<?= $producto->getStock() ?>"  name="quantity" class="w30" id="qty">                    
                    <div class="clear"></div>
                </div>
                <input type="button" class="button" id="button-cart" style="" value="Agregar al carro">
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
<div class="review-list" id="tab-review" style="display: block;">
    
    <b>Nombre:</b><br>
    <input type="text" value="" name="name">
    <br>
    <br>
    <b>Consulta:</b>
    <textarea style="width: 98%;" rows="8" cols="40" name="text"></textarea>
    <span style="font-size: 11px;"><span style="color: #FF0000;">Nota:</span> HTML no es permitido</span><br>    
    <div class="buttons">
        <div class="right"><a class="button" id="button-review">Enviar</a></div>
    </div>
</div>




<?php include("footer.php"); ?>
