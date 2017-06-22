<?php
include("header.php");
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
